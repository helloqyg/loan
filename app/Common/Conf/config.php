<?php


return array(
    'MODULE_ALLOW_LIST' => array('App', 'Manager', 'User'),
    'DEFAULT_MODULE' => 'App',
    'DEFAULT_ACTION' => 'index',
    'DEFAULT_TIMEZONE' => 'PRC',
    'TMPL_L_DELIM' => '<{',
    'TMPL_R_DELIM' => '}>',
    'HTML_FILE_SUFFIX' => '.html',
    'URL_HTML_SUFFIX' => '.html',
    'SESSION_AUTO_START' => true,           //是否开启session
    //'SHOW_PAGE_TRACE'      =>  true,          //开启trace
    'URL_CASE_INSENSITIVE' => true,           //忽略大小写
    'LOAD_EXT_CONFIG' => 'db',
    'COOKIE_EXPIRE' => 'widuu',
    'TMPL_ACTION_ERROR' => BASE_PATH . '/public/error.html',
    'TMPL_PARSE_STRING' => array(
        '__PUBLIC__' => __ROOT__ . '/public',
        '__JS__' => __ROOT__ . '/public/js',
        '__CSS__' => __ROOT__ . '/public/css',
        '__IMAGES__' => __ROOT__ . '/public/images',
        '__HOME__' => __ROOT__ . '/public/home',
    ),

    'ADMIN_AUTH_KEY' => 'Adminstrator',
    'ADMIN_AUTH' => 'admin_uid',
    'USER_AUTH' => 'uid',
    'URL_MODEL' => 2,
    'APP_BASEURL' => 'http://www.elevatorchina.com',
    //'Email'				=> '455499395@qq.com',
    'ALIPAY_CONFIG' => array(
        'sign_type' => strtoupper('MD5'),
        'cacert' => getcwd() . '\\cacert.pem',
        'transport' => 'http',
        'input_charset' => strtolower('utf-8'),
        'payment_type' => 1,
    ),
    'PARTNER' => '2088021647973355',
    'ALIKEY' => 'fzc7ljqi4tkzsjt8xx24qm6oxjliq62d',
    'SELLER_EMAIL' => 'elevator-pay@ttchina.com',
    'NOTIFY_URL' => 'http://www.elevatorchina.com/pay/notify_url',
    'RETURN_URL' => 'http://www.elevatorchina.com/pay/return_url',
    'EXTER_INVOKE_IP' => '220.194.44.61',
    'WEBSITE_URL' => 'http://www.elevatorchina.com',
    //每一块钱加多少爱心积分
    'LOVE_VALUE'=>3,
    //支付方式
    'PAY_TYPE' => array(
        '1' => 'booth',
        '2' => 'AdAddress'
    ),
    // 银行帐号
    'BANK' => array(
        1 => array(
            'name' => 'xxxxxx有限公司',
            'number' => 'xxxxxxxx',
            'bank' => '中国银行廊坊开发区支行',
        ),
    ),

    'SEND_SMS' => array(
        //阿里  id
        'ACCESSKEYID' => 'LTAItojMpMdOwK4x',//郑州项目（云帅）
        //阿里  secret
        'ACCESSKEYSECRET' => 'KVv1PFEc5dVAmWvV1yLcn3qWf3l1EM',
        //ali 短信签名
        'SMS_SIGN' => '亿链',
        //ali  短信模板
        // 'SMS_MODE_CODE' => 'SMS_118035028',
        'SMS_MODE_CODE' => 'SMS_134165108',
    )
);