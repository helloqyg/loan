<?php

/**
 * registeration page function
 * @author       qyg
 * @version      0.1
 * @copyright    Copyright (c) 2015 http://www.widuu.com
 * @date      	 2015/07/27
 */

namespace User\Controller;
use Common\Util\UserAuth;


class RegController extends \Think\Controller {

    public function _initialize(){
        // 设置配置文件
        C(array(
            'FINANCE_EMAIL' => get_config('FINANCE_EMAIL'),
            'PRODUCT_EMAIL' => get_config('PRODUCT_EMAIL'),
            )
        );
    }

    /**
     * registeration function and registeration page
     * @author qyg
     */

    public function index(){
        // check login status
        if ( check_login() ){
            $this->redirect( '/user/index' );
        }
    	// get the registeration page id  
    	$step = I( 'get.id', 0 , 'intval');
    	// registeration page
    	if( IS_GET ){
    		// page title
	    	$this->title = "会员注册";
	    	// Step corresponding to the registration page
	    	switch ( $step ) {
	    		case 0:
	    			$this->redirect('/user/reg/step/1');
	    			break;
	    		case 1:
	    			$this->display();
	    			break;
	    		case 2:
					$this->register_num = M('Company')->getFieldById(get_cid(),'register_num');
	    			$this->display('member');
	    			break;
	    		case 3:
	    			$this->display('examine');
	    			break;
	    		default:
	    			$this->redirect('/user/reg/step/1');
	    			break;
	    	}
    	}
    	
    	// registered user infomation
    	if( IS_POST ){
            // register company infomation
    		if ( $step == 1 ) {
                $result = UserAuth::company_register();
                if( $result['status'] ){
                    $this->success('添加成功','/user/reg/step/2.html');
                }else{
                    $this->error( $result['info'] );
                }
                
    		}
            // register member 
            if ( $step == 2 ){
                $uid = UserAuth::register(I('post.'),false,get_cid());
                if( $uid['status'] ){
                    cookie('uid' ,$uid['uid']);
                    cookie('username',I('post.username'));
                    cookie('gid',2);
                    session('uid' ,$uid['uid']);
                    session('username',I('post.username'));
                    session('gid',2);
                    $email[] = C('PRODUCT_EMAIL');
                    \Sendcloud\Send::send_template('team@elevator-expo.com','',$email,'用户注册提醒','user_register','','','','','',true,false,false);
                    $this->success('注册成功','/user/reg/step/3.html');
                }else{
                    $this->error( $uid['info'] );
                }
            }
    	}
    	
    }


    /**
     * file upload function
     *
     * @author qyg
     */

    public function upload(){
        // upload config
        $config = array(    
            'maxSize'    =>    3145728,    
            'rootPath'   =>    BASE_PATH.'/upload/',    
            'saveName'   =>    array('uniqid',''),    
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg','xls'),   
            'autoSub'    =>    true,    
            'subName'    =>    array('date','Ymd'),
        );

        // initialization the upload class
        $upload = new \Think\Upload($config);   
        $info   =   $upload->upload();
        if(!$info) {       
            $this->error($upload->getError());
        }else{
            $data['url'] = $info['upfile']['savepath'].$info['upfile']['savename'];
            $data['state'] = 'SUCCESS';
            echo json_encode($data);
            exit();
        }
    }
}