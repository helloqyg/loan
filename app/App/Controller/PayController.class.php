<?php
/**
 * 第三方支付，微信支付
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */
namespace App\Controller;
// require_once VENDOR_PATH.'Wxpay/lib/WxPay.Api.php';
// require_once VENDOR_PATH.'Wxpay/example/WxPay.JsApiPay.php';
vendor('Wxpay.lib.WxPay', '', '.Api.php');
vendor('Wxpay.example.WxPay', '', '.JsApiPay.php');

class PayController extends \Think\Controller
{
    /**
     * 微信支付
     * @param [int]  $orderid  [订单id]
     * @param [bool] $direct   [是否直接支付]
     * @return void [直接支付  直接返回支付js代码 || 不直接支付 走一个订单详情]
     */
    //调起支付接口(订单)
    public function jsApiOrder($orderid, $direct = true)
    {
        //获取总价格
        $info = M('order')->where(array('user_id' => get_user_id(), 'id' => $orderid))->find();
        if (!$info) {
            $this->error('参数错误1');
            die();
        }

//        var_dump($info);die;
        //总价格
        $totalprice = $info['total_price'];
        $tools = new \JsApiPay();
        $openId = M('Member')->where('id='.get_user_id())->getField('openid');
//        $openId = "oVrQiwa8vB2fLySsGEYjyG4SZQCM";
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("众筹支付");
        $input->SetAttach($info['order_code']);
        $input->SetOut_trade_no($info['order_code']);
        $input->SetTotal_fee($totalprice);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        //$input->SetGoods_tag("test");
        $input->SetNotify_url(C('OrderPayReturn'));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $this->assign('info', $info);
        $this->assign('jsApiParameters', $jsApiParameters);
        //直接支付
        if ($direct) {//直接支付
            $go_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/Index/index/id/60';//支付成功的回跳地址
            $back_url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/Index/recharge';//支付失败的回跳地址
            $html = <<<php
    <script type="text/javascript">
    //调用微信JS api 支付
    function onBridgeReady(){
       WeixinJSBridge.invoke(
           'getBrandWCPayRequest',$jsApiParameters,
           function(res){     
            //alert(JSON.stringify(res));
             if(res.err_msg == "get_brand_wcpay_request:ok") {
                       //取得url参数传递到提示页面
                    var order_id = window.location.href;
                    var param=order_id.match(/order_id\/\d+/g);
                    var param = param[0].match(/\d+/)
                    window.location.href='/Order/pay_success/order_id/'+param[0]+'.html';
                 
                     //   location.href='$go_url';
             }else{
                //alert(res.err_code+res.err_desc+res.err_msg);
                 window.history.go(-1);
                //location.href='$back_url';
             }
           }
       ); 
    }

    
    if (typeof WeixinJSBridge == "undefined"){
       if( document.addEventListener ){
           document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
       }else if (document.attachEvent){
           document.attachEvent('WeixinJSBridgeReady', onBridgeReady); 
           document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
       }
    }else{
       onBridgeReady();
    }
    </script>
php;
            echo $html;
            die;
        } else {
            $this->display('pay:order');
        }

    }


    //支付回调(订单)
    public function payUrl()
    {
        $postStr = file_get_contents('php://input');
//        file_put_contents('notify.txt',$postStr.'--',FILE_APPEND);
        $obj = new NotifyController();
//        dump($obj);die;
        $obj->Handle(false);
    }

    //调起支付接口(订单)
    public function jsApiYue()
    {
        //验证登录
        $userid = session('user.id');
        if (!$userid) {
            $this->error('还未登录，请退出重新登录', 0);
            die();
        }

        //获取总价格
        $price = I('price');
        $ordernum = 'ye' . time() . rand(0, 9) . rand(0, 9) . rand(0, 9);
        $result = M('Payinfo')->add(array('ordernum' => $ordernum, 'userid' => $userid, 'price' => $price, 'addtime' => time(), 'type' => '余额充值', 'is_pay' => 0));
        if (!$result) {
            $this->error('订单生成失败，请重新操作', 0);
            die();
        }
        //总价格
        $totalprice = $price * 100;
        $tools = new \JsApiPay();
        $openId = M('Member')->where('id=' . $userid)->getField('openid');
        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("酒冤家余额充值");
        $input->SetAttach($ordernum);
        $input->SetOut_trade_no(\WxPayConfig::MCHID . date("YmdHis"));
        $input->SetTotal_fee($totalprice);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        //$input->SetGoods_tag("test");
        $input->SetNotify_url(C('OrderPayReturn'));
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        //dump($input);die;
        $jsApiParameters = $tools->GetJsApiParameters($order);
        $this->assign('jsApiParameters', $jsApiParameters);
    }

