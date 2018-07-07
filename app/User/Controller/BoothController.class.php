<?php

/**
 * User order booth class
 * @author    qyg
 * @version   0.11
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/10/13
 */

namespace User\Controller;

use Com\Service;
use Com\Data as Model;
use Com\Pay;

header("Content-type:text/html;charset=utf-8");

class BoothController extends BaseController
{

    /**
     * 企业服务
     */

    private $service;

    /**
     * common initializetion function
     * @author qyg
     */

    public function _initialize()
    {
        parent::_initialize();
        // 获取用户组
        $uid = get_uid();
        $gid = M('Member')->getFieldById($uid, 'group_id');
        // 用户组判断
        if ($gid != 3) {
            $this->error('您还未通过认证~！');
        }
        $this->service = new Service();
        $remove_action = array('order', 'pay', 'pay_up');
        //权限
        // $this->service->judge($remove_action);

        // $map['uid'] = get_uid();
        // $order_num = M('Order')->where($map)->find();

        // if( ACTION_NAME!="order" &&  ACTION_NAME!='pay' &&  ACTION_NAME!='pay_up'){
        // 	if( !empty($order_num) ){
        // 		$this->redirect('User/booth/order/id/'.$order_num['bid']);
        // 	}
        // }

        // if( $order_num['status'] == 2 ){
        // 	if($order_num['type'] == 2){
        // 		$status = M('Pay')->where($map)->find();
        // 		if( $status['status'] == 1 ){
        // 			$this->redirect('User/account/booth');
        // 		}else{
        // 			$this->redirect('User/apply/checks');
        // 		}

        // 	}else{
        // 		$this->redirect('User/account/booth');
        // 	}
        // }
    }

    /**
     * 展馆列表
     * @version 0.11
     * @author  qyg
     */

    public function index()
    {
        $where['id'] = $map['uid'] = get_uid();
        $company_id = M('Member')->where($where)->field('cid')->find();
//获得当前用户的参展类型type字段. 注册账户时所选,如果type为部件馆,则只显示出部件馆
        $assign['hid'] = Model::get_field('company', $company_id['cid'], 'id', 'type');
        $assign['hall'] = M('Hall')->where(array('hall_type' => $assign['hid'], 'status' => 1))->select();
        $assign['title'] = "展馆选择";
        $this->service->t_show($assign, 'booth_list');
    }


    /**
     * 展馆选择
     * @version 0.11
     * @author qyg
     */

    public function select()
    {
        // 展馆Id
        $id = I('get.id', 0, 'intval');
        if ($id == 0) $this->error("参数错误");
        // 判断展馆是否分区
        //展示视图1 2 3 4 5 6 选择
        if (intval(I('get.status', 0, 'intval')) == 1) {
            $area = Model::get_field('hall', $id, 'id', 'area');
            // 展馆分区是否真实存在
            if (!empty($area)) {
                $assign['hid'] = $id;
                $assign['area'] = explode(',', $area);
                $assign['title'] = "展位区域选择";
                dump($assign);
                //判断$assign是不是一个数组并不为空,然后把$assign分配到模板中,并display加载booth_area模板
                $this->service->t_show($assign, 'booth_area');
                return;
            }
        }
        //展位选择
        //检测区域
        $area_select = I('get.area', 0, 'intval');
        if ($area_select != 0) {
            $where['hall_area'] = $area_select;
        }
        // 面积检索 搜索功能
        $s_area = I('get.s_area', 0, 'intval');
        $e_area = I('get.e_area', 0, 'intval');
        $this->company_info = $company_info = M('Hall')->find($id);
        if ($company_info['status'] == 0) $this->error('展馆未开放');
        if ($e_area != 0) $where['area'] = array('elt', $e_area);
        if ($s_area != 0) $where['area'] = array('egt', $s_area);
        $where['hid'] = $id;
        //大于小于的一个搜索功能
        $booth = M('Booth')->where($where)->field('id,booth_num,status,area,width,height')->select();
        //SELECT `id`,`booth_num`,`status`,`area` FROM `wd_booth` WHERE `hall_area` = 5 AND `hid` = 5
        // 查询出7.2号馆(hid=5)并且是区域2(hall_area)的展位预订情况
        foreach ($booth as $key => $value) {
            $booth[$key]['url'] = base64_encode("type/1/id/" . $value['id']);
        }
        //********
        //分配数据到模板
        $this->booth = json_encode($booth, false);
        $this->title = $company_info['hall_num'] . "馆展位订购";
        $this->s_area = $s_area;
        if ($e_area == 0) {
            $this->e_area = M('Booth')->where($where)->max('area');
        } else {
            $this->e_area = $e_area;
        }
        // 如果存在区域划分
        if ($area_select != 0) {
            $this->display('hall_area_' . $area_select);
        } else {
            $this->display('hall' . $company_info['id']);
        }

    }

