<?php

/**
 * foot底部用户使用指南
 * @author       qyg 
 * @version      0.1
 * @date      	 2017/02/24
 */

namespace User\Controller;
use Think\Controller;

class HelpController extends Controller {
	/**
	 * 新手指导 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function novice(){
		$this->display();
	}

	/**
	 * 操作手册 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function manual(){
		$this->display();
	}

	/**
	 * 预订流程 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function process(){
		$this->display();
	}
	
	/**
	 * 新闻列表 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function news(){
		$this->count = M('News')->count();
		$Page = new \Common\Util\Page($this->count,10);
		$show = $Page->show();
		// Get user data list 
		$list = M('News')->limit($Page->firstRow.','.$Page->listRows)->order('id desc')->select();
		$this->list = $list;
		$this->page = $show;
		$this->display();
	}

	/**
	 * 新闻详情 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function news_detail(){
		$id = I('get.id',0,'intval');
		if($id == 0)$this->error('参数错误');
		$this->detail = M('News')->where(array('id'=>$id))->find();
		$this->display();
	}
	
	
	/**
	 * 账户密码 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function account(){
		$this->display();
	}

	/**
	 * 资料下载 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function download(){
		$this->display();
	}

	/**
	 * 联系我们 
	 * @author qyg
	 * @date 2017/02/24
	 */
	public function contact(){
		$this->display();
	}
}