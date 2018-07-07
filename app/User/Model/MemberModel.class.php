<?php 

/**
 * 企业注册模型
 * @author       widuu <admin@widuu.com>
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/08/3
 */

namespace User\Model;

class CompanyModel extends \Think\Model{
	
	// auto validata
	protected $_validate = array(
	 		array('username','','用户名已存在',0,'unique',1),  
	 	);

	// auto complete
	protected $_auto = array ( 
			array('group_id','2'), 
		 	array('last_login','time',2,'function'),  
			array('last_ip','get_client_ip',3,'callback'),
		);
}