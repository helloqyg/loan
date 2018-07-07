<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class IndexController extends BaseController
{

    public function index()
    {
        //成功案例、
        $this->successCase = M('Rescue')->where(array('status'=>4,'is_success'=>1))->select();
        // dump($this->successCase);
        //明星慈善
        $this->star = M('Star')->select();
    	//顶部推荐list
    	$this->recommend = M('Rescue')->where(array('status'=>3,'recommend'=>1))->select();
        //爱心救助list
        $this->relifeInfo = M('Rescue')->where(array('status' => 3))->select();
        $this->display();
    }

public function exportSql() {
        $dbName = C('DB_NAME');   //读取配置文件中的数据库用户名、密码、数据库名
        $dbUser = C('DB_USER');
        $dbPwd  = C('DB_PWD');
        $fileName = date("Y-m-d")."_".$dbName.".sql";
        $dumpFileName = "./sql_backup/".$fileName;
        exec("/usr/web/ -u$dbUser -p$dbPwd $dbName > $dumpFileName"); 
    }

    public function add_star(){
        if (IS_POST){
            $model = M('GoodStar');
            if ($model->create()){
                $model->user_id = get_user_id();
                $model->date = time();
                $model->add();
                $this->ajaxReturn(1);
            }else{
                $this->ajaxReturn(0);
            }
        }
    }



    /*
     * 爱心救助详情信息
     */
    public function loveRelife()
    {
        $id = I('get.id', 0, 'intval');
        if ($id == 0) {
            $this->error("参数错误");
        }
        //项目信息
         $itemInfo =  M('Rescue')->find($id);
         //判断是否已经结束
         $shengxia = overplus_time($itemInfo['create_date']);
         if ($shengxia <= 0) {
            M('Rescue')->save(array('status'=>4,'id'=>$itemInfo['id']));
            $this->error('项目已结束',U('index/index'));
         }

         $this->personInfo = M('Member')->find(get_user_id());
     	 $personalImgIdString = $itemInfo['personal_img'];
        if ($personalImgIdString) {
            //个人病例图片信息
            $this->imgArray = M('Images')->where(array('id' => array('in', $personalImgIdString)))->select();
        }
        //关注
        $this->follow = M('Follow')->where(array('user_id' => get_user_id(), 'item_id' => $id, 'type' => 1))->find();
        //帮助list
        $donorList = M('Donor')->where(array('item_id' => $id, 'type' => 1))->order('date desc')->select();
        foreach ($donorList as $key => &$value) {
                $value['comments']=  M('Comments')->where(array('type'=>1,'donor_id'=>$value['id']))->order('date desc')->select();
        }
        $this->top3 = M('Donor')->where(array('item_id' => $id, 'type' => 1))->order('price desc')->limit(3)->select();
        $this->assign('donorList', $donorList);
        $this->itemInfo =  M('Rescue')->find($id);
        $this->display();
    }


    public function report(){
        if (IS_GET){
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
            //判断用户再次进到该页面 是修改而不是添加。
            $model = M('Report');
            if ($model->create()) {
                $model->user_id = get_user_id();
                $model->img = $img_arr;
                $model->date = time();
                    $model->user_id = get_user_id();
                    $model->add();
                    $this->ajaxReturn(1);

            }
        }
    }

    /*
     *爱心救助-关注
     *I('post.type') 1的时候代表筹款 2的时候代表梦想清单
     */
    public function follow()
    {
        if (IS_POST) {
            if (I('post.flag') == 'add') {
                $model = M('follow');
                $res = $model->where(array('user_id' => get_user_id(), 'item_id' => I('post.item_id'), 'type' => I('post.type')))->select();
                if (!count($res)) {
                    if ($model->create()) {
                        $model->user_id = get_user_id();
                        $model->type = I('post.type');
                        $model->date = time();
                        $model->add();
                    }
                }

            }
            if (I('post.flag') == 'delete') {
                $model = M('follow');
                $model->where(array('user_id' => get_user_id(), 'item_id' => I('post.item_id'), 'type' => I('post.type')))->delete();
            }

        }
    }


    /*
     * 爱心救助-帮助TA。
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
                $model->type = 1;
                $model->user_id = get_user_id();
                $result = $model->add();
                $this->ajaxReturn($result);
                //$this->redirect('loveRelife', array('id' => $id));
            }
        }
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
            $this->data = M('Donor')->where(array('item_id' => $id, 'type' => 1))->order('price desc')->select();

            $this->display();
        }
        if (IS_POST) {

        }
    }

    /**
     * 评论
     */

    public function comments()
    {

        if (IS_POST) {
            $model = M('Comments');

            //判断用户是否对本项目捐过款
            $item_id= I('post.item_id');
            $type= I('post.type');
            $user_id= get_user_id();
            $judge = M('Donor')->where(array('type'=>$type,'user_id'=>$user_id,'item_id'=>$item_id))->count();
            if ($judge == 0 ){
                $this->ajaxReturn(-1);
            }
            if ($model->create()) {
                $model->user_id = get_user_id();
                $model->date = time();
                $model->add();
            }
        }
    }


    /**
     * 明星慈善活动-
     */
    public function star(){
        //连续捐赠
        //连续转发
        $this->star = M('Star')->select();
        $this->display();
    }

}