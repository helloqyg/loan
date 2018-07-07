<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

class AnnounceController extends BaseController
{

    public function index()
    {
        $this->result = M('Announce')->order('date desc')->select();
        $this->display();
    }


    /**
     * 以get方式提交提交helpIt页面进行处理
     */

    public function confirmHelpIt()
    {
        $data = I('get.');
        dump($data);
    }

    public function helpIt()
    {
        if (IS_GET) {
            $province = I('get.province', 0, 'intval');
            $city = I('get.city', 0, 'intval');
            //根据患者家乡匹配项目
            if ($province == $city) {
                $badUserIdArray = M('Member')->where(array('home_province' => $province))->field('id')->select();
            } else {
                $badUserIdArray = M('Member')->where(array('home_province' => $province, 'home_city' => $city))->field('id')->select();
            }
            $userIdArr = '';
            foreach ($badUserIdArray as $value) {
                $userIdArr .= ',' . $value['id'];
            }
            $userIdArr = ltrim($userIdArr, ',');
            //查询符合地区条件的项目
            $this->selectItem = M('Rescue')->where(array('user_id' => array('in', $userIdArr), 'status' => 3))->select();
            $this->selectItemCount = count($this->selectItem);
            //查询出省份和城市
            $provinceString = M('Provinces')->where(array('provinceid' => $province))->field('province')->find();
            $cityString = M('Cities')->where(array('cityid' => $city))->field('city')->find();
            //地址分配到页面
            $this->assign('address', $provinceString['province'] . '-' . $cityString['city']);
            $this->display();
        }

        if (IS_POST) {
            $model = M('Announce');
            if ($model->create()) {
                $model->date = time();
                $model->user_id = get_user_id();
                $model->add();
            }
            $this->redirect('announce/index');
        }
    }


    /**
     * 点赞
     */

    public function good()
    {
        if (IS_POST) {
            //点赞
            if (I('post.flag') == 'good') {
                M('Good')->data(array('announce_id' => I('post.announce_id'), 'user_id' => get_user_id()))->add();
            }
            //取消
            if (I('post.flag') == 'cancel') {
                M('Good')->where(array('announce_id' => I('post.announce_id'), 'user_id' => get_user_id()))->delete();
            }
        }
    }
}