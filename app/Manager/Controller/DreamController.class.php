<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class DreamController extends MainController{
	
	/**
 	 * backstage invoice module
 	 * @author qyg
 	 */

	public function index(){
        $this->header_title='梦想清单-列表';
        $this->dreamType = M('DreamType')->select();
        //搜索功能
        $title = I('get.title');
        $is_top = I('get.is_top');
        $type = I('get.type');
        $min_money = I('get.min_money', '0', 'intval');
        $max_money = I('get.max_money', 9999999999, 'intval');
        $status = I('get.status');
        if ($max_money == '') $max_money = 9999999999;
        $count = M('Dream')->count();
        $Page = new \Common\Util\Page($count,15);
        $show = $Page->show();
        $this->page = $show;
        $sql = "select * from wd_dream where target_money between {$min_money} and {$max_money} ";
        //如果status为空代表查询全部
        if ($status != '') $sql .= " and status = {$status}  ";
        if ($is_top != '') $sql .= " and is_top = {$is_top}  ";
        if ($type != '') $sql .= " and type = {$type}  ";
        $sql .= " and title like '%{$title}%' order by date desc  limit  {$Page->firstRow} , {$Page->listRows}  ";
        $this->list = M('Dream')->query($sql);


//        $count = M('Dream')->count();
//        $Page = new \Common\Util\Page($count,15);
//        $show = $Page->show();
//        $this->page = $show;
//        $this->list = M('Dream')->order('date desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->display();
	}



    public function edit(){
        if( IS_GET ){
            $this->header='梦想清单';
            $this->id   = $id = I('get.id');
            $result = M('Dream')->find($id);
            //如果图片不为空，页面显示出来
            $imgIdString = $result['img'];
            if ($imgIdString) {
                $this->imgArray = M('Images')->where(array('id' => array('in', $imgIdString)))->select();
            }
            //项目类型
            $this->type = M('DreamType')->select();
            $this->assign('result',$result);
            $this->display('add');
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
                $model->img = $img_arr;
                if ( $model->save()){
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
        if( M('Dream')->delete($id) ){
                $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }

    public function del_type(){
        $id = I('get.id',0,'intval');
        if( $id == 0 ) $this->error('参数错误');
        if( M('DreamType')->delete($id) ){
            $this->success('删除成功');

        }else{
            $this->error('删除失败');
        }
    }

    public function typeAdd(){
        if (IS_GET){
            $this->data = M('DreamType')->find(I('get.id'));
            $this->display();
        }

        if (IS_POST){
            $model = M('DreamType');
            $id = I('post.id');
            if ($model->create()){
                if ($id){
                    $model->save();
                    $this->success('操作成功');
                }else{
                    $model->add();
                    $this->success('操作成功');
                }
            }else{
                $this->error('操作失败');
            }
        }

    }

    /**
     * 分类
     */
    public function type(){
        $this->header_title='梦想清单-分类列表';
        $this->result = M('DreamType')->select();
        $this->display();
    }



























    public function add(){
        if( IS_GET ){
            $this->display();
        }

        if( IS_POST ){
            $model = M('Dream');
            if( $model->create() ){
                $model->update_time = time();
                $result = $model->add();
                if( $result ){
                    $this->success('添加成功','manager/chart/hall');
                }else{
                    $this->error('添加失败');
                }
            }else{
                $this->error('创建数据失败');
            }
        }
    }



}