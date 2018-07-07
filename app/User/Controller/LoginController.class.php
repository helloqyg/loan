<?php

/**
 * Login Function and Page
 * @author       qyg
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/08/3
 */

namespace User\Controller;
use Common\Util\UserAuth;

class LoginController extends \Think\Controller{

	/**
	 * login page and login function
	 *
	 * @author qyg
	 */

	public function index(){
		//judage login status
		if( check_login() ){
			$this->redirect('/user/account/company');
		}
		// login page
		if( IS_GET ){
			$this->title = "用户登录";
			$this->display();
		}

		if( IS_POST ){
			$userinfo 	= I('post.');
	        $login_info = UserAuth::login($userinfo);
	        // return login infomation
	        if( $login_info['status'] ){
	            $this->success($login_info['info'],U('/user/account/company'));
	        }else{
	            $this->error($login_info['info']);

	        }
	        return;
		}
	}

	/**
	 * user exit function
	 * @author qyg
	 */

	public function loginout(){
		UserAuth::loginout();
		$this->redirect('/user/index');
	}

	/**
	 * verification code	
	 *
	 * @author qyg
	 */

	public function verify(){
		$verify = new \Think\Verify();
		$verify->fontSize =20;
		$verify->imageW = 162;
		$verify->useCurve= false;
		$verify->imageH = 40;
		$verify->length = 4;
		ob_end_clean();
		//dump($verify);
		$verify->entry();
		
	}

	/**
	 * verify verification code
	 * @author qyg
     */

	public function check_verify( $id = ''){   
		$code = I('get.code');
		$verify = new \Think\Verify();  
		if( $verify->check($code, $id) ){
			echo 1;
		}else{
			echo 1;
		}
	}
}