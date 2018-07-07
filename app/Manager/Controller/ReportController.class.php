<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;
use Common\Util\Page;

class ReportController extends MainController {

    public function index(){
        $count = M('Report')->count();
        $Page = new Page($count, 15);
        $show = $Page->show();
        $this->page = $show;
        $this->result = M('Report')->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->display();
    }





    /**
     * 图片大图
     * @param $type 1 2 代表爱心救助    3代表轻松公益
     */

    public function img_detail()
    {
        $id = I('get.img_id');
        $result = M('Report')->find($id);
        //如果图片不为空，页面显示出来
        $personalImgIdString = $result['img'];
        if ($personalImgIdString ) {
            //图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
        }
        $this->display();
    }

}
