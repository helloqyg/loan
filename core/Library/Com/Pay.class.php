<?php

/**
 * Application 支付服务接口
 *
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/14
 */

namespace Com;
header("Content-type:text/html;charset=utf-8");

class Pay extends \Think\Controller{

	/**
	 * 付款的类型
	 */

	private $type = null;

	/**
	 * 用户id
	 */

	private $user_id = null;

	/**
	 * 订单Model
	 */

	private $order_model;

	/**
	 * 产品Model
	 */

	private $product_model = null;

	/**
	 * 付款方式
	 */

	private $pay_type = null;


	/**
	 * 实列化全局使用参数
	 * @version 0.11
	 * @author widuu <admin@widuu.com>
	 */

	public function __construct(){
		$this->type = C('PAY_TYPE');
		$this->user_id = get_uid(false);
		$this->order_model = M('Order');
	}
	/**
	 * 支付模块
	 * @param $pay_type 	 int  支付方式
	 * @param $type  		 int  支付类型
	 * @
	 */

	public function pay($pay_type,$type,$product_id){
		// 验证参数的合法性
		if( $pay_type ==0 || $type ==0 || $product_id == 0 ){
			//$this->error('非法请求');
		}
		//付款类型
		$this->pay_type = $pay_type;
		// 获取产品模型
		$model_type = $this->type[$type];
		$this->product_model = M(ucfirst($model_type));
		// 添加产品
		$this->add_order($product_id,$model_type); 
	}

	/**
	 * 添加到Order订单
	 * @param $product_id  int   	产品ID
	 * @param $model_type  string   订单模型
	 */

	private function add_order($product_id,$model_type){
		// 用户id
		$map['uid']  = $this->user_id;
		// 类型为展位
		//$map['ad_type'] = 1;
		$where['bid'] = $product_id;
		$order_count = M('Order')->where($map)->count();
		//dump($order_count);exit();
		// 如果有老订单失效
		if($order_count >=1 ){
			// 获取产品ID 并恢复产品的初始化状态
			//$data['id'] = $this->order_model->getFieldByUid($uid,'bid');
			$data['id']     = $product_id;
			$data['status'] = 1;
			$data['uid']    = '';
			$data['time']   = '';
			$a = $this->product_model->save($data);
			// 删除原有订单
			$this->order_model->where($where)->delete();
		}
		// 删除原有订单
		$this->order_model->where($where)->delete();
		// 获取产品信息
		$product_info = $this->product_model->find($product_id);
		// 根据支付类型不同，调用不同的支付方法
		$order_data = $this->{$model_type."_pay"}($product_id,$product_info);
		// 添加订单
		$result = $this->order_model->add($order_data);
		// 订单添加失败，返回错误信息
		if( !$result ) $this->error('购买失败');
		// 更新产品状态信息
		/*$update_product = $this->product_model->where(array('id'=>$product_id))->save(
				array('status'=>2,'uid'=>$this->user_id,'time'=>time())
			);
		// 更新展位失败
		if( !$update_product ){
			$this->order_model->delete($result);
			$this->error('购买失败');
		}*/
		// 支付
		$this->judge_pay($order_data,$product_info);
	}

	/**
	 * 根据支付类型进行支付判断
	 * @param   $order_data    array  订单数据
	 * @param   $product_info  array  产品数据
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	private function judge_pay($order_data,$product_info){
		// 汇款支付
		if( $this->pay_type == 2 ){
			$this->ajaxReturn(array('url_model'=>2));
			exit();	
		}
		// 支付宝支付
		$pay = new \Common\Util\Alipay(); 
		if($order_data['ad_type'] == 1){
			$pay_body = "2018中国国际电梯展览会".strtoupper($product_info['booth_num'])."号展位订购";
			$payurl   = C('WEBSITE_URL').'/user/booth/order/id/'.$order_data['bid'].'.html';
		}else{
			$pay_body = "2018中国国际电梯展览会{$product_info['title']}广告订购";
			$payurl   = C('WEBSITE_URL').'/user/adver/order/id/'.$order_data['bid'].'.html';
		}
		// 支付宝输出
		$payurl = $pay->Pay($order_data['out_trade_no'],$order_data['price'],$pay_body,$payurl);
		$this->success($payurl);
		exit();
	}

	/**
	 * 展位支付
	 * @param   $product_id   int    产品ID
	 * @param   $product_info array  产品信息
	 * @return  array 				 添加订单数据
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	public function booth_pay($product_id,$product_info){
		// 可变的参数属性
		$post_data['area']    = $product_info['area'];
		$post_data['price']   = $product_info['price'];
		$post_data['remark']  = I('post.remark','','trim');
		$post_data['ad_type'] = 1;
		// 添加到订单的参数
		$order_data = array_merge($post_data, $this->get_common_info($product_id));
		return $order_data;
	}

	/**
	 * 广告支付 支付宝支付
	 * @param   $product_id   int    产品ID
	 * @param   $product_info array  产品信息
	 * @return  array 				 添加订单数据
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	public function AdAddress_pay($product_id,$product_info){
		$post_data['price']   = $product_info['ar_price'];
		$post_data['remark']  = I('post.remark','','trim');
		$post_data['ad_type'] = 2;
		// 添加到订单的参数
		$order_data = array_merge($post_data, $this->get_common_info($product_id));
		return $order_data;
	}
	/**
	 * 广告支付   汇款凭证支付
	 * @param   $product_id   int    产品ID
	 * @param   $product_info array  产品信息
	 * @return  array 				 添加订单数据
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */
		public function adver_pay($product_id,$product_info){
		$post_data['price']   = $product_info[0]['ar_price'];
		$post_data['remark']  = I('post.remark','','trim');
		$post_data['ad_type'] = 2;
		// 添加到订单的参数
		$order_data = array_merge($post_data, $this->get_common_info($product_id));
		return $order_data;
	}

	/**
	 * 订单公共信息
	 * @param   $product_id Int 产品ID
	 * @return  array  			公共产品参数
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	private function get_common_info($product_id){
		return array(
			'bid'	 => $product_id,
			'uid'	 => $this->user_id,
			'status' => 1,
		  	'atime'  => time(),
		  	'type'	 => $this->pay_type,
			'out_trade_no' => 'TT'.date('Ymdhis',time()).$this->user_id,
		);
	}
}
