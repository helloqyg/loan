<?php

/**
 * 前台支付
 * @author       widuu <admin@widuu.com>
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/07/27
 */

namespace App\Controller;
//加载支付宝
header('Content-type:text/html;charset=utf-8');
require_once(BASE_PATH."/app/Common/Util/lib/alipay_notify.class.php");

class PayController extends  \Think\Controller{

	private $alipay_config;

	/**
	 * 初始化方法
	 * @author widuu <admin@widuu.com>
	 */

	public function _initialize(){
		$alipay_config = C('ALIPAY_CONFIG');
		$alipay_config["partner"] 			= C('PARTNER');
		$alipay_config['key']				= C('ALIKEY');
		unset($alipay_config['payment_type']);
		$this->alipay_config = $alipay_config;
	}

	/**
	 * 支付确认
	 * @author widuu <admin@widuu.com>
	 */

	public function return_url(){
		//

		$alipayNotify = new \AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {
			//订单号
			$out_trade_no = $_GET['out_trade_no'];
			//支付宝交易号
			$trade_no = $_GET['trade_no'];
			//交易状态
			$trade_status = $_GET['trade_status'];
			//买家支付宝账号
			$buyer_email  = $_GET['buyer_email'];
    		if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
    			$map['id'] = M('Order')->getFieldByOutTradeNo($out_trade_no,'id');	
    			$data['status'] = 2;
    			$data['buyer_email'] = $buyer_email;
    			$data['trade_no']	 = $trade_no;
    			$data['ptime']	 = time();
    			$result = M('Order')->where($map)->save($data);
    			if($result){
    				$this->success('支付成功','/user/pay/success');
    			}else{
    				$this->error('支付失败');
    			}
    			
  			}else {
		     	echo "trade_status=".$_GET['trade_status'];
		    }
				//echo "验证成功<br />";
		}else{
		    echo "验证失败";
		}
	}

	/**
	 * 支付异步通知
	 * @author widuu <admin@widuu.com>
	 */

	public function notify_url(){
		if(IS_GET){
			exit();
		}
		$alipayNotify = new \AlipayNotify($this->alipay_config);
		$verify_result = $alipayNotify->verifyReturn();
		if($verify_result) {//验证成功
			//订单号
			$out_trade_no = $_POST['out_trade_no'];
			//支付宝交易号
			$trade_no = $_POST['trade_no'];
			//交易状态
			$trade_status = $_POST['trade_status'];
			//买家支付宝账号
			$buyer_email  = $_POST['buyer_email'];
		    if($_POST['trade_status'] == 'TRADE_FINISHED') {
				$map['id'] = M('Order')->getFieldByOutTradeNo($out_trade_no,'id');	
    			$data['status'] = 2;
    			$data['buyer_email'] = $buyer_email;
    			$data['trade_no']	 = $trade_no;
    			$data['ptime']	 = time();
    			$result = M('Order')->where($map)->save($data);
		    }else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
				$map['id'] = M('Order')->getFieldByOutTradeNo($out_trade_no,'id');	
    			$data['status'] = 2;
    			$data['buyer_email'] = $buyer_email;
    			$data['trade_no']	 = $trade_no;
    			$data['ptime']	 = time();
    			$result = M('Order')->where($map)->save($data);
		    }
		        
			echo "success";		//请不要修改或删除
			
		}else {
		    //验证失败
		    echo "fail";		//请不要修改或删除
		}
	}

}