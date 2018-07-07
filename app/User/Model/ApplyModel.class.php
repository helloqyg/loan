<?php 

/**
 * 企业注册模型
 * @author       widuu <admin@widuu.com>
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/08/3
 */

namespace User\Model;

class ApplyModel extends \Think\Model{

	//自动验证
	protected $_validate = array(
			array('company_name','require','企业名称不能为空'), //默认情况下用正则进行验证
	 		array('email','require','邮箱不能为空'),  
	 	);

}