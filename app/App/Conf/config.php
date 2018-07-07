<?php
//定义回调URL通用的URL
const APP_ID = '10722111';
const API_KEY = 'xCnrT2ASAw0hLP9Q6IBUdLol';
const SECRET_KEY = 'kmfDVNwi6pEsDHUN142i2GQCig4sUarN';
return array(
	//'配置项'=>'配置值'
	//'URL_PATHINFO_DEPR'=>'-', 
	'URL_ROUTER_ON'   => true, 
	'URL_ROUTE_RULES'=>array(        
		'help/:id'=> 'help/index',
	),
    /* 加载扩展配置文件 */
    // 'LOAD_EXT_CONFIG' => 'sdk_config',
    'LOAD_EXT_CONFIG' => 'send_sms',
    //微信支付回调地址
    //'OrderPayReturn'=>($_SERVER['SERVER_PORT'] == '80' ? 'http://' : 'http://').$_SERVER['SERVER_NAME'].'/Pay/notify.html',
    'OrderPayReturn'=>($_SERVER['SERVER_PORT'] == '80' ? 'http://' : 'http://').$_SERVER['SERVER_NAME'].'/Pay/payUrl.html',
    //微信公众号配置
    // 'AppId'=>'wxed2ad738ac4eb007',
    'AppId'=>'wx72c64c8a4cfe31f2',
    // 'AppSecret'=>'2865e7da48c3d3f38f698c35dd0f5fc0',
    'AppSecret'=>'ea5df67746d81e572bdcf098efd980c2',
    'SESSION_TYPE'          =>  '', // session hander类型 默认无需设置 除非扩展了session hander驱动
    // 'WECHAT_SEND_MESSAGE' => 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=##TOKEN##'
);