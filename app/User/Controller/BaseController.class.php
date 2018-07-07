<?php

/**
 * Front desk base object 
 * @author    qyg
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/08/3
 */

namespace User\Controller;

class BaseController extends \Think\Controller{


	/**
     * common initializetion function 
     * @author qyg
     */

    public function _initialize(){
    	// 判断登录状态
    	$is_login = check_login();
    	// 未登录
    	if(!$is_login){
    	    $this->redirect( '/user/login' );
    	}
        // 超级管理员特权
        if(session(C('ADMIN_AUTH_KEY')) || cookie(C('ADMIN_AUTH_KEY'))){
             return ;
        }
        // 导入权限验证类
        $auth  = new \Think\Auth();
        // 获取用户id
        $userid   = get_uid(false);
        // 验证权限
        if(!$auth->check(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME,$userid)){
            //$this->error('没有开通使用权限');
        }
        // 设置配置信息
        C(array(
            'FINANCE_EMAIL' => get_config('FINANCE_EMAIL'),
            'PRODUCT_EMAIL' => get_config('PRODUCT_EMAIL'),
            )
        );
		
		$order_model = M('Order');
		$booth_model = M('Booth');
		$booth_order = $order_model->field('id,type,status,ad_type,atime,bid')->where(array('ad_type'=>1))->select();
		
		foreach( $booth_order as $value){
			if($value['type'] ==1 && $value['status'] == 1){
				if( time() - $value['atime'] >= 14400 ){
					$order_model->where(array('id'=>$value['id']))->delete();
					$data['id']     = $value['bid'];
					$data['status'] = 1;
					$data['uid']    = '';
					$data['time']   = '';
					$booth_model->save($data);
				}
			}
			if($value['type'] == 2 ){
				$pay_info = M('Pay')->where(array('pid'=>$value['bid']))->find();
					if(count($pay_info) == 0 ){
						if( time() - $value['atime'] >= 14400 ){
						$info = M('Pay')->getFieldByPid($value['bid'],'status');
						if(!$info){
							$order_model->where(array('id'=>$value['id']))->delete();
							M('Pay')->where(array('pid'=>$value['bid']))->delete();
							$data['id']     = $value['bid'];
							$data['status'] = 1;
							$data['uid']    = '';
							$data['time']   = '';
							$booth_model->save($data);
						}
					}
				}
			}
		}
    }
}