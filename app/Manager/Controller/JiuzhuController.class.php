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
class JiuzhuController extends MainController
{

    public function index()
    {
        $this->header_title = '爱心救助-列表';
        $title = I('get.title');
        $recommend = I('get.recommend');
        $min_money = I('get.min_money', '0', 'intval');
        $is_success = I('get.is_success');
        $max_money = I('get.max_money', 9999999999, 'intval');
        $status = I('get.status');
        if ($max_money == '') $max_money = 9999999999;
        $count = M('Rescue')->count();
        $Page = new Page($count, 15);
        $show = $Page->show();
        $this->page = $show;
        $sql = "select * from wd_rescue where target_money between {$min_money} and {$max_money} ";
        //如果status为空代表查询全部
        if($is_success != '') $sql .= " and is_success = {$is_success}  ";
        if ($status != '') $sql .= " and status = {$status}  ";
        if ($recommend != '') $sql .= " and recommend = {$recommend}  ";
        $sql .= " and title like '%{$title}%' order by create_date desc  limit  {$Page->firstRow} , {$Page->listRows}  ";
//       $this->list = M('Rescue')->where($where)->order('create_date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->list = M('Rescue')->query($sql);
        $this->display();
    }


    /**
     * 编辑信息
     */

    public function edit()
    {
        if (IS_GET) {
            $this->header='爱心救助';
            $id = I('get.id', 0, 'intval');
            if ($id == 0) $this->error('参数错误');
            $result = M('Rescue')->find($id);
            //如果图片不为空，页面显示出来
            $personalImgIdString = $result['personal_img'];
            $orgImgIdString = $result['company_img'];
            if ($personalImgIdString) {
                //个人病例图片信息
                $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
            }
            if ($orgImgIdString) {
                //个人病例图片信息
                $this->orgImgArray = M('Images')->where(array('id' => array('in', $orgImgIdString)))->select();
            }
            //证人信息
            $this->witness = M('Witness')->where(array('item_id'=>$id))->select();
            //委员会信息
            $this->commitInfo = M('Committee')->select();
            //组织信息
            $this->tag = M('Tag')->select();
            $this->organInfo = M('Organization')->select();
            $this->result = M('Rescue')->find($id);
            $this->display();
        }


        if (IS_POST) {
            $imgArray = I('post.array');
            $orgImgArray = I('post.orgArray');
            if ($imgArray) {
                $personal_img_arr = '';
                foreach ($imgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $personal_img_arr .= ',' . $img_id;
                }

            }
            if ($orgImgArray) {
                $company_img_arr = '';
                foreach ($orgImgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $company_img_arr .= ',' . $img_id;
                }

            }
            $model = M('Rescue');
            if ($model->create()) {
                $model->personal_img = $personal_img_arr;
                $model->company_img = $company_img_arr;
                $model->save();
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(0);
            }
            //$result = $model->data($data)->add();
        }
    }

    /**
     * 图片大图
     * @param $type 1 2 代表爱心救助    3代表轻松公益
     */

    public function img_detail()
    {
        $id = I('get.img_id');
        $type = I('get.type');
        $result = M('Rescue')->find($id);
        $RelaxedImg = M('Gongyi')->find($id);
        $RelaxedImg = $RelaxedImg['personal_img'];
        //如果图片不为空，页面显示出来
        $personalImgIdString = $result['personal_img'];
        $orgImgIdString = $result['company_img'];
        if ($personalImgIdString && $type == 2) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
        }
        if ($orgImgIdString && $type == 1) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $orgImgIdString)))->select();
        }
        if ($RelaxedImg && $type == 3) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $RelaxedImg)))->select();
        }
        $this->display();
    }

    /**
     * 标签
     */

    public function tag()
    {
        $this->header_title = '爱心救助-标签';
        $this->result = M('Tag')->select();
        $this->display();
    }



    /**
     * 删除
     */

    public function del(){
        $id = I('get.id',0,'intval');
        if( $id == 0 ) $this->error('参数错误');
        if( M('Rescue')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }


    /**
     * 删除标签
     */

    public function tag_del()
    {
        $id = I('get.id', 0, 'intval');
        if ($id == 0) $this->error('参数错误');
        if (M('Tag')->delete($id)) {
            $this->success('删除成功');

        } else {
            $this->error('删除失败');
        }
    }

    /**
     * tag 修改添加
     */

    public function tag_add()
    {
        if (IS_GET) {
            $id = I('get.id', 0, 'intval');
            $this->result = M('Tag')->find($id);
            $this->display();
        }


        if (IS_POST) {

            $model = M('Tag');
            if (I('post.id')) {

                if ($model->create()) {
                    $model->save();
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(0);
                }
                //$result = $model->data($data)->add();

            } else {
                if ($model->create()) {
                    $model->add();
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(0);
                }
            }
        }
    }
}