    //支付回调(订单)
    public function notify()
    {
        $postStr = file_get_contents('php://input');


        //simplexml_load_string参数
        // param2:规定新对象的 class。
        // param3:LIBXML_NOCDATA - 将 CDATA 设置为文本节点
        $msg = (array)simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
        //修改订单状态
        $OrderResult = M('Order')->where(array('order_num' => $msg['out_trade_no'], 'status' => 0))->data(array('status' => 1))->save();
        $orderInfo = M('Order')->where(array('order_num' => $msg['out_trade_no'], 'status' => 1))->find();

        $donorData['user_id'] = $orderInfo['user_id'];
        $donorData['price'] = $orderInfo['total_price'];
        $donorData['content'] = $orderInfo['content'];
        $donorData['item_id'] = $orderInfo['item_id'];
        $donorData['type'] = $orderInfo['type'];
        $donorData['province'] = $orderInfo['province'];
        $donorData['city'] = $orderInfo['city'];
        $donorData['detail_address'] = $orderInfo['detail_address'];
        $donorData['is_anonymous'] = $orderInfo['is_anonymous'];
        $donorData['date'] = $orderInfo['create_date'];
        //从订单表数据更新到donor
        file_put_contents('notify.txt', $OrderResult . '--', FILE_APPEND);
        if ($OrderResult == 1) {
            M('Donor')->data($donorData)->add();
        }
    }


    //退款
    public function refund($order_id)
    {
        //获取订单号
        $orderid = $order_id;
        $userid = session('user.id');
        $info = M('order')->where('id=' . $orderid . ' and refund_status=0')->find();
        if (!$info) {
            return false;
        }
        if ($info['pay_type'] == 1) {//微信支付
            //总价格
            $totalprice = ($info['totalprice'] - $info['yhqprice']) * 100;
            $tools = new \JsApiPay();
            //②、退款
            $input = new \WxPayRefund();
            $input->SetOut_trade_no($info['ordernum']);
            // $input->SetOut_trade_no('171226000017');//测试数据
            $input->SetOut_refund_no($info['ordernum']);
            // $input->SetOut_refund_no('171226000017');//测试数据
            $input->SetTotal_fee($totalprice);//订单总金额
            // $input->SetTotal_fee(1);//订单总金额  测试数据
            $input->SetRefund_fee($totalprice);//退款金额
            // $input->SetRefund_fee(1);//退款金额   测试数据

            $order = \WxPayApi::refund($input);
            // dump($order);die;
            return $order;
        } else {
            $syyue = M('Member')->where('id=' . $userid)->getfield('yue');//当前余额
            $map['yue'] = $syyue + $info['totalprice'];
            $res = M('Member')->where('id=' . $userid)->save($map);
            if ($res) {
                return ['result_code' => 'SUCCESS', 'return_code' => 'SUCCESS'];
            } else {
                return ['result_code' => 'ERROR', 'return_code' => 'ERROR'];
            }
        }
        // 成功
        // array(18) {
        //   ["appid"] => string(18) "wx34eca8d0d3447ce5"
        //   ["cash_fee"] => string(1) "1"
        //   ["cash_refund_fee"] => string(1) "1"
        //   ["coupon_refund_count"] => string(1) "0"
        //   ["coupon_refund_fee"] => string(1) "0"
        //   ["mch_id"] => string(10) "1492860912"
        //   ["nonce_str"] => string(16) "19UQv2YIFEeZrnJg"
        //   ["out_refund_no"] => string(12) "171226000017"
        //   ["out_trade_no"] => string(12) "171226000017"
        //   ["refund_channel"] => array(0) {
        //   }
        //   ["refund_fee"] => string(1) "1"
        //   ["refund_id"] => string(29) "50000105172017122602845661062"
        //   ["result_code"] => string(7) "SUCCESS"
        //   ["return_code"] => string(7) "SUCCESS"
        //   ["return_msg"] => string(2) "OK"
        //   ["sign"] => string(32) "8927B44B7907CA77AFE04BF40A466093"
        //   ["total_fee"] => string(1) "1"
        //   ["transaction_id"] => string(28) "4200000034201712261731632377"
        // }

    }

