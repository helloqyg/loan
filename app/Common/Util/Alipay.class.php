<?php

// +----------------------------------------------------------------------
// | elevator-expo order system
// +----------------------------------------------------------------------
// | Description: Alipay order interface
// +----------------------------------------------------------------------
// | Author: widuu 
// +----------------------------------------------------------------------
// | Time  : 2015/08/19
// +----------------------------------------------------------------------

namespace Common\Util;

require_once("lib/alipay_submit.class.php");
header("Content-type:text/html;charset=utf-8");
class Alipay{

	static private $alipay_config = NULL;

	public function __construct(){
		$this->alipay_config = C('ALIPAY_CONFIG');
		$this->alipay_config['key'] = trim(C('ALIKEY'));
	}

	/**
	 * 支付的接口
	 * @param out_trade_no 订单号 唯一的
	 * @param subject  	   订单名称
	 * @param total_fee	   付款金额
	 * @param $show_url	   商品url地址
	 * 
	 * @author widuu <admin@widuu.com>
	 */ 

	public function Pay($out_trade_no,$total_fee,$subject,$show_url,$body='2016中国国际电梯展览会展位'){
		$parameter["service"] 			= "create_direct_pay_by_user";
		$parameter["partner"] 			= trim(C('PARTNER'));
		$parameter["payment_type"]  	= trim($this->alipay_config['payment_type']);
		$parameter["out_trade_no"]		= trim($out_trade_no);
		$parameter["notify_url"]		= trim(C('NOTIFY_URL'));
		$parameter["return_url"]		= trim(C('RETURN_URL'));
		$parameter["seller_email"]		= trim(C('SELLER_EMAIL'));
		$parameter["subject"]			= $subject;
		$parameter["total_fee"]			= trim($total_fee);
		$parameter["body"]				= $body;
		$parameter["show_url"]			= trim($show_url);
		$parameter["anti_phishing_key"]	= "";
		$parameter["exter_invoke_ip"]	= "";
		$parameter["_input_charset"]	= trim(strtolower($this->alipay_config['input_charset']));
		//建立请求
		$alipaySubmit = new \AlipaySubmit($this->alipay_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		return $html_text;

	}

}