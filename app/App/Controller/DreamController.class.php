<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class DreamController extends BaseController {

    public function index(){
        $type_id = I('get.id',0,'intval');
        $this->type = M('DreamType')->select();
        //查全部
        if ($type_id == 0){
            $this->result = M('Dream')->where(array('status'=>3))->order('is_top desc,date desc')->select();
        }else{
            $this->result = M('Dream')->where(array('type'=>$type_id,'status'=>3))->select();
        }
        //关注
        $this->follow = M('Follow')->where(array('user_id'=>get_user_id(),'item_id'=>$id,'type'=>2))->find();
        $this->display();
    }

    /**
     * 详情页面
     *
     */

    public function detail(){
        $id = I('get.id',0,'intval');
        if ($id == 0) $this->error('参数错误');
        //图片
        $itemInfo =  M('Dream')->find($id);

         //判断是否已经结束
         $shengxia = overplus_time($itemInfo['date']);
         if ($shengxia <= 0) {
            M('Dream')->save(array('status'=>4,'id'=>$itemInfo['id']));
            $this->error('项目已结束',U('index/index'));
         }


        $this->personInfo = M('Member')->find(get_user_id());
        //如果图片不为空，页面显示出来
        $personalImgIdString = $itemInfo['img'];
        if ($personalImgIdString) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
        }
        $this->top3 = M('Donor')->where(array('item_id'=>$id,'type'=>2))->order('price desc')->limit(3)->select();
        //帮助list
        $donorList = M('Donor')->where(array('item_id' => $id, 'type' => 2))->order('date desc')->select();
        foreach ($donorList as $key => &$value) {
            $value['comments']=  M('Comments')->where(array('type'=>2,'donor_id'=>$value['id']))->order('date desc')->select();
        }
        //关注
        $this->follow = M('Follow')->where(array('user_id'=>get_user_id(),'item_id'=>$id,'type'=>2))->find();
        $this->assign('donorList', $donorList);
        $this->itemInfo =  M('Dream')->find($id);
        $this->display();
    }


    /**
     * 我要发布
     */

    public function release(){
        if (IS_GET){
            //类型
            $this->type = M('DreamType')->select();
            $type_id = I('get.id');
            $this->result = M('Dream')->where(array('type'=>$type_id))->order('is_top desc,date desc')->select();
            $this->display();
        }
        if (IS_POST){
            $imgArray = I('post.array');
            if ($imgArray) {
                $img_arr = '';
                foreach ($imgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $img_arr .= ',' . $img_id;
                }

            }
            $model = M('Dream');
            if ($model->create()){
                $model->date = time();
                $model->status = 3;
                $model->user_id=get_user_id();
                $model->img = $img_arr;
                $model->add();
            }
        }
    }


    /**
     * 帮助他
     */
    public function helpIt()
    {
        if (IS_GET) {
            $id = I('get.id');

            $this->display();
        }
        if (IS_POST) {
            $id = I('get.id', 0, 'intval');
            $model = M('Donor');
            if ($model->create()) {
                $model->date = time();
                $model->type = 2;
                $model->user_id = get_user_id();
                $result = $model->add();
                $this->redirect('detail',array('id'=>$id));
            }
        }
    }

}