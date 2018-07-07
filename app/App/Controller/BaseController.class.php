<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class BaseController extends \Think\Controller{


    /**
     * common initializetion function
     * @author qyg
     */

    public function _initialize(){
        session('user_id',73);
        $userinfo = session('user_id');
        if (!$userinfo) {
            $this->redirect('WxLogin/wxLogin');
        }
    }

}