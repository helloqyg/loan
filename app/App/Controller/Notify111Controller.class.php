<?php
namespace App\Controller;
// require_once VENDOR_PATH.'Wxpay/lib/WxPay.Api.php';
//require_once VENDOR_PATH.'Wxpay/example/WxPay.JsApiPay.php';
//require_once VENDOR_PATH.'Wxpay/lib/WxPay.Config.php';
vendor('Wxpay.lib.WxPay','','.Api.php');
vendor('Wxpay.lib.WxPay','','.Notify.php');
require_once VENDOR_PATH.'Wxpay/lib/WxPay.Notify.php';
class NotifyController extends \WxPayNotify{

    //查询订单
    public function Queryorder($transaction_id,$attach)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        //Log::DEBUG("query:" . json_encode($result));
        if(array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS")
        {
            if(strpos($attach,'g')){
                $this->buyGoods($attach,$transaction_id);
            }else{
                $this->buyYue($attach,$transaction_id);
            }
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        //Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();
        if(!array_key_exists("transaction_id", $data)){
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if(!$this->Queryorder($data["transaction_id"],$data['attach'])){
            $msg = "订单查询失败";
            return false;
        }
        return true;
    }

    //购买商品回调
    private function buyGoods($order_code,$transaction_id)
    {
        $info = M('Order')->where('order_code="'.$order_code.'"')->find();
        if($info['status'] != 0) return;
        //修改订单状态
        M('Order')->where(array('order_code'=>$order_code,'status'=>0))->data(array('status'=>1))->save();
        $orderInfo = M('Order')->where(array('order_code'=>$order_code,'status'=>1))->find();
        $donorData['user_id']=$orderInfo['user_id'];
        $donorData['price']=$orderInfo['total_price'];
        $donorData['content']=$orderInfo['content'];
        $donorData['item_id']=$orderInfo['item_id'];
        $donorData['type']=$orderInfo['type'];
        $donorData['province']=$orderInfo['province'];
        $donorData['city']=$orderInfo['city'];
        $donorData['detail_address']=$orderInfo['detail_address'];
        $donorData['is_anonymous']=$orderInfo['is_anonymous'];
        $donorData['date']=$orderInfo['create_date'];
        //从订单表数据更新到donor
        file_put_contents('notify.txt','--',FILE_APPEND);
        M('Donor')->data($donorData)->add();

    }

    //余额支付回调
    private function buyYue($ordernum,$transaction_id)
    {
        $info = M('payinfo')->where('ordernum="'.$ordernum.'"')->find();
        if($info['is_pay'] == 0){

            //修改订单状态
            M('payinfo')->where('id='.$info['id'])->save(array('is_pay'=>'1','liushuinum'=>$transaction_id));

            //添加余额
            M('Member')->where('id='.$info['userid'])->setInc('yue',$info['price']);
        }
    }


    /**
     * 消息推送回调
     */
    public function UrlRedirect()
    {
        echo I('echostr');
    }
}