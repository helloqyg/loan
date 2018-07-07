<?php


return array(
	'MODULE_ALLOW_LIST'    =>  array('App','Manager','User'),
	'DEFAULT_MODULE'       =>  'App',	
	'DEFAULT_ACTION'       =>  'index',
	'DEFAULT_TIMEZONE'     =>  'PRC',  
	'TMPL_L_DELIM'         =>  '<{',           
	'TMPL_R_DELIM'         =>  '}>',  
	'HTML_FILE_SUFFIX'     =>  '.html',
	'URL_HTML_SUFFIX'	   =>  '.html',
	'SESSION_AUTO_START'   =>  true,           //是否开启session
   	//'SHOW_PAGE_TRACE'      =>  true,          //开启trace
    'URL_CASE_INSENSITIVE' =>  true,   	 	   //忽略大小写
   	'LOAD_EXT_CONFIG' 	   =>  'db', 
   	'COOKIE_EXPIRE'        =>  'widuu',
   	'TMPL_ACTION_ERROR'    =>  BASE_PATH.'/public/error.html',
   	'TMPL_PARSE_STRING'    =>  array(
			'__PUBLIC__'   =>  '/public',
    		'__JS__'	   => '/public/js',
    		'__CSS__'      => '/public/css',
    		'__IMAGES__'   => '/public/images',
    	),

	'ADMIN_AUTH_KEY'    => 'Adminstrator',
	'ADMIN_AUTH' 		=> 'admin_uid',
	'USER_AUTH'  		=> 'uid', 
	'URL_MODEL'			=> 2,
	'APP_BASEURL'       => 'http://www.elevatorchina.com',
	//'Email'				=> '455499395@qq.com',
	'ALIPAY_CONFIG'		=> array(
			'sign_type' => strtoupper('MD5'),
			'cacert'	=>  getcwd().'\\cacert.pem',
			'transport' => 'http',
			'input_charset'=>strtolower('utf-8'),
			'payment_type' => 1,
		),
	'PARTNER'	=> '2088021647973355',
	'ALIKEY'	=> 'fzc7ljqi4tkzsjt8xx24qm6oxjliq62d',
	'SELLER_EMAIL' => 'elevator-pay@ttchina.com',
	'NOTIFY_URL'   => 'http://www.elevatorchina.com/pay/notify_url',
	'RETURN_URL'   => 'http://www.elevatorchina.com/pay/return_url',
	'EXTER_INVOKE_IP' => '220.194.44.61',
	'WEBSITE_URL'  => 'http://www.elevatorchina.com',
);