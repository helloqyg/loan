<?php

/**
 * 后台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace Manager\Controller;

class InvoiceController extends MainController{
	
	/**
 	 * backstage invoice module
 	 * @author qyg
 	 */

	public function index(){
		$this->invoice = M('Invoice')->order('status desc')->select();
		$this->display();
	}

	/**
	 * invoice show 
	 * @author qyg
	 */

	public function show(){
		if( IS_GET ){
			$id = I('get.id',0,'intval');
			if( $id == 0 ) $this->error('参数错误');
			$this->id      = $id;
			$this->invoice = M('Invoice')->find($id);
			$this->display();
		}else{
			$invoice_model = M("Invoice");
			if( $invoice_model->create() ){
				if( $invoice_model->save() ){
					$this->success('开票成功','manager/invoice/index');
				}else{
					$this->error('开票失败');
				}
			}else{
					$this->error('开票失败');
			}
		}
	}

	/**
	 * apply 
	 * @author qyg
	 */

	public function apply(){
		$this->apply = M('Pay')->alias('p')
						->field('h.hall_num,b.booth_num,b.area,b.hall_area,p.*')
						->join('left join wd_booth as b on b.id=p.pid')
						->join('left join wd_hall as h on h.id=b.hid')
						->order('p.status asc,p.id desc')
						->select();
		$this->display();
	}

	/**
	 * invoice show 
	 * @author qyg
	 */

	public function ashow(){
		$id = I('get.id',0,'intval');
		if( IS_GET ){
			if( $id == 0 ) $this->error('参数错误');
			$this->id      = $id;
			$this->invoice = M('Pay')->find($id);
			$this->display();
		}else{
			$info = M('Pay')->find($id);
			$model = M('Pay');
			//展位-------------------------------------------------------------------------------------------------------
			if ($info['type'] == 0) {
			if( $model->create() ){
					if( $model->status == 1){
							//booth_num
							$booth = M('Booth')->where(array('id'=>$info['pid']))->find();
							//展馆
							$hid = M('Hall')->where(array('id'=>$booth['hid']))->field('hall_num')->find();
							//订单号
							$orderId = M('Order')->where(array('bid'=>$booth['id']))->field('out_trade_no')->find();
							$sub  = array('%company_name%'=>array($info['company']),'%booth_num%'=>array($booth['booth_num']),'%hid%'=>array($hid['hall_num']),'%orderId%'=>array($orderId['out_trade_no']),'%price%'=>array($booth['price']));
							$cid = M('Member')->getFieldById($info['uid'],'cid');
							$user_email = array(M('Company')->getFieldById($cid,'f_email'));
							$email  = array(get_config('PRODUCT_EMAIL'));
							\Sendcloud\Send::send_template('team@elevator-expo.com',$sub,$email,'汇款审核通过通知','finance_pass','','','','','',true,false,false);
							$result = \Sendcloud\Send::send_template('team@elevator-expo.com',$sub,$user_email,'汇款审核通过通知','finance_pass','','','','','',true,false,false);
							$save_pay =  $model->where(array('id'=>$id))->save(array('status' =>1));
							$data = M('Pay')->where(array('id'=>$id))->field('pid,uid')->find();
							$save_order = M('Order')->where(array('uid'=>$data['uid'],'bid'=>$data['pid']))->save(array('status'=>4));
							// dump($save_order);
							// echo M('')->getlastSql();die;
							if($save_pay && $save_order){
								$this->success('审核通过','manager/invoice/apply');
							}else{
								$this->error('审核失败');
							}

					}else{
						$pid = M('Pay')->where(array('id'=>$id))->field('product_id')->find(); //获得订单id
						//删除订单表
						M('Order')->where(array('bid'=>$pid['product_id']))->delete();
						//改变摊位booth状态
						M('Booth')->where(array('id'=>$pid['product_id']))->save(array('status'=>1,'uid'=>'','time'=>''));
						//删除审核表
						M('Pay')->delete($id);
						$this->success($pid['product_id'],'Manager/invoice/apply');
					}
				
			}else{
					$this->error('审核失败');
			}
		}else{
			//广告 -------------------------------------------------------------------------------------------------------------------------
			if( $model->create() ){
					if( $model->status == 1){
							//订单号
							$orderId = M('Order')->where(array('bid'=>$info['pid']))->field('out_trade_no,price')->find();
							//adver name
							$address_array = $info['pid'];
							//参数转为数组
							$address_array = explode(',', $address_array);
							array_pop($address_array);
							$addressId = M('AdAddress')->where(array('ar_id'=>$address_array['0']))->find();
							$goodsName = M('AdGoods')->where(array('goods_id'=>$addressId['goods_id']))->find();
							$sub  = array('%company_name%'=>array($info['company']),'%booth_num%'=>array($goodsName['goods_name']),'%hid%'=>array($info['pid']),'%orderId%'=>array($orderId['out_trade_no']),'%price%'=>array($orderId['price']));
							$cid = M('Member')->getFieldById($info['uid'],'cid');
							$user_email = array(M('Company')->getFieldById($cid,'f_email'));
							$email  = array(get_config('PRODUCT_EMAIL'));
							\Sendcloud\Send::send_template('team@elevator-expo.com',$sub,$email,'汇款审核通过通知','finance_pass','','','','','',true,false,false);
							$result = \Sendcloud\Send::send_template('team@elevator-expo.com',$sub,$user_email,'汇款审核通过通知','ad_examine','','','','','',true,false,false);
							//修改pay表status为已审核
							$save_pay =  $model->where(array('id'=>$id))->save(array('status' =>1));
							$data = M('Pay')->where(array('id'=>$id))->field('pid,uid')->find();
							//修改订单表status为汇款审核成功
							$save_order = M('Order')->where(array('uid'=>$data['uid'],'bid'=>$data['pid']))->save(array('status'=>4));
							// dump($save_order);
							// echo M('')->getlastSql();die;
							if($save_pay && $save_order){
								$this->success('审核通过','manager/invoice/apply');
							}else{
								$this->error('审核失败');
							}

					}else{
						$pid = M('Pay')->where(array('id'=>$id))->field('pid')->find(); //获得订单id
						//删除订单表
						M('Order')->where(array('bid'=>$pid['pid']))->delete();
						//改变广告位置表状态
						$address_array = $info['pid'];
						$address_array = explode(',', $address_array);
						array_pop($address_array);
						M('AdAddress')->where(array('ar_id'=>array('in',$address_array)))->save(array('ar_status'=>0,'add_time'=>''));
						//删除审核表
						M('Pay')->delete($id);
						$this->success($pid['product_id'],'Manager/invoice/apply');
					}
				
			}else{
					$this->error('审核失败');
			}
		}
 	}






	}
}