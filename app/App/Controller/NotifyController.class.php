<?php
/**
 * 第三方登陆，微信回调
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */
namespace App\Controller;
require_once VENDOR_PATH . 'Wxpay/lib/WxPay.Api.php';
//require_once VENDOR_PATH.'Wxpay/example/WxPay.JsApiPay.php';
//require_once VENDOR_PATH.'Wxpay/lib/WxPay.Config.php';
require_once VENDOR_PATH . 'Wxpay/lib/WxPay.Notify.php';

class NotifyController extends \WxPayNotify
{

    //查询订单
    public function Queryorder($transaction_id, $attach)
    {
        $input = new \WxPayOrderQuery();
        $input->SetTransaction_id($transaction_id);
        $result = \WxPayApi::orderQuery($input);
        //Log::DEBUG("query:" . json_encode($result));
        if (array_key_exists("return_code", $result)
            && array_key_exists("result_code", $result)
            && $result["return_code"] == "SUCCESS"
            && $result["result_code"] == "SUCCESS") {
//            if(strpos($attach,'g')){
            $this->buyGoods($attach, $transaction_id);
//            }else{
//                $this->buyYue($attach,$transaction_id);
//            }
            return true;
        }
        return false;
    }

    //重写回调处理函数
    public function NotifyProcess($data, &$msg)
    {
        //Log::DEBUG("call back:" . json_encode($data));
        $notfiyOutput = array();
        if (!array_key_exists("transaction_id", $data)) {
            $msg = "输入参数不正确";
            return false;
        }
        //查询订单，判断订单真实性
        if (!$this->Queryorder($data["transaction_id"], $data['attach'])) {
            $msg = "订单查询失败";
            return false;
        }
        return true;
    }

    //购买商品回调
    private function buyGoods($order_code, $transaction_id)
    {


        //file_put_contents('notify.txt', '$order_code:' . $order_code, FILE_APPEND);
        //修改订单状态
        $orederResult = M('Order')->where(array('order_code' => $order_code, 'status' => 0))->data(array('status' => 1))->save();
        if ($orederResult) {

            //file_put_contents('notify.txt', '$orderResult:' . M('')->getLastSql() . '\n', FILE_APPEND);
            //查询当前订单的信息
            $orderInfo = M('Order')->where(array('order_code' => $order_code, 'status' => 1))->find();
            //如果订单类型是1.爱心救助；2.梦想清单；3.轻松公益；走此逻辑
            if ($orderInfo['type'] == 1 || $orderInfo['type'] == 2 || $orderInfo['type'] == 3) {
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
                M('Donor')->data($donorData)->add();
                //增加当前用户的爱心积分值
                $love_value = C('LOVE_VALUE') * $orderInfo['total_price'];
                M('Member')->query("update  wd_member set love_value=love_value+{$love_value} where id={$orderInfo['user_id']}");
            }
            //如果订单类型是4.爱心宣扬，走此逻辑。
            if ($orderInfo['type'] == 4) {
                $donorData['user_id'] = $orderInfo['user_id'];
                $donorData['single_price'] = $orderInfo['single_price'];
                $donorData['item_count'] = $orderInfo['item_count'];
                $donorData['content'] = $orderInfo['content'];
                $donorData['province'] = $orderInfo['province_love'];
                $donorData['city'] = $orderInfo['city_love'];
                $donorData['date'] = $orderInfo['create_date'];
                M('Announce')->data($donorData)->add();
                $love_value = C('LOVE_VALUE') * $orderInfo['single_price'] * $orderInfo['item_count'];
                M('Member')->query("update  wd_member set love_value=love_value+{$love_value} where id={$orderInfo['user_id']}");
            }
             //如果订单类型是5.轻松互助，走此逻辑。
            if ($orderInfo['type'] == 5) {
                $idArr = $orderInfo['id_arr'];
                $idArr = ltrim($idArr,',');
                $idArr = explode(',',$idArr);
                 //file_put_contents('notify.txt', '$idArr:' . $idArr[0] . '\n', FILE_APPEND);
                for ($i=0; $i < count($idArr); $i++) { 
                    M('MutualUser')->where(array('id'=>$idArr[$i]))->save(array('status'=>1));
                }


               
            }
        }

    }

    //余额支付回调
    private function buyYue($ordernum, $transaction_id)
    {
        // echo 222;die;
        $info = M('payinfo')->where('ordernum="' . $ordernum . '"')->find();
        if ($info['is_pay'] == 0) {

            //修改订单状态
            M('payinfo')->where('id=' . $info['id'])->save(array('is_pay' => '1', 'liushuinum' => $transaction_id));

            //添加余额
            M('Member')->where('id=' . $info['userid'])->setInc('yue', $info['price']);
        }
    }
}