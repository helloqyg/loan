<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;
use Think\Controller;

/**
 * common object
 */

class MainController extends Controller {

    /**
     * common initialization
     * @author qyg
     */

    public function _initialize(){
    	// check login status
    	$is_login = check_login(ture);
    	// 未登录跳转
    	if(!$is_login){
    	       $this->error('请登录',U('/manager/login'),1);
    	}

    }

    /**
     * 提示信息
     * @param  $bool 布尔值
     * @param  $info 提示信息
     * @author qyg
     */

    public function notice_info($bool,$info,$url){
        if($bool){
            if(empty($url)){
                 $this->success($info."成功");
            }else{
                $this->success($info."成功",$url);
            }
        }else{
            if(empty($url)){
                 $this->error($info."成功");
            }else{
                $this->error($info."成功",$url);
            }
        }
        return;
    }

}
