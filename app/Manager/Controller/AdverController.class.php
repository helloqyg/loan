<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class AdverController extends MainController{

	/**
	 * 广告列表
	 * @author widuu <admin@widuu.com>
	 */

	public function index(){
		$count= M('Adver')->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = M('Adver')->order('id')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->list = $list;
		$this->page = $show;
		$this->display();
	}

	/**
	 * 添加|修改广告
	 * @author widuu <admin@widuu.com>
	 */

	public function add(){
		$adver_model = M('Adver');
		// 显示页面
		if( IS_GET ){
			//修改广告
			$product_id = I('get.id',0,'intval');
			if( $product_id!=0 ){
				$this->news = M('Adver')->find($product_id);
				$this->id   = $product_id;
			}
			// 添加广告
			$this->display();
		}
		// 提交数据
		if( IS_POST ){
			// 如果是添加数据
			if( I('post.id',0,'intval') ==0 ){
				if( $adver_model->create() ){
					$adver_model->add_user = get_uid(true);
					$adver_model->add_time = time();
					if( $adver_model->add() ){
						$this->success('添加成功');
					}else{
						$this->error('添加失败');
					}
				}else{
					$this->error($adver_model->getError());
				}
			}else{
				//修改数据
				if( $adver_model->create() ){
					$adver_model->add_time = time();
					if( $adver_model->save() ){
						$this->success('修改成功');
					}else{
						$this->error('修改失败');
					}
				}else{
					$this->error($adver_model->getError());
				}
			}
		}
	}

	/**
	 * 删除广告
	 * @author qyg
	 */ 	

	public function del(){
		$id = I('post.id',0,'intval');
		$flag = I('post.flag');
		//删除区域
		if ($flag == 'area') {
		 	$result = M('AdArea')->delete($id);
		 }
		 //删除类型
		if ($flag == 'type') {
		 	$result = M('AdLocaleType')->delete($id);
		 }
		  //删除地址
		if ($flag == 'address') {
		 	$result = M('AdAddress')->delete($id);
		 }
		   //删除商品
		if ($flag == 'goods') {
			$addressInfo = M('AdAddress')->where(array('goods_id'=>$id))->count();
			if($addressInfo !=0){
				echo 0;
			}else{
				$result = M('AdGoods')->delete($id);
				echo 1;
			}
		 	
		 }
	}

	/**
	 *展现广告列表
	 *@author qyg
	 *@date 20170310
	 */
	public function adlist(){
		$this->data = M('AdGoods')->order('goods_id desc')->select();
		$this->display();
	}

	/**
	 *广告的位置列表
	 *@author qyg
	 *@date 20170310
	 */

	public function addresslist(){
		$id = I('get.id',0,'intval');
		$this->addressName = M('AdGoods')->find($id);
		if ($id == 0) $this->error('参数错误');
		$this->data = M('AdAddress')->where(array('goods_id'=>$id))->select();
		$this->display();
	}

	/**
	 *区域列表
	 *@author qyg
	 *@date 20170310
	 */
	public function area(){
		$this->data = M('AdArea')->select();
		$this->display();
	}
	/**
	 *广告搜索
	 *@author qyg
	 *@date 20170313
	 */

	public function adver(){
	//$where['hid'] = $id = I('get.id');
	$key = trim($_GET['key']);
	if ($key == '') {
		$where = "";
	}else{
		$where="goods_name like '%$key%'";
	}
	$adver_model = M('AdGoods');
	//获取数据
	$this->data = $adver_model->where($where)->order('goods_id')->select();
	$this->booth_title = M('Hall')->getFieldById($id,'hall_num');
	//$this->list = M('Booth')->where($where)->select();
	$this->display('adlist');
}

	


	/** 
	 *类型列表
	 *@author  qyg
	 *@date 20170310
	 */
 	public function type(){
 		$this->data = M('AdLocaleType')->select();
 		$this->display();
 	}

 	/** 
	 *修改|添加 广告
	 *@author  qyg
	 *@date 20170310
	 */

 	public function change_list(){
 		if (IS_GET) {
	 		$id = I('get.id');
	 		//信息
			$this->data = M('AdGoods')->find($id);
			//分类
			$this->type = M('AdLocaleType')->select();
			//区域
			$this->area = M('AdArea')->select();
	 		$this->display();
 		}
 		if (IS_POST) {
 			$goodsModel = M('AdGoods');
 			//添加广告
 			if (I('post.goods_id',0,'intval') == 0) {
 				if ($goodsModel->create()) {
					$goodsModel->add_time = time();
 					if ($goodsModel->add()) {
 						$this->success('修改成功');
 					}else{
 						$this->error('修改失败');
 					}
 				}else{
 					$this->error($goodsModel->getError());
 				}
 			}else{
 			//修改广告
	 			if ($goodsModel->create()) {
	 				$goodsModel->add_time = time();
	 				if ($goodsModel->save()) {
	 					$this->success('修改成功');
	 				}else{
	 					$this->error('修改失败');
	 				}
	 			}else{
	 				$this->error($goodsModel->getError());
	 			}
 			}
 		
 		}
 		
 	}

 	 /** 
	 *修改|添加 类型
	 *@author  qyg
	 *@date 20170310
	 */

 	public function change_type(){
 		if (IS_AJAX) {
			$name = I('post.v');
			$flag = I('post.flag');
			//ae_id
			$tp_id = I('post.attr');
			//添加
			if ($flag == 1) {
				M('AdLocaleType')->add(array('tp_name'=>$name,'tp_time'=>time()));
			}else{
				//修改
				M('AdLocaleType')->where(array('tp_id'=>$tp_id))->save(array('tp_name'=>$name));
			}
		}
 	}

	/**
	 *添加|添加区域
	 *@author qyg
	 *@date 20170310
	 */
	public function change_area(){
		if (IS_AJAX) {
			$name = I('post.v');
			$flag = I('post.flag');
			//ae_id
			$ae_id = I('post.attr');
			//添加
			if ($flag == 1) {
				M('AdArea')->add(array('ae_name'=>$name,'ae_time'=>time()));
			}else{
				//修改
				M('AdArea')->where(array('ae_id'=>$ae_id))->save(array('ae_name'=>$name));
			}
		}
	}

	/**
	 *添加|添加详细地址
	 *@author qyg
	 *@date 20170310
	 */

	public function change_address(){
		if (IS_GET) {
			$id = I('get.id',0,'intval');
			$goods_id = I('get.goods_id',0,'intval');
			if ($id == 0){

			}else{
				$this->data = M('AdAddress')->find($id);
				$this->goods_name = M('AdGoods')->find($goods_id);
				$this->address_name = M('AdAddress')->find($id);
			}
				$this->display();
		}
		if (IS_POST) {
 			$addressModel = M('AdAddress');
 			//添加广告
 			if (I('post.ar_id',0,'intval') == 0) {
 				if ($addressModel->create()) {
					$addressModel->time = time();
 					if ($addressModel->add()) {
 						$this->success('添加成功');
 					}else{
 						$this->error('添加失败');
 					}
 				}else{
 					$this->error($addressModel->getError());
 				}
 			}else{
 			//修改广告
	 			if ($addressModel->create()) {
	 				$addressModel->time = time();
	 				if ($addressModel->save()) {
	 					$this->success('修改成功');
	 				}else{
	 					$this->error('修改失败');
	 				}
	 			}else{
	 				$this->error($addressModel->getError());
	 			}
 			}
 		
 		}
	}

	public function change_special(){
		$this->display();
	}

	/**
	 *查看订单
	 *@author qyg
	 *@date 20170310
	 */
	public function trade(){
		$trade_model = M('Order');
		$count= $trade_model->count();
		$Page = new \Common\Util\Page($count,12);
		$show = $Page->show();
		//获取数据
		$list = $trade_model->where(array('status'=>4,'ad_type'=>2))->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->list = $list;
		$this->page = $show;
		//$this->list = M('Booth')->where($where)->select();
		$this->display();
	}

	/**
	 *合同申请
	 *@author qyg
	 *@date 20170310
	 */
	public function apply(){
		$this->apply = M('Apply')->order('status asc ,id desc')->where(array(''))->select();
		$this->display();
	}

	/**
	 *无需购买展位即可购买广告 -权限
	 *@author qyg
	 *@date 20170313
	 */

	public function rbac(){
		if (IS_GET) {
			$this->data = M('Member')->where(array('is_exhi'=>1))->select();
			$this->display();
		}
		if (IS_AJAX) {
			$id = I('post.id');
			M('Member')->where(array('id'=>$id))->save(array('is_exhi'=>0));
		}
	}

	/**
	 *添加购买权限 -用户
	 *@author qyg
	 *@date 20170313
	 */

	public function add_exhi_power(){
		if (IS_AJAX) {

			$id = I('post.v');
			$data = M('Member')->where(array('username'=>$id))->find();
			if ($data) {
				 M('Member')->where(array('username'=>$id))->save(array('is_exhi'=>1));
				echo json_encode($data);
			}else{
				//没有该用户
				echo 0; 
			}
		}
	}

}//类


