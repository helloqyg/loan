<?php

/**
 * Application 服务接口a
 *
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/13
 */


namespace Com;

class Service extends \Think\Controller{

	/**
	 * 展位类型
	 */

	CONST BOOTH_TYPE = 1;
	
	/**
	 * 广告类型
	 */

	CONST AD_TYPE = 2;

	/**
	 * 重写模板赋值
	 * @param $assign   array  赋值数组
	 * @param $template string 模版
	 * @author widuu <admin@widuu.com>
	 */

	public function t_show($assign,$template=""){
		// 判断模版复制是否是数组
		if(!is_array($assign)){
			E('Assign must be array');
		}
		// 判断赋值是否为空
		if(empty($assign)){
			E('assign data is empty');
		}
		// 赋值和传递给模版
		$this->assign($assign);
		$this->display($template);
	}

	/**
	 * 订单状态判断
	 * @param  
	 * @author widuu <admin@widuu.com>
	 */

	public function judge($remove_action){
		$where['uid'] = get_uid(false);
		$where['ad_type'] = 1; //展位
		$order_info = M('Order')->where($where)->find();
		// 特定模块操作
		if(!in_array(ACTION_NAME, $remove_action)){
			$reserve = M('Reserve')->where(array('uid'=>get_uid(false)))->find();
			// 是否有订购信息或者申请跳转
			//如果当前用户有展位订单
			if( !empty($order_info) || !empty($reserve) ){
				if(!empty($order_info)){
					//订单里的展位id
					$product_id = $order_info['bid'];
				}else{
					$product_id = $reserve['bid'];
				}
				// 根据类型判断跳转URL
				//$info = "type/{$order_info['ad_type']}/id/{$product_id}";
				$info = "type/1/id/{$product_id}";
				// 跳转url
				$redirect_url = "/user/booth/order/".base64_encode($info);
				$this->redirect($redirect_url);
			}
		}

		//付款检测
		 if( $order_info['status'] == 2  && ACTION_NAME!= 'pay_up' && ACTION_NAME!= 'pay' ){
		 	// 解析URL参数
			$params = $this->decode();
			// 产品id
			$pid  = $params['id'];
			$type = $params['type'];
			// 判断是展位付款还是广告付款，只针对展位付款，添加条件ad_type = 1;
			$order_type = M('Order')->getFieldByBid($pid,'ad_type');
			// dump($order_type);exit();
			if( !empty($order_type) && $order_type!= 2 || $type != 2){
				// 如果是汇款申请的
				if($order_info['type'] == 2){
					//查看付款申请界面
					$status = M('Pay')->where($map)->find();
					// 付款成功了
					if( $status['status'] == 1 ){
						$this->redirect('User/account/booth');
					}else{
						// 未通过审核
						if( $status['type'] == 0 ){
							$this->redirect('User/apply/checks');	
						}
					}
				}else{
					// 已经付款了
					$this->redirect('User/account/booth');	
				}
			}
		 	
		}
	}

	/**
	 * 解析URL
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	public function decode(){
		$url  = explode('/',trim(__SELF__,'/'));
		$info = trim($url[3],'.html');
		$params = explode('/', base64_decode($info)); 
		if( empty(trim($params[1])) || empty(trim($params[3])) ){
			$this->error("参数错误");
		}
		$return[$params[0]] = $params[1];
		$return[$params[2]] = $params[3];
		$return[$params[4]] = $params[5];
		return $return;
	}
	
		/**
	 * 解析广告idURL  -特殊
	 * @version 0.11
	 * @author  widuu <admin@widuu.com>
	 */

	public function ad_decode($url){
		$info = trim($url,'.html');
		$params = explode('/', base64_decode($info)); 
		if( empty(trim($params[1])) || empty(trim($params[3])) ){
			$this->error("参数错误");
		}
		$return[$params[0]] = $params[1];
		$return[$params[2]] = $params[3];
		$return[$params[4]] = $params[5];
		return $return;
	}
}