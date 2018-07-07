<?php

/**
 * 用户验证类
 * @author    widuu <admin@widuu.com>
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/07/27
 */

namespace Common\Util;

/**
 * 用户管理
 */

class UserAuth{

	// 登录的错误信息
	static private $reg_info = array(
			'0'  => '登录成功',
			'-1' => '用户不存在',
			'-2' => '用户密码错误',
			'-3' => '用户禁止登录',
			'-4' => '您不是后台管理员',
			'-5' => '用户登录失败',
			'-6' => '注册用户已存在',
		);

	/**
	 * 登录方法
	 * @param  $userinfo array 登录参数 array('username','password')
	 * @param  $admin 	 bool  后台登陆标识
	 * @param  $time 	 int   记住登录时间
	 * @return array     	   登陆状态和信息
	 * @author widuu 	 <admin@widuu.com>
	 */

	static public function login( $userinfo,$admin=false,$time=0 ){
		$member_model = M('Member');
		// 判断登录方式
		$where['username'] = $userinfo['username'];
		// 获取登录信息
		$user_info = $member_model->field('id,username,password,is_admin')->where($where)->find();
		// 判断用户是否存在
		if( !$user_info ){
			return array('status'=>false,'info'=>self::$reg_info['-1']);
		}
		// 判断密码是否正确
		$password = compile_password($userinfo['password']);
		if(  $password != $user_info['password'] ){
			return array('status'=>false,'info'=>self::$reg_info['-2']);
		}
		// 判断是否是后台用户
        if( $admin ){
            if( $user_info['is_admin']!=1 ){
                return array('status'=>false,'info'=>self::$reg_info['-4']);
            }
		}

		// 判断前后台
		$map['id'] = $user_info['id'];
		// 添加登录次数
		$member_model->where($map)->setInc('is_first_login',1);
		// 更新登录信息
		$last_login['last_login'] = time();
		$last_login['last_ip']    = get_client_ip();
		if(!$member_model->where($map)->save($last_login)){
			return array('status'=>false,'info'=>self::$reg_info['-5']);
		}

		$uid_alise = $admin ? C('ADMIN_AUTH') : C('USER_AUTH');

		// cookie存储
		if($time){
			cookie($uid_alise,$user_info['id'],$time);
			cookie('gid',$user_info['group_id'],$time);
			cookie('username',$user_info['username'],$time);
		}

		// session存储
		session($uid_alise,$user_info['id']);
		session('gid',$user_info['group_id']);
		session('username',$user_info['username']);

		// 超级管理员
		if( $user_info['group_id'] == 1 ){
			session(C('ADMIN_AUTH_KEY'),1);
			cookie(C('ADMIN_AUTH_KEY'),1);
		}
		return array('status'=>true,'info'=>self::$reg_info['0']);
	}


	/**
     * 退出方法
     * @author widuu <admin@widuu.com>
     */

	static public function loginout(){
		// 删除cookie
		cookie(null);
		// 删除session
		session(null);
		return true;
	}

    /**
     * 用户注册方法
     *
     * @author widuu <admin@widuu.com>
     */

    static public function register($userinfo,$is_admin=false,$cid=0,$gid=2){
    	$member_model = M('Member');
    	if( $member_model->where(array('username'=>$userinfo['username']))->count() == 1 ){
    		return array('status'=>false,'info'=>self::$reg_info['-6']);
    	}
    	$inster_data['salt'] = $salt = fetch_salt();
    	$inster_data['username']   = $userinfo['username'];
    	$inster_data['password']   = compile_password($userinfo['password'],$salt);
    	$inster_data['last_login'] = time();
    	$inster_data['group_id']   = $gid;
    	$inster_data['last_ip']	   = get_client_ip();
    	$inster_data['cid']		   = $cid;
    	$inster_data['is_first_login'] = 1;
    	if( $is_admin ){
    		$inster_data['is_admin'] = 1;
    	}
    	// return user id
    	$result = $member_model->data($inster_data)->add();
    	// add user auth
    	$data['uid'] = $result;
    	$data['group_id'] = $gid;
    	M('AuthGroupAccess')->data($data)->add();
    	if( $result ){
    		return array('status'=>true,'uid'=>$result);
    	}else{
    		return array('status'=>false,'info'=>'注册失败');
    	}
    }

    /**
     * 修改用户密码
     *
     * @author widuu <admin@widuu.com>
     */

    public function modify_password($password,$is_admin = false){
    	$member_model = M('Member');
    	$s_data['id'] = $uid = get_uid($is_admin);
		$salt = $member_model->getFieldById($uid,'salt');
		$s_data['password'] = compile_password($password,$salt);
		if( $member_model->save($s_data) ){
			return true;
		}
		return false;
    }

    /**
     * 企业信息模块
     * @author widuu <admin@widuu.com>
     */

    static public function company_register(){
    	$company_model = D('Company');
    	if( $company_model->create() ){
    		$cid = $company_model->add();
    		if( $cid ){
    			set_cid($cid);
    			return array('status'=>true);
    		}
    		return array('status'=>false,'info'=>'添加企业信息失败'); 
    	}
    	return array('status'=>false,'info'=>'注册失败:'.$company_model->getError());
    }

}
