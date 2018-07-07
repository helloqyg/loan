<?php

/**
 * 前台程序
 * @author       widuu <admin@widuu.com>
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/07/27
 */

namespace App\Controller;

class HelpController extends \Think\Controller {

	public function _initialize(){
    	$this->list = M("News")->field('title,id')->select();
    }

    public function index(){
    	$id = I('get.id',0,'intval');
    	if( $id == 0 ) $id = M('News')->min('id');
    	$this->info = M('News')->find($id);
    	$this->display();
    }

}