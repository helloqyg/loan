<?php

/**
 * 鍓嶅彴绋嬪簭
 * @author       涔旀案鍒� <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class LoginController extends \Think\Controller{

    /**
     * login page and login function
     *
     * @author qyg
     */


//TODO
    public function index(){
        //judage login status
        if( session('userinfo') ){
            $this->redirect('/index/index');
        }
        // login page
        if( IS_GET ){
            $this->display();
        }

        if( IS_POST ){
            $userinfo 	= I('post.');
            $result = M('Member')->where(array('username'=>$userinfo['username']))->find();
            if ($result) {
                session('userinfo',$result['id']);
                $this->redirect('index/index');
            }  else{
                $this->error('璐﹀彿瀵嗙爜閿欒');
            }
        }
    }

    /**
     * user exit function
     * @author qyg
     */

    public function loginout(){
        UserAuth::loginout();
        $this->redirect('/user/index');
    }

    /**
     * verification code
     *
     * @author qyg
     */

    public function verify(){
        $verify = new \Think\Verify();
        $verify->fontSize =20;
        $verify->imageW = 162;
        $verify->useCurve= false;
        $verify->imageH = 40;
        $verify->length = 4;
        ob_end_clean();
        //dump($verify);
        $verify->entry();

    }

    /**
     * verify verification code
     * @author qyg
     */

    public function check_verify( $id = ''){
        $code = I('get.code');
        $verify = new \Think\Verify();
        if( $verify->check($code, $id) ){
            echo 1;
        }else{
            echo 1;
        }
    }
}