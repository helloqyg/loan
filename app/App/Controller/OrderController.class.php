<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class OrderController extends BaseController
{

    /**
     * 支付入口方法
     * 请求支付接口 status=0；未支付
     */

    public function request_pay()
    {

        $order_id = I('get.order_id','0','intval');
        if ($order_id == 0 ){
            $this->redirect('index/index');
        }
        $payObj = new PayController();
        $payObj->jsApiOrder($order_id);

    }


    /**
     * 创建订单 status=0；未支付
     */


    public function create_order()
    {
        if (IS_POST) {

            $model = M('Order');
            if ($model->create()) {
                $model->user_id = get_user_id();
                $model->order_code = rand(100000000000, 999999999999);
                $model->create_date = time();
                $order_id = $model->add();
                if ($order_id) {
                    $this->ajaxReturn($order_id);
                } else {
                    $this->ajaxReturn(0);
                }
            }
        }
    }


    /**
     * 微信支付成功后根据订单id查询商品信息，进行页面url跳转
     */

    public function pay_success()
    {
        $id = I('get.order_id');
        $this->data = M('Order')->find($id);
        $this->display('Public:pay_success');
    }


}