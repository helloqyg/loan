<?php

/**
 * 广告订购模块
 * @author    qyg
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/20
 */

namespace User\Controller;
use \Com\Data as Model;

class AdverController extends BaseController{

	/**
     * 用户id
     */

    private $user_id = null;

	/**
	 * 初始化方法
	 * @version 0.11
	 * @author qyg
	 */

	public function _initialize(){
		// 判断登录状态
    	$is_login = check_login();
    	// 未登录
    	if(!$is_login){
    	    $this->redirect( '/user/login' );
    	}
		
		$this->user_id = get_uid(false);
		$adver_order = M('Adver')->where(array('uid'=>$this->user_id))->find();
		if( count($adver_order) > 0 ){
			$this->status = 1;
			// 广告信息
			$this->adver_order  = $adver_order;
			// 付款状态
			$this->order_status = M('Order')->getFieldByBid($adver_order['id'],'status'); 
			if( $this->order_status == 1 ){
				$info = "type/2/id/{$adver_order['id']}";
				// 跳转url
				$this->pay_url = "/user/booth/order/".base64_encode($info);
			}
		}
	}
	
	/**
	 * 广告订购程序
	 * @version 0.11
	 * @author qyg
	 */

	public function index(){
		$info = M('Adver')->where(array('status'=>1))->field('id,title,price,images')->select();
		foreach ($info as $key => $value) {
			$info[$key]['url'] = base64_encode("type/2/id/".$value['id']);
		}
		$this->special = M('AdGoods')->where(array('is_special'=>1))->select();
		$this->adver = $info;
		$this->adver_info = json_encode($info,true);
		$this->title = "广告订购";
		$this->display();
	}

	/**
	 * 特殊类型广告列表
	 * @version 0.11
	 * @author qyg
	 */
	public function special_list(){
		$this->title='广告列表';
		$id = I('get.id',0,'intval');
		if($id==0)$this->error('参数错误');
		$this->goods = M('AdGoods')->where(array('goods_id'=>$id))->select();
		$this->display();
	}
	
	/**
	 * 现场广告区域
	 * @version 0.11
	 * @author qyg
	 */
	public function ad_area(){
		$this->title = '现场广告-区域选择';
		$this->display();
	}

	/**
	 * 广告列表 search 
	 * @version 0.11
	 * @author qyg
	 */
	public function ad_list(){
		if (IS_GET) {
			//区域
			$this->area = M('AdArea')->select();
			//类型
			$this->cat = M('AdLocaleType')->select();
			//全部数据
			$goods = M('AdGoods')->select();
				foreach ($goods as $key => &$value) {
					$value['get_ad_bot_count'] =  get_ad_bot_count($value['goods_id']);
				}
			$this->assign('goods',$goods);
			$this->title = '广告列表';
			$this->display();
		}

			if (IS_AJAX) {
				$area_id = I('post.area',0,'intval');
				$type_id = I('post.type',0,'intval');
				if ($area_id ==0 && $type_id ==0) {
					$data = M('AdGoods')->select();
					foreach ($data as $key => &$value) {
						$value['get_ad_bot_count'] =  get_ad_bot_count($value['goods_id']);
					}
				}
				if ($type_id ==0 && $area_id !=0) {
					$data = M('AdGoods')->where(array('ae_id'=>$area_id))->select();
					foreach ($data as $key => &$value) {
						$value['get_ad_bot_count'] =  get_ad_bot_count($value['goods_id']);
					}
				}
				if ($area_id ==0 && $type_id !=0) {
					$data = M('AdGoods')->where(array('cat_id'=>$type_id))->select();
					foreach ($data as $key => &$value) {
						$value['get_ad_bot_count'] =  get_ad_bot_count($value['goods_id']);
					}
				}
				if ($area_id !=0 && $type_id !=0) {
					$data = M('AdGoods')->where(array('ae_id'=>$area_id,'cat_id'=>$type_id))->select();
					foreach ($data as $key => &$value) {
						$value['get_ad_bot_count'] =  get_ad_bot_count($value['goods_id']);
					}
				}
				$this->assign('goods',$data);
				$this->display('adver/getadver');

			}
	}





	/**
	 * 广告详情
	 * @version 0.11
	 * @author qyg
	 */
	public function detail(){
		if (IS_GET) {
			$goods_id = I('get.goods_id','0','intval');
			$this->goods = M('AdGoods')->find($goods_id);
			$this->goods_detail = M('AdAddress')->alias('a')
							->field('a.*,g.goods_introduce,g.goods_address,g.cat_id,g.goods_number')
							->join('left join wd_ad_goods as g on a.goods_id = g.goods_id')
							->where(array('a.goods_id'=>$goods_id,'ar_special'=>array('EXP','is null')))
							->select();
			$this->detail = json_encode($this->goods_detail);
			$this->title = '详情页面';
			$this->display();
		}
		if (IS_AJAX) {
			$address_array = I('post.address_array',0);
			$goods_id = I('post.goods_id');
			$url = 'address_array/'.$address_array.'/type/2/id/'.$goods_id.'';
			echo base64_encode($url);
		}
	}
}//class