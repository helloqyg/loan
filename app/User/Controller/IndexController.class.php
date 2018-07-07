<?php

/**
 * User index page
 * @author       qyg
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/08/4
 */

namespace User\Controller;

class IndexController extends BaseController {
    
    /**
     * User page
     * @author qyg
     */

    public function index(){
    	$uid = get_uid();
		$company_id = M('Member')->getFieldById($uid,'cid');
		$this->company_info = M('Company')->find($company_id);
		$this->title = "会员中心";
		$this->display('Account:company');
    }
}