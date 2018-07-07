<?php

/**
 * backstage manager page
 * @author    qyg
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/07/27
 */

namespace User\Controller;

class ConfirmController extends \Think\Controller
{

    /**
     * repassword
     * @author qyg
     */

    public function repassword()
    {
        if (IS_GET) {
            $code = I('get.code', '', 'trim');
            if (empty($code)) $this->error('参数错误');
            $this->salt = $code;
            $this->title = "重置密码";
            $this->display();
        }

        if (IS_AJAX) {
            $salt = I('post.salt', '', 'trim');
            $password = I('post.password', '', 'trim');
            $map['salt'] = base64_decode($salt);
            $data['password'] = compile_password($password, $map['salt']);
            $result = M('Member')->where($map)->save($data);
            if ($result) {
                $this->success('修改密码成功', '/user/login');
            } else {
                $this->error('修改密码失败');
            }
        }
    }

    /**
     * forgot page
     * @author qyg
     */

    public function forgot()
    {
        if (IS_GET) {
            $this->title = "重置密码";
            $this->display();
        }

        if (IS_AJAX) {
            $map['f_email'] = I('post.email', '', 'trim');
            if (empty($map['f_email'])) {
                $this->error('邮箱不存在');
            }
            $company_info = M('Company')->where($map)->find();
            if (empty($company_info)) $this->error('用户不存在');
            $userinfo = M('Member')->field('salt,id')->where("cid=" . $company_info['id'])->find();
            $code = base64_encode($userinfo['salt']);
            $url = C('APP_BASEURL') . U('repassword') . '?code=' . $code;
            $sub = array('%repassword%' => array($url));
            $email = array($map['f_email']);
            $result = \Sendcloud\Send::send_template('team@elevator-expo.com', $sub, $email, '密码重置', 'repassword', '', '', '', '', '', true, false, false);
            if ($result['status'] != 1) {
                $this->error('找回失败请联系管理员');
            } else {
                $this->success('请登录邮箱重置密码');
            }
        }
    }

}
