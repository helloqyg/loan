<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class FavorableController extends BaseController {

    public function index(){
        $this->result = M('Gongyi')->where(array('status' => 3))->order('is_top desc,create_date desc')->select();
        $this->display();
    }


    public function detail(){



        $id = I('get.id', 0, 'intval');
        if ($id == 0) {
            $this->error("参数错误");
        }

        //项目信息
        $this->itemInfo = M('Gongyi')->find($id);
        $itemInfo = M('Gongyi')->find($id);
        
         //判断是否已经结束
         $shengxia = overplus_time($itemInfo['create_date']);
         if ($shengxia <= 0) {
            M('Gongyi')->save(array('status'=>4,'id'=>$itemInfo['id']));
            $this->error('项目已结束',U('index/index'));
         }
        //如果图片不为空，页面显示出来
        $personalImgIdString = $itemInfo['personal_img'];
        if ($personalImgIdString) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
        }
        
        //关注
        $this->follow = M('Follow')->where(array('user_id' => get_user_id(), 'item_id' => $id, 'type' => 3))->find();
        //帮助list
        $donorList = M('Donor')->where(array('item_id' => $id, 'type' => 3))->order('date desc')->select();
        foreach ($donorList as $key => &$value) {
            $value['comments']=  M('Comments')->where(array('type'=>3,'donor_id'=>$value['id']))->order('date desc')->select();
        }
        $this->top3 = M('Donor')->where(array('item_id' => $id, 'type' => 3))->order('price desc')->limit(3)->select();
        $this->assign('donorList', $donorList);
        $this->display();
    }


    /*
     * 爱心贡献榜
     */
    public function rankList()
    {
        if (IS_GET) {
            $id = I('get.id', 0, 'intval');
            if ($id == 0) {
                $this->error("参数错误");
            }
            $this->data = M('Donor')->where(array('item_id' => $id, 'type' => 3))->order('price desc')->select();

            $this->display();
        }
        if (IS_POST) {

        }
    }

    /*
     *轻松公益-帮助TA。
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
                $model->type = 3;
                $model->user_id = get_user_id();
                $result = $model->add();
                $this->redirect('detail', array('id' => $id));
            }
        }
    }
}