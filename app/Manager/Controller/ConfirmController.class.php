<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class ConfirmController extends MainController {

	/**
	 * repassword 
	 * @author qyg
	 */

	public function index(){

	}

	/**
	 * forgot page
	 * @author qyg
	 */

	public function forgot(){
		if(IS_GET){
			$this->display();
		}
	}

}