    /**
     * ajax获取展位面积
     * @author qiao
     */
    public function get_area()
    {
        $str = I('get.booth_num');
        $booth_num = explode('_', $str);
        $data = M('Booth')
            ->where(array('booth_num' => $booth_num['1']))
            ->field('area,booth_num')
            ->find();
        echo json_encode($data);
    }


    /**
     * 根据类型订单支付页面
     * @version 0.11
     * @author  qyg
     */

    public function order()
    {
        // 解析URL参数
        $params = $this->service->decode();
        //array(2) {["type"] => string(1) "2"["id"] => string(2) "47"}
        //防止后退
        $booth_flag = M('Booth')->where(array('uid' => get_uid(false), 'id' => $params['id']))->find();
        if ($booth_flag != '') {

            $this->error('参数错误,正跳转至[个人中心]', '/user/account/company', 3);
        }
        // 订单id
        $order_id = $params['id'];
        // 展位类型支付
        if ($params['type'] == 1) {
            $booth_info = M('Booth')->find($order_id);
            // 获取用户id
            $user_id = get_uid(false);
            // 展位售出检测
            if ($booth_info['status'] == 0 || $booth_info['status'] == 2 && $booth_info['uid'] != $user_id) {
                $this->error('展位已售出');
            }
// getFieldByUid($user_id,'status')
// $where['uid']=$user_id
// return $this->where($where)->getField('status')
            // 判断展位审核状态
            $check_status = M('Reserve')->getFieldByUid($user_id, 'status');
            // 展位审核 如果展位没有售出 并且check_status为false
            if ($booth_info['checks'] != 0 && !(bool)$check_status) {
                $check_num = M('Reserve')->where(array('uid' => $user_id))->count();
                // 如果已经不存在展位订购审核
                if ($check_num == 0) {
                    $model_data['bid'] = $order_id;
                    $model_data['uid'] = $user_id;
                    $model_data['atime'] = time();
                    $result = M('Reserve')->data($model_data)->add();
                }
                $assign['bid'] = M('Reserve')->getFieldByUid($user_id, 'bid');
                $assign['title'] = "展位审核";
                $this->service->t_show($assign, 'booth_checks');
                return;
            }
            // 传递的参数
            $assign['aid'] = $order_id;
            $assign['hall'] = Model::get_field('Hall', $booth_info['hid'], 'id', 'hall_num');
            $assign['bank'] = Model::get_field('member', get_uid(false), 'id', 'bid');
            $assign['time'] = time();
            $assign['booth_info'] = $booth_info;
            $assign['title'] = "订购确认";
            // 返回模版
            $this->service->t_show($assign, 'order_booth');
            return;
        } else {
            $uid = get_uid(false);
            //判断用户是否购买了展位
            //begin time
            $begin = M('Config')->where(array('name' => 'EXHI_BEGIN'))->find();
            $end = M('Config')->where(array('name' => 'EXHI_END'))->find();
            //2017年0点0分  - 2018年0点0份
            $where['ptime'] = array(array('gt', $begin['value']), array('lt', $end['value']), 'and');
            $where['uid'] = get_uid(false);
            $where['status'] = 4;
            $where['ad_type'] = 1;
            //判断是否在时间段内购买了展位
            $is_exhi = M('Order')->where($where)->find();
            //判断是否属于后台特批用户
            $is_exhi_0 = M('Member')->where(array('is_exhi' => 1, 'id' => get_uid(false)))->find();
            //只要满足上述其一就可购买广告
            if ($is_exhi_0 || $is_exhi) {
                // 广告类型订购
                $address_array = get_ad_params($params);
                //用户选择
                $this->info = M('AdAddress')->where(array('ar_id' => array('in', $address_array)))->select();
                $assign['product'] = M('AdGoods')->field('goods_name')->where(array('goods_id' => $params['id']))->find();
                $base64 = explode('/', __SELF__);
                $this->base64 = $base64['4'];
                $assign['title'] = "订购确认";
                $assign['aid'] = $order_id;
                $assign['bank'] = Model::get_field('member', get_uid(false), 'id', 'bid');

                $this->service->t_show($assign, 'order_ad');
            } else {
                echo "<script>alert('需先购买展位才可购买广告!');window.location.href='http://www.elevatorchina.com/user/booth/index.html'</script>";
            }
        }
    }

