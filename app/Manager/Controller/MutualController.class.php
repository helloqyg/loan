<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/06/11
 */

namespace Manager\Controller;
use Common\Util\Page;
class MutualController extends MainController {

    public function index(){
    	$this->user = M('Member')->count();
    	$this->display();
    }


    //轻松互助 列表
    public function item_list(){
        $title = I('get.title');
        $count = M('HomeMutual')->count();
        $Page = new Page($count, 15);
        $show = $Page->show();
        $this->page = $show;
        $sql = "select * from wd_home_mutual where 1=1";
       
        $sql .= " and title like '%{$title}%' order by create_date desc  limit  {$Page->firstRow} , {$Page->listRows}  ";
        $this->result = M('HomeMutual')->query($sql);
        // dump($this->result);
        $this->display();
    }



     /**
     * 编辑信息
     */

    public function edit()
    {
        if (IS_GET) {
            $this->header='轻松互助';
            $id = I('get.id', 0, 'intval');
            // if ($id == 0) $this->error('参数错误');
            $result = M('HomeMutual')->find($id);
           
          
            $this->result =  $result;
            $this->display();
        }


        if (IS_POST) {
            if (!I('post.id')) {
             //添加
                $model = M('HomeMutual');
                if ($model->create()) {
                    $model->create_date = time();
                    $model->add();
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(0);
                }
            }else{
                //修改
                $model = M('HomeMutual');
                if ($model->create()) {
                    $model->save();
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(0);
                }
                //$result = $model->data($data)->add();
            }
        }
    }

}
