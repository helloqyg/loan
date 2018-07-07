<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class DonorController extends MainController {

    public function index(){
 		 $this->header_title='捐赠列表';
        $count = M('Donor')->count();
        $Page = new \Common\Util\Page($count,15);
        $show = $Page->show();
        $this->page = $show;
        $where = [
            'status' => [
                'neq', 0
            ]
        ];
        $this->list = M('Donor')->where($where)->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->display();
   }


   /**
     * 删除
     */

	public function del(){
        $id = I('get.id',0,'intval');
        if( $id == 0 ) $this->error('参数错误');
        if( M('Donor')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }



    /**
     * 查看项目的捐款记录
     */

    public function item_detail(){
        $item_id = I('get.item_id',0,'intval');
        $type = I('get.type',0,'intval');
        $this->list = M('Donor')->where(array('type'=>$type,'item_id'=>$item_id))->select();
        $this->display();
    }
}
