<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class NewsController extends MainController{

	public function index(){}
	/**
     * 新闻管理页面
     * @author qyg
     */

	public function manage(){
		$News = M('News');
		//获取总数
		$count= $News->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = $News->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->list = $list;
		$this->page = $show;
		$this->display();
	}

	/**
     * 添加新闻方法
     * @author qyg
     */

	public function add(){
		if(IS_GET){
			$this->display();
		}else{
			$newsModel = D('News');
			if (!$newsModel->create()){
				//返回创建信息错误
				$this->error($newsModel->getError());
			}else{
				//修改添加时间
				$newsModel->atime =  $this->getTime($newsModel->atime);
				//返回信息
				$this->notice_info($newsModel->add(),"添加");
			}
		}
		
	}

	/**
     * 删除新闻方法
     * @author qyg
     */

	public function del(){
		if(!IS_AJAX) $this->error("请求错误");
		//获取当前id
		$id = I('get.id','intval');
		if($id == 0){
			$this->error('请求参数错误');
		}else{
			$map['id'] = $id;
		}
		//删除文章
		$News = M('News');
		$status = $News->where($map)->delete(); 
		if($status){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}

	/**
     * 编辑新闻方法
     * @author qyg
     */

	public function edit(){
		if(IS_GET){
			$id = I('get.id',0,'intval');
			if($id == 0){
				$this->error("参数错误");
			}
			$this->id   = $id;
			$this->news = M('News')->find($id);
			$this->display('add');
		}else{
			$newsModel = D('News');
			if (!$newsModel->create()){
				//返回创建信息错误
				$this->error($newsModel->getError());
			}else{
				//修改添加时间
				$newsModel->atime =  $this->getTime($newsModel->atime);
				//返回信息
				$this->notice_info($newsModel->save(),"修改","/admin/news/manage");
			}
		}
		
	}

	/**
     * 上传文件方法
     * @author qyg
     */

	public function fileupload(){
		$config = array(    
			'maxSize'    =>    3145728,    
			'rootPath'   =>    BASE_PATH.'/upload/',    
			'saveName'   =>    array('uniqid',''),    
			'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','xls'),   
			'autoSub'    =>    true,    
			'subName'    =>    array('date','Ymd'),
		);

		$upload = new \Think\Upload($config);	
		$info   =   $upload->upload();
		if(!$info) {       
			$this->error($upload->getError());
		}else{
			$data['url'] = $info['upfile']['savepath'].$info['upfile']['savename'];
			$data['state'] = 'SUCCESS';
			echo json_encode($data);
			exit();
		}
	}

	/**
     * 获取时间的方法
     * @param  string 时间
     * @author qyg
     */

	public function getTime($time){
		if(empty($time)){
			$time = time();
		}else{
			$time = strtotime($time." ".date('H:i:s',time()));
		}
		return $time;
	}

	
}