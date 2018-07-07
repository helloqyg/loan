<?php

/** 
 *  申请基类控制器
 *  @copyright Copyright (c) 2015 http://www.widuu.com
 *  @date      2015/10/13
 *  @version   0.11
 *  @author    qyg 
 */

namespace User\Controller;
use \Com\Service;

class ApplyBaseController extends BaseController{

	/**
	 * 实列化的企业Service服务
	 */
	
	protected $service;

	/**
     * 继承父类的构造方法，并添加订单状态的判断
	 * @version 0.11
	 * @author  widuu<admin@widuu.com>
	 */

	public function _initialize(){
		// 继承父类方法并逻辑重写
		parent::_initialize();
		// 获取用户组
		$uid = get_uid();
		$gid = M('Member')->getFieldById($uid,'group_id');
		// 用户组判断
		if( $gid != 3 ){
			$this->error('您还未通过认证~！');
		}
		// 去除订单回执的检查状态
		// if( ACTION_NAME!= 'checks'){
		// 	// 获取订单状态
		// 	$order_status = get_order_status();
		// 	if(!$order_status){
		// 		$this->error('您还没有成交的订单');
		// 	}
		// }
		// 实列化Service信息
		$this->service = new Service();
	}

	/**
	 * 提示判断信息
	 * @param 	bool|string  提示信息或者错误提示
	 * @param 	info 		   返回信息
	 * @return  返回错误信息
	 * @version 0.11
	 * @author  widuu<admin@widuu.com>
	 */

	public function is_notice($result,$info='添加'){
        if(is_bool($result) && $result){
            $this->success($info.'成功');
        }else{
            if(is_bool($result)){
                $this->error($info.'失败');
            }else{
                $this->error($result);
            }
        }
    }
}