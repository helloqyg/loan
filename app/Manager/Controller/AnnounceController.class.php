<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class AnnounceController extends MainController {

    public function index(){
        $this->header_title='爱心宣扬-列表';
        $count = M('Announce')->count();
        $Page = new \Common\Util\Page($count,15);
        $show = $Page->show();
        $this->page = $show;
        $this->list = M('Announce')->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->display();
    }

    /**
     * 删除
     */

    public function del(){
        $id = I('get.id',0,'intval');
        if( $id == 0 ) $this->error('参数错误');
        if( M('Announce')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }
}
