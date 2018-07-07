<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class StarController extends MainController {

    public function index(){
       $this->list =  M('Star')->select();
        $this->display();
    }


    /**
     * 修改/添加
     * 有id时为修改，没id时为添加
     */


    public function  add(){
        if (IS_GET){
            $this->header='明星慈善';
            $id = I('get.id',0,'intval');
            $this->result = M('Star')->find($id);
            $this->display();
        }
        if (IS_POST){
            $model = M('Star');
            if (I('post.id')){
                if ($model->create()){
                    $model->save();
                    $this->ajaxReturn(1);
                }else{
                    $this->ajaxReturn(0);
                }
                //$result = $model->data($data)->add();

            }else{
                if ($model->create()){
                    $model->create_date = time();
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
        if( M('Star')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }

}
