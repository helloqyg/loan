<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class IndexController extends MainController {

    public function index(){
    	$this->user = M('Member')->count();
    	$this->display();
    }


    /**
     * 上传图片
     */
    public function ajaxUpload()
    {
        $pic = $_FILES['img'];
        $path_pic = './Public/static/images';
        if (!empty($pic['name'])) {
            $pic_res = uploadFile($pic, $path_pic);

            if ($pic_res['status'] == 1) {

                $this->ajaxReturn(trim($pic_res['dest'], '.'));
            } else {
                $this->ajaxReturn(0);
            }
        } else {
            $this->ajaxReturn(0);
        }
    }
}
