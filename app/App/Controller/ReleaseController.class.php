<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class ReleaseController extends BaseController
{

    public function index()
    {
        $this->display();
    }


    /**
     *发布筹款
     *
     */

    public function choukuan()
    {
        if (IS_GET) {
            //通过userId和status<4 如果查到信息就把id分配到页面
            //判断当前用户是否填写过信息，并且没有结束
            $condition1 = M('Rescue')->where(array('user_id' => get_user_id(), 'status' => array('lt', '4')))->find();
            $condition3 = M('Rescue')->select();
            if (!$condition1) {
                $this->display();
                return;
            }
            //查询出头像
            $imgIdString = $condition1['personal_img'];
//            $imgIdArr = explode(',',$imgIdString);
//            array_shift($imgIdArr);
            if ($imgIdString) {
                $imgArray = M('Images')->where(array('id' => array('in', $imgIdString)))->select();
            }
            //查询出信息并展示
            $this->assign('result', $condition1);
            $this->assign('imgArray', $imgArray);
            $this->display();
        }
        if (IS_POST) {
            $imgArray = I('post.array');
            if ($imgArray) {
                $img_arr = '';
                foreach ($imgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $img_arr .= ',' . $img_id;
                }

            }
            //判断用户再次进到该页面 是修改而不是添加。
            $model = M('Rescue');
            if ($model->create()) {
                $model->status = 0;
                $model->user_id = get_user_id();
                $model->personal_img = $img_arr;
                if (I('post.id') != '') {
                    $model->user_id = get_user_id();
                    $model->save();
                    $id = I('post.id');
                } else {
                    $id = $model->add();

                }
                if ($id) {
                    echo $id;
                } else {
                    echo 0;
                }

            }
            //$this->redirect('step2',array('id'=>$id));
        }
    }

    /**
     *发布筹款第二步
     *
     */

    public function step2()
    {
        if (IS_GET) {
            $id = I('get.id', 0, 'intval');
            if ($id == 0) {
                $this->error('参数错误');
            }

            //查询出头像
            $condition1 = M('Rescue')->find($id);
            $imgIdString = $condition1['company_img'];
            //如果图片不为空，页面显示出来
            if ($imgIdString) {
                $this->imgArray = M('Images')->where(array('id' => array('in', $imgIdString)))->select();
            }

            //用户数据
            $this->result = M('Rescue')->find($id);
            //组织信息
            $this->organInfo = M('Organization')->select();

            $this->display();
        }
        if (IS_POST) {
            $imgArray = I('post.array');
            if ($imgArray) {
                $img_arr = '';
                foreach ($imgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $img_arr .= ',' . $img_id;
                }

            }
            //判断用户再次进到该页面 是修改而不是添加。
            $model = M('Rescue');
            if ($model->create()) {
                $model->status = 0;
                $model->company_img = $img_arr;
                if (I('post.id') != '') {
                    $model->save();
                    $id = I('post.id');
                }
                if ($id) {
                    echo $id;
                } else {
                    echo 0;
                }

            }
            //$this->redirect('step2',array('id'=>$id));
        }
    }


    /**
     *发布筹款第三步
     *
     */

    public function step3()
    {
        if (IS_GET) {
            $id = I('get.id');
            $this->commitInfo = M('Committee')->select();
            $this->result = M('Rescue')->find($id);
            $this->display();
        }
        if (IS_POST) {
            $model = M('Rescue');
            if ($model->create()) {
                $model->create_date = time();
                $model->status = 1;
                $model->save();
            }
           $this->redirect('share',array(id=>I('post.id')));
        }
    }


    /**
     * 分享给好友填写权威认证信息
     */
    public function share(){
        if (IS_GET){
            $id = I('get.id');
            $this->witness = M('Witness')->where(array('item_id'=>$id))->count();
            $this->result = M('Rescue')->where(array('status'=>1))->find($id);
            $this->display();
        }
        if (IS_POST){
            $model = M('Witness');
            if ($model->create()){
                $model->date = time();
                $model->user_id = get_user_id();
                $model->where(array('user_id'=>get_user_id(),'item_id'=>I('post.item_id')))->delete();
                if ($model->add()){

                    $wit_count = $model->where(array('item_id'=>I('post.item_id')))->count();
                    if ($wit_count >=2){
                        M('Rescue')->where(array('item_id'=>I('post.item_id')))->save(array('status'=>2));
                    }
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(0);
                }
            }
        }
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