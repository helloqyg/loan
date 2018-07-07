<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class HelpController extends BaseController {

	public function _initialize(){
    }

    public function index(){
    	$id = I('get.id',0,'intval');
    	if( $id == 0 ) $id = M('News')->min('id');
    	$this->info = M('News')->find($id);
    	$this->display();
    }

}