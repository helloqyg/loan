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

	//自动验证
	protected $_validate = array(
			array('scan_part','require','必须上传营业执照副本扫描件！'), //默认情况下用正则进行验证
	 		array('company_name','','企业名称已经被注册',0,'unique',1),  
	 	);

}