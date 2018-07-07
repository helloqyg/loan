<?php

/**
 * 申请模块控制器 
 * @author    qyg
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/13
 */

namespace User\Controller;
use \Com\Data as Model;

class ApplyController extends ApplyBaseController{

	/**
	 * 合同申请以及合同的数据提交
	 * @version 0.11
	 * @author qyg
	 */

	public function index(){
		// 合同申请界面
		if( IS_GET ){
			$uid = get_uid(false);
			//查询已审核成功的订单
			$assign['receipt'] = M('Order')->where(array('uid'=>$uid,'status'=>4))->select();
			foreach ($assign['receipt'] as $key => &$value) {
				$value['url'] = base64_encode('type/'.$value['ad_type'].'/bid/'.$value['bid'].'');
			}

			$assign['booth_num'] = M('Booth')->where(array('id'=>$assign['receipt']['0']['bid']))->find();
			//getFieldByUid
			//M('Apply')->getFieldByUid($uid,'status')
			$info = Model::get_field('Apply',$uid,'uid','status');
			// 如果已经申请过合同
			// if( $info >= 1 ){
			// 	$apply_info = M('Apply')->where(array('uid'=>$uid))->find();
			// 	//dump($apply_info);exit();
			// 	$assign['apply_status'] = $apply_info;
			// 	$assign['title'] = "申请合同";
			// 	dump($assign['apply_status']);
			// 	$this->service->t_show($assign,'success');
			// 	exit();
			// }
			// 未申请合同
			//查询出企业id
			$cid = Model::get_field('member',$uid,'id','cid');
			//通过企业id查询出公司名称
			$assign['company'] = Model::get_field('company',$cid,'id','company_name');
			$assign['title']   = "申请合同";
			$this->service->t_show($assign);
		}

		// 表单提交
		if(IS_POST){
			$model_data['uid'] = get_uid(false);
			$model_data['atime'] = time();
			$result = Model::model_add('apply',$model_data,'add',true);
			$this->is_notice($result);
		}
	}

	/**
	 * 申请合同详细信息填写
	 * @version 20170206
	 * @author qyg
	 */
	public function de_apply(){
		$params = $this->service->decode();
		$type = $params['type'];
		$bid = $params['bid'];
		$uid = get_uid(false);
		if (IS_GET) {
			$cid = Model::get_field('member',$uid,'id','cid');
			$assign['company'] = Model::get_field('company',$cid,'id','company_name');
			$assign['product'] = M('Order')->where(array('uid'=>$uid,'bid'=>$bid,'ad_type'=>$type,'status'=>4))->find();
			$assign['booth'] = M('Booth')->field('booth_num')->find($bid);
			$assign['adver'] = $bid;
			$assign['title']   = "申请合同";
			$this->service->t_show($assign);
		}
		if(IS_POST){
			//改变订单中的合同申请状态
			M('Order')->where(array('uid'=>$uid,'bid'=>$bid,'contract'=>0))->save(array('contract'=>1));
			$order_id = M('Order')->where(array('uid'=>$uid,'bid'=>$bid))->find();
			$model_data['uid'] = get_uid(false);
			$model_data['atime'] = time();
			$model_data['order_id'] = $order_id['id'];
			$ap_count = M('Apply')->where(array('order_id'=>$order_id['id']))->count();
			//防止用户后退之后重复提交,造成多条记录
			if ($ap_count >=1  ) {
				$ap_id = M('Apply')->where(array('order_id'=>$order_id['id']))->find();
				$model_data['id'] = $ap_id['id'];
				$result = Model::model_add('apply',$model_data,'save',true);
			}else{
				$result = Model::model_add('apply',$model_data,'add',true);
			}
			$this->is_notice($result);
		}
	}

	/**
	 * 汇款审核页面
	 * @version 0.11
	 * @author qyg
	 */
	
	public function checks(){
		$map['uid'] = get_uid(false);
		$map['status'] = 0;
		$assign['info']  =  M('Pay')->where($map)->find();
		if( empty($assign['info']) ){
			$this->error('已经审核完毕');
		}
		$assign['title'] = "汇款审核";
		$this->service->t_show($assign);
	}

	/**
	 * 付款成功|订单回执
	 * @version 0.11
	 * @author qyg
	 */

	public function receipt(){
		// 回执id
		$id = I('get.id',0,'intval');
		if( $id == 0 ){
			//查询出已支付和审核完的订单
			$assign['receipt'] = M('Order')->where(array('uid'=>get_uid(false),'status'=>array('neq','1')))->select();
			//删除未支付的订单
			//dump($assign['receipt']);
			$assign['booth_num'] = M('Booth')->where(array('id'=>$assign['receipt']['0']['bid']))->find();
			// M('Order')->where(array('uid'=>get_uid(false),'status'=>1))->delete();
			$assign['count'] = count($assign['receipt']);
			$assign['title'] = "付款回执";
			$this->service->t_show($assign);
		}else{
			$assign['info'] = M('Order')->where(array('id'=>$id))->find();
			$assign['count'] = count($assign['receipt']);
			$assign['title'] = "付款回执";
			$this->service->t_show($assign,'receipt_id');
		}
		
	}

	public function receipt_id2(){
		$id = I('get.id',0,'intval');
		$assign['info'] = M('Order')->where(array('id'=>$id))->find();
		$assign['count'] = count($assign['receipt']);
		$assign['title'] = "付款回执";
		$this->service->t_show($assign,'receipt_id2');
	}
		
	/**
	 * 发票申请
	 * @version 0.11
	 * @author  qyg
	 */

	public function invoice(){
		// 用户ID
		$map['uid'] = get_uid(false);
		// GET方法获取页面
		if( IS_GET ){
			// 判断发票申请是否成功
			if( M('invoice')->where($map)->count()>=1 ){
				$assign['info'] = "对不起，您已经申请过发票了，不能重复申请！";
				$assign['title'] = "发票申请";
				$this->service->t_show($assign,'invoice_status');
			}
			// 发票申请页面
			$order_info = M('Order')->where($map)->find();
			$assign['price'] = $order_info['price'];
			$assign['title'] = "发票申请";
			$this->service->t_show($assign);
		}

		// AJAX 获取提交的表单
		if( IS_AJAX ){
			// 更改Model的数据
			$model_data['uid']  = $uid = get_uid();
			$model_data['time'] = time();
			$model_data['total']= Model::get_field('order',$uid,'uid','price');
			// 添加发票申请信息
			$result = Model::model_add('Invoice',$model_data,'add',true,true);
			if($result){
				echo json_encode(array('status'=>1,'url'=>'/user/apply/pay_status.html'));
			}else{
				echo json_encode(array('status'=>0,'info'=>'申请失败'));
			}
			exit();
		}
	}
}