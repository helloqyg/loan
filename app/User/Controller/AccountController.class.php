<?php

/**
 * User manager center
 * @author    qyg
 * @version   0.1
 * @copyright Copyright (c) 2015 http://www.widuu.com
 * @date      2015/08/4
 */

namespace User\Controller;

use Common\Util\UserAuth;

class AccountController extends BaseController
{

    /**
     * modify password
     * @author qyg
     */

    public function password()
    {
        // modify password page
        if (IS_GET) {
            $this->title = "修改密码";
            $this->display();
            return;
        }

        if (IS_AJAX) {
            $result = UserAuth::modify_password(I('post.password', '', 'trim'));
            if ($result) {
                $this->success('修改成功');
                return;
            } else {
                $this->error('修改失败');
            }
        }
    }

    /**
     * check password
     * @author qyg
     */

    public function check_password()
    {
        if (IS_AJAX) {
            $password = I('post.password', '', 'trim');
            $result = check_password($password);
            if ($result) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }


    /**
     * company infomation page
     * @author qyg
     */

    public function company()
    {
        //判断用户登录后第几次刷新company
        $a = session('count');
        $a++;
        session('count', $a);
        $this->assign('count', $a);
        $uid = get_uid();
        $company_id = M('Member')->getFieldById($uid, 'cid');
        $this->company_info = M('Company')->find($company_id);
        $this->username = M('Member')->field('username')->where(array('id' => $uid))->find();
        //展位订单
        $this->exhi_count = M('Order')->where(array('ad_type' => 1, 'uid' => $uid, 'status' => array('neq', '1')))->count();
        //广告订单
        $this->ad_count = M('Order')->where(array('ad_type' => 2, 'uid' => $uid, 'status' => array('neq', '1')))->count();
        //dump($this->ad_count);
        //上次登录时间
        $this->lastLogin = M('Member')->where(array('id' => $uid))->find();
        //用户认证时间
        $this->rtime = M('Company')->where(array('id' => $this->lastLogin['cid']))->find();
        $this->title = "企业信息";
        $this->display();
    }

    /**
     * person booth
     * @version 0.11
     * @author qyg
     */
    //下订单之后,再点击则只可以查看购买的展位,不可再次购买
    public function booth()
    {
        $where['uid'] = get_uid(false);
        //查询当前用户的订单
        $order = M('Order')->where($where)->find();
        //取出当前用户的展位id|广告id
        $booth = M('Booth')->find($order['bid']);
        //dump($booth);exit();
        // 展位分区和不分区的
        $this->booth = $booth['booth_num']; //取出用户所下的订单区域号 7d98
        $this->hall_info = M('Hall')->find($booth['hid']);
        $this->title = "个人展位";
        if (!empty($booth['hall_area'])) {
            //echo 'hall_area_'.$booth['hall_area'];
            $this->display('hall_area_' . $booth['hall_area']);
        } else {
            $this->display('hall' . $booth['hid']);
        }


    }
}

