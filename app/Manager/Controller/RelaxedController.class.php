<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class RelaxedController extends MainController {

    public function index(){
 		$this->header_title='轻松公益-列表';
        //搜索功能
        $title = I('get.title');
        $ins_name = I('get.ins_name');
        $is_top = I('get.is_top');
        $min_money = I('get.min_money', '0', 'intval');
        $max_money = I('get.max_money', 9999999999, 'intval');
        $status = I('get.status');
        if ($max_money == '') $max_money = 9999999999;
        $count = M('Gongyi')->count();
        $Page = new \Common\Util\Page($count,15);
        $show = $Page->show();
        $this->page = $show;
        $sql = "select * from wd_gongyi where target_money between {$min_money} and {$max_money} ";
        //如果status为空代表查询全部
        if ($status != '') $sql .= " and status = {$status}  ";
        if ($is_top != '') $sql .= " and is_top = {$is_top}  ";
        $sql .= " and title like '%{$title}%' and ins_name like '%{$ins_name}%' order by create_date desc  limit  {$Page->firstRow} , {$Page->listRows}  ";
        $this->list = M('Gongyi')->query($sql);

//        $count = M('Gongyi')->count();
//        $Page = new \Common\Util\Page($count,15);
//        $show = $Page->show();
//        $this->page = $show;
//        $this->list = M('Gongyi')->order('create_date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->display();
    }


    /**
     * 修改/添加
     * 有id时为修改，没id时为添加
     */


    public function  add(){
        if (IS_GET){
            $this->header='轻松公益';
            $id = I('get.id',0,'intval');
            $result = M('Gongyi')->find($id);
            //如果图片不为空，页面显示出来
            $personalImgIdString = $result['personal_img'];
            if ($personalImgIdString) {
                //个人病例图片信息
                $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
            }
            if ( $result['ins_logo']){
                $this->ins_img = M('Images')->where(array('id' => array('in', $result['ins_logo'])))->select();
            }

            $this->header_title='轻松公益';
            $id = I('get.id');
            $this->result = M('Gongyi')->find($id);
            $this->display();
        }
        if (IS_POST){
            $ins_logo = I('post.ins_logo');
            $personal_img = I('post.orgArray');
            if ($ins_logo) {
                $ins_logo_arr = '';
                foreach ($ins_logo as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $ins_logo_arr .=  $img_id;
                }

            }
            if ($personal_img) {
                $personal_img_arr = '';
                foreach ($personal_img as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $personal_img_arr .= ',' . $img_id;
                }

            }
            $model = M('Gongyi');
            if (I('post.id')){
                if ($model->create()){
                    $model->ins_logo = $ins_logo_arr;
                    $model->personal_img = $personal_img_arr;
                    $model->save();
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(0);
                }
                //$result = $model->data($data)->add();

            }else{
                if ($model->create()){
                    $model->ins_logo = $ins_logo_arr;
                    $model->create_date = time();
                    $model->personal_img = $personal_img_arr;
                    $model->add();
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(0);
                }
            }
        }

    }


	/**
     * 删除
     */

	public function del(){
        $id = I('get.id',0,'intval');
        if( $id == 0 ) $this->error('参数错误');
        if( M('Gongyi')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }
}
