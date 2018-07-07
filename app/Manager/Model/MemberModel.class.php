<?php

/**
 * Backstage member module 
 * @author    widuu <admin@widuu.com>
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/08/4
 */

namespace Manager\Model;

class MemberModel extends \Think\Model\ViewModel{
	public $viewFields = array(    
		'Member'  => array('id','username','group_id','status','is_admin','cid'),     
		'Company' => array('company_name','register_num','scan_part','residence',
			'address','scope','type','c_name','c_tel','c_email','c_duties',
			'c_phone','c_fax','f_name','f_tel','rtime','f_email','f_duties','f_phone',
			'f_fax','_on'=>'Member.cid=Company.id'
		),        
	);
}