    //提现  SetPartner_trade_no  商户订单号设置
    //SetCheck_name  校验用户姓名选项 NO_CHECK：不校验真实姓名 FORCE_CHECK：强校验真实姓名
    //SetRe_user_name   收款用户真实姓名。 如果check_name设置为FORCE_CHECK，则必填用户真实姓名 NO_CHECK 可不填
    //SetAmount   提现金额  单位分
    //SetDesc     提现描述
    //SetSpbill_create_ip 调用接口的机器Ip地址(本地ip地址)
    //openid 提现人的openid
    //sign 签名
    //nonce_str 随机串
    //mchid 商户号
    //mch_appid  appid

    //提现到零钱
    public function transfers($info=array('price'=>1234,'ordernum'=>123456), $openid='oVrQiwa8vB2fLySsGEYjyG4SZQCM')
    {
        if (!$info) {
            $this->error('参数错误');
            die();
        }
        //总价格
        $totalprice = $info['price'] * 100;
        $tools = new \JsApiPay();
        //②、退款
        $input = new \WxPayUnifiedOrder();
        $input->SetPartner_trade_no($info['ordernum']);
        // $input->SetPartner_trade_no('171226007'.date('YmdHis'));//测试数据
        $input->SetCheck_name('NO_CHECK');
        // $input->SetCheck_name('171226000017');//测试数据
        $input->SetAmount($totalprice);//提现总金额
        // $input->SetAmount(100);//提现总金额  测试数据
        $input->SetDesc('余额提现');//提现描述  测试数据
        $input->SetSpbill_create_ip($_SERVER['REMOTE_ADDR'] == '::1' ? '192.127.1.1' : $_SERVER['REMOTE_ADDR']);//提现 操作的本地ip地址
        // $input->SetRefund_fee(1);//退款金额   测试数据
        $input->SetOpenid($openid);//测试数据
        // $input->SetOpenid('oqscZ1WDSm5ZC4g068BDTbAFm4ns');//测试数据
        // $input->SetRe_user_name('测试');//测试数据

        $order = \WxPayApi::transfers($input);
        header("Content-type:text/html;charset=utf-8");
        dump($order);die;
        if ($order['return_code'] == 'SUCCESS' && $order['result_code'] == 'FAIL') {
            return false;
        }
        if ($order['return_code'] == 'SUCCESS' && $order['result_code'] == 'SUCCESS') {
            return true;
        }

    }


    //现金红包
    public function sendRedPack()
    {
        //获取订单号
        $orderid = (int)I('id');

        $info = M('order')->where('id=' . $orderid . ' and apply=1')->find();
        if (!$info) {
            $this->error('参数错误');
            die();
        }
        //总价格
        $totalprice = ($info['totalprice'] - $info['yhqprice']) * 100;
        $tools = new \JsApiPay();
        //②、退款
        $input = new \WxPayUnifiedOrder();
        // $input->SetMch_billno($info['ordernum']);//商户发红包订单号
        $input->SetMch_billno('171226007' . date('YmdHis'));//测试数据
        $input->SetSend_name('北京博信科技');//商户名称   红包发送者名称
        // $input->SetTotal_amount($totalprice);//红包总金额
        $input->SetTotal_amount(100);//红包总金额  测试数据
        $input->SetTotal_num(1);//红包发放总人数
        $input->SetWishing('赏你的');//红包祝福语
        $input->SetAct_name('活动名称');//红包 活动名称
        $input->SetRemark('备注');//红包备注
        $input->SetClient_ip($_SERVER['REMOTE_ADDR'] == '::1' ? '192.127.1.1' : $_SERVER['REMOTE_ADDR']);//操作的本地ip地址
        $input->SetRe_openid('oqscZ1WDSm5ZC4g068BDTbAFm4ns');//微信红包  openid格式

        $order = \WxPayApi::sendRedPack($input);
        dump($order);
        die;

    }
}