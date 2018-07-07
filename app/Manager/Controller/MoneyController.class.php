<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class MoneyController extends MainController {

    public function index(){
    	$this->result = M('UseMoney')->where(array('flag'=>1))->select();
    	$this->display();
    }



    public function detail(){
        if (IS_GET){
            $id = I('get.id');
            $this->result = M('useMoney')->find();
            $this->display();
        }
        if (IS_POST){
            $model = M('useMoney');
            if ($model->create()){
                if ( $model->save()){
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(0);
                }
            }
        }
    }
}
