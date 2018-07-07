<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class MutualController extends BaseController
{

    public function index()
    {
        //会员个数
        $member_count = M('MutualUser')->where(array('status' => 1))->count();
        $total_price = M('')->query("select SUM(price) total from wd_mutual_user ");
        $this->member_count = $member_count;
        $this->total_price = $total_price[0]['total'];
        $this->display();
    }

    /**加入家人互助列表
     *
     */
    public function joinList()
    {
        $this->result = M('HomeMutual')->order('id desc')->select();
        $this->display();
    }


    /*
     *详细信息
     */

    public function detail()
    {
        $this->result = M('HomeMutual')->find(I('get.id'));
        $this->display();
    }


    //付款
    public function helpIt()
    {
        $result = M('HomeMutual')->find(I('get.id'));
        $count = M('MutualUser')->where(array('mutual_id' => I('get.id'), 'user_id' => get_user_id(), 'status' => 0))->count();
        $totalPrice = $result['price'] * $count;
        $this->totalPrice = $totalPrice;
        $this->display();
    }


    //添加家人互助
    public function familyAttend()
    {
        if (IS_GET) {
            //每次进到这个页面自动清空跟这个用户有关并且没有支付的所有记录。
            //M('MutualUser')->where(array('user_id'=>get_user_id(),'status'=>0))->delete();
            $id = I('get.id', 0, 'intval');
            if ($id == 0) {
                $this->error('参数错误');
            }
            $this->display();
        }

        if (IS_POST) {
            // dump(I('post.'));
            $dataArr = I('post.');
            $nameArr = I('post.auth_name');
            $idArr = I('post.auth_id');
            $len = count($nameArr);
            $idString = '';
            $price = M('HomeMutual')->find(I('post.mutual_id'));
            //先存到数据库状态为0，一旦订单支付成功就会改为1.
            for ($i = 0; $i < $len; $i++) {
                $map['user_id'] = get_user_id();
                $map['auth_name'] = $nameArr[$i];
                $map['auth_id'] = $idArr[$i];
                $map['mutual_id'] = I('post.mutual_id');
                $map['price'] = $price['price'];
                $id = M('MutualUser')->data($map)->add();
                $idString .= ',' . $id;
            }
            $this->redirect('helpIt', array('id' => I('post.mutual_id'), 'idArr' => $idString));
        }
    }


    public function personal_center()
    {
        $user_id = get_user_id();
        $this->result = M('MutualUser')->where(array('user_id' => $user_id, 'status' => 1))->select();
        // dump($this->result);
        $this->display();
    }


    /**
     *互助公示列表
     */
    public function bulletin()
    {
        $this->result = M('MutualUser')->where(array('status' => 1))->select();
        // dump($this->result);
        $this->display();

    }
}