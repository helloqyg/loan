<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */
namespace Manager\Controller;
use Common\Util\UserAuth;
class UserController extends MainController{


	/**
	 * Company user manager
	 * @author qyg
	 */

	public function index(){

        $this->header_title = '前台用户管理';
        //搜索功能
        $cu_id = I('get.cu_id');
        $username = I('get.username');
        $phone = I('get.phone');
        $auth_id = I('get.auth_id');
        $is_auth = I('get.is_auth');
        $count = M('Member')->count();
        $Page = new \Common\Util\Page($count,15);
        $show = $Page->show();
        $this->page = $show;
        $sql = "select * from wd_member where 1=1 ";
        //如果status为空代表查询全部
        if ($cu_id != '') $sql .= " and cu_id = {$cu_id}  ";
        if ($phone != '') $sql .= " and phone = {$phone}  ";
        if ($auth_id != '') $sql .= " and auth_id = {$auth_id}  ";
        if ($is_auth != '') $sql .= " and is_auth = {$is_auth}  ";
        $sql .= " and username like '%{$username}%' order by id desc  limit  {$Page->firstRow} , {$Page->listRows}  ";
        $this->list = M('Dream')->query($sql);



		$this->display('index');
	}

    /**
     * 修改用户信息
     */
	public function edit(){
	    if (IS_GET){
	        $id = I('get.id',0,'intval');
	        $this->result = M('Member')->find($id);
	        $this->display();
        }
        if (IS_POST){
            $model = M('Member');
            if ($model->create()){
                $model->save();
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }
    }


	/**
	 * User repassword
	 * @author qyg
	 */

	public function modify(){
		if(IS_GET){
			$this->display();
		}

		if(IS_POST){
			$result = UserAuth::modify_password(I('post.password','','trim'),true);
			$user_model = M('Member');
			if( $result ){
				$this->success('修改成功');
			}else{
				$this->error('修改失败');
			}
		}
	}


}