    /**
     * 付款流程 支持多渠道付款以及多种付款方式
     * @version 0.11
     * @author  qyg
     */


    public function pay()
    {
        if (IS_AJAX) {
            // 支付方式 支付宝/汇款
            $pay_type = I('post.pay_type', 0, 'intval');
            // 产品类型  ad_type 1展位 2广告
            $type = I('post.type', 0, 'intval');
            //广告类型的id是base64加密处理的字符串
            // 产品id
            $product_id = I('post.id', 0);
            if ($type == 2) {
                $params = $this->service->ad_decode($product_id);
                $product_id = $params['address_array'];
            }
            // 实列化支付系统
            $pay = new Pay();
            $pay->pay($pay_type, $type, $product_id);
            exit();
        }
    }

    /**
     * 汇款支付，多种类型产品付款
     * @version 0.11
     * @author qyg
     */

    public function pay_up()
    {
        $count = 0;
        $product_id = I('get.id', 0);
        $count++;
        // 验证ID参数
        if ($product_id == 0 && $count == 0) {
            $this->error('参数错误');
        }
        // 付款类型目前只有广告和展位
        $pay_type = I('get.type', 0, 'intval');
        if (IS_GET) {


            // 获取企业ID
            $assign['company_id'] = Model::get_field('member', get_uid(false), 'id', 'cid');
            // 企业名称
            $assign['company_name'] = Model::get_field('company', $assign['company_id'], 'id', 'company_name');
            // 付款类型 : 是展位 |广告
            $assign['type'] = $pay_type;
            // 实例化
            $pay = new Pay();
            switch ($pay_type) {
                //展位
                case 0:
                    // 强制更改付款类型为汇款支付
                    M('Order')->where(array('bid' => $product_id))->save(array('type' => 2));
                    $product_info = M('Booth')->find($product_id);
                    $order_data = $pay->booth_pay($product_id, $product_info);
                    //防止用户后退, 则跳转其他页面
                    $booth_flag = M('Booth')->where(array('uid' => $order_data['uid'], 'id' => $order_data['bid']))->find();
                    if ($booth_flag != '') {

                        $this->redirect('/user/account/company');
                    }
                    //用户对展位下订单后,不再改变摊位状态,必须购买之后才会改变
                    // M('Booth')->where(array('id'=>$product_id))->save(
                    // 	//增加一个购买用户的id,改变摊位的状态
                    // 		array('status'=>2,'uid'=>get_uid(false),'time'=>time())
                    // );
                    $order_data['type'] = 2; //2汇款支付
                    $order_data['ad_type'] = 1; //1展位
                    $assign['title'] = "展位订购付款凭证";
                    $assign['price'] = Model::get_field('booth', $product_id, 'id', 'price');

                    break;
                //广告
                case 1:
                    //echo 1;die;
                    $params = $this->service->decode();
                    //位置id   array
                    $product_id = $params['address_array'];
                    $arr = explode(',', $product_id);
                    array_pop($arr);
                    //防止用户多步后退，
                    $a = M('AdAddress')->where(array('ar_id' => array('in', $arr), 'ar_status' => '1'))->select();
                    if (count($a) != 0) {
                        M('Order')->where(array('bid' => $product_id, 'uid' => get_uid()))->save(array('status' => 2));
                    }
                    // 强制更改付款类型为汇款支付
                    M('Order')->where(array('bid' => $product_id))->save(array('type' => 2));
                    $address_array = get_ad_params($params);
                    $product_info = M('AdAddress')->where(array('ar_id' => array('in', $address_array)))->select();
                    $order_data = $pay->adver_pay($product_id, $product_info);
                    //防止后退
                    $adver_flag = M('AdAddress')->where(array('uid' => $order_data['uid'], 'ar_id' => array('in', $arr)))->select();
                    if (count($adver_flag) != 0) {
                        $this->redirect('/user/account/company');
                    }
                    $order_data['type'] = 2; //汇款
                    $order_data['ad_type'] = 2; //广告
                    $assign['title'] = "广告订购付款凭证";
                    $assign['price'] = get_ad_price($product_id);
                    break;
                default:
                    $assign['title'] = "付款错误";
                    $this->error('付款类型暂未开通');
                    break;
            }


            $this->pid = $product_id;  //array
            $order_map['bid'] = $product_id;

            if (M('Order')->where($order_map)->count() > 0) {
                M('Order')->where($order_map)->save($order_data);
            } else {
                M('Order')->data($order_data)->add();
            }
            $this->service->t_show($assign);
        }

        if (IS_POST) {
            $pay_model = M('Pay');
            //产品id 展位id
            $where['pid'] = I('post.pid', '', 'trim');
            //用户id
            $where['uid'] = $uid = get_uid(false);
            if ($pay_model->where($where)->count() > 0) {
                $this->error('您已经提交过了，请勿重复提交');
            }
            if ($pay_model->create()) {
                $pay_model->uid = $uid;
                $pay_model->product_id = $product_id;
                if ($pay_model->add()) {
                    if ($pay_type == 0) {
                        //修改摊位的状态为已付款或者正在审核,使得展位图显示
                        M('Booth')->where(array('id' => $product_id))->save(
                            array('status' => 2, 'uid' => get_uid(false), 'time' => time())
                        );
                    }
                    if ($pay_type == 1) {
                        $params = $this->service->decode();
                        $product_id = $params['address_array'];
                        $address_array = get_ad_params($params);
                        M('AdAddress')->where(array('ar_id' => array('in', $address_array)))->save(array('ar_status' => 1, 'uid' => get_uid(false)));

                    }
                    //修改订单的status为审核中

                    M('Order')->where(array('uid' => $uid, 'bid' => $product_id))->save(array('status' => 2, 'ptime' => time()));
                    $cid = M('Member')->getFieldById(get_uid(false), 'cid');
                    $company = M('Company')->getFieldById($cid, 'company_name');
                    $sub = array('%company_name%' => array($company));
                    $email = array(get_config('FINANCE_EMAIL'));
                    $result = \Sendcloud\Send::send_template('team@elevator-expo.com', $sub, $email, '财务审核提醒', 'finance', '', '', '', '', '', true, false, false);
                    $this->success('提交成功');
                } else {
                    $this->error('提交失败');
                }
            } else {
                $this->error('创建数据失败');
            }
        }
    }
}