<?php

/**
 * 前台程序
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;

use Think\Cache\Driver\Redis;

class CenterController extends BaseController
{

    public function index()
    {
        // dump(real_name_auth_1('411328199412017791','乔永刚'));die;
        //user id
        $userId = get_user_id();
        $this->userInfo = M('Member')->find($userId);
        $this->display();
    }


    /**
     *
     *
     */
    public function warrant()
    {
        $user_id = get_user_id();
        $model = M('Witness');
        //查询出当前用户筹款中的项目
        $rescueData = M('Rescue')->where(array('user_id' => $user_id, 'status' => 3))->find();
        $warrantData = $model->where(array('item_id' => $rescueData['id'], 'item_user_id' => $user_id))->select();
        $this->warrantData = $warrantData;
        // dump($warrantData);
        $this->display();
    }


    /**
     * 我要使用
     * 只有项目已经结束并且欠款未使用的情况可以提交申请
     *
     */

    public function use_money()
    {
        if (IS_GET) {
            //status=4 项目已结束。  is_end 项目资金是否已使用
            $rescue = M('Rescue')->where(array('user_id' => get_user_id(), 'status' => 4, 'money_is_use' => 0))->field('id,title')->select();
            foreach ($rescue as $key => &$value) {
                $value['type'] = 1;
            }
            $dream = M('Dream')->where(array('user_id' => get_user_id(), 'status' => 4, 'money_is_use' => 0))->field('id,title')->select();
            foreach ($dream as $key => &$value) {
                $value['type'] = 2;
            }
            $gongyi = M('Gongyi')->where(array('user_id' => get_user_id(), 'status' => 4, 'money_is_use' => 0))->field('id,title')->select();
            foreach ($dream as $key => &$value) {
                $value['type'] = 3;
            }
            $a = array_merge($rescue, $dream);
            //使用哪个项目的资金
            $this->itemInfo = array_merge($a, $gongyi);
            //使用后，提交哪个项目资料>>>>>>>>>>>>>
            $useMoney_rescue = M('UseMoney')->where(array('user_id' => get_user_id(), 'type' => 1))->select();
            $useMoney_dream = M('UseMoney')->where(array('user_id' => get_user_id(), 'type' => 2))->select();
            $useMoney_gongyi = M('UseMoney')->where(array('user_id' => get_user_id(), 'type' => 3))->select();
            $rescue_arr = '';
            $dream_arr = '';
            $gongyi_arr = '';
            foreach ($useMoney_rescue as $k => $v) {
                $rescue_arr .= ',' . $v['item_id'];
            }
            foreach ($useMoney_dream as $k => $v) {
                $dream_arr .= ',' . $v['item_id'];
            }
            foreach ($useMoney_gongyi as $k => $v) {
                $gongyi_arr .= ',' . $v['item_id'];
            }
            $rescue_arr = ltrim($rescue_arr, ",");
            $dream_arr = ltrim($dream_arr, ",");
            $gongyi_arr = ltrim($gongyi_arr, ",");
            if ($rescue_arr) {
                $after1 = M('Rescue')->query("select * from wd_rescue where id in ({$rescue_arr})");
                foreach ($after1 as $key => &$value) {
                    $value['type'] = 1;
                }
                $this->assign('afterItem', $after1);
            }
            if ($dream_arr) {
                $after2 = M('Dream')->query("select * from wd_dream where id in ({$dream_arr})");
                foreach ($after2 as $key => &$value) {
                    $value['type'] = 2;
                }
                $aa = array_merge($after1, $after2);
                $this->assign('afterItem', $aa);
            }
            if ($gongyi_arr) {
                $after3 = M('Gongyi')->query("select * from wd_gongyi where id in ({$gongyi_arr})");
                foreach ($after3 as $key => &$value) {
                    $value['type'] = 3;
                }
                $c = array_merge($aa, $after3);
                $this->assign('afterItem', $c);
            }
            //使用后，提交哪个项目资料 结束<<<<<<<<<<<
            //查询出已提交的信息
            $this->before = M('UseMoney')->where(array('user_id' => get_user_id(), 'flag' => 1))->select();
            $this->after = M('UseMoney')->where(array('user_id' => get_user_id(), 'flag' => 2))->select();
            $this->display();
        }

        if (IS_POST) {
            $sd = I('post.sd');
            $imgArray = I('post.array');
            if ($imgArray) {
                $img_arr = '';
                foreach ($imgArray as $value) {
                    $img_id = M('Images')->data(array('url' => $value))->add();
                    $img_arr .= ',' . $img_id;
                }

            }
            if (I('post.sd') == 'after') {
                M('UseMoney')->where(array('user_id' => get_user_id(), 'item_id' => I('post.item_id'), 'type' => I('post.type'), 'flag' => 2))->delete();
            }
            if (I('post.sd') == 'before') {
                M('UseMoney')->where(array('user_id' => get_user_id(), 'item_id' => I('post.item_id'), 'type' => I('post.type'), 'flag' => 1))->delete();
            }
            //判断用户再次进到该页面 是修改而不是添加。
            $model = M('UseMoney');
            if ($model->create()) {
                $model->date = time();
                $model->user_id = get_user_id();
                $model->img_arr = $img_arr;
                if ($model->add()) {
                    $this->ajaxReturn(1);
                } else {
                    $this->ajaxReturn(0);
                }
            }

        }
    }


    //身份认证

    public function attestation()
    {
        if (IS_GET) {
            $user_id = get_user_id();
            $result = M('Member')->query("select *  from wd_member where auth_id != '' and auth_name !='' and id={$user_id}  ");
            if ($result) {
                $this->auth = $result[0];
                $this->is_auth = 1;
            } else {
                $this->is_auth = 0;
            }
            $this->display();
        }

        if (IS_POST) {
            $me_id = I('post.me_id');
            $name = I('post.name');
            $result = real_name_auth($name, $me_id);
            $user_id = get_user_id();
            if ($result == 0) {
                M('Member')->where(array('id' => get_user_id()))->save(array('auth_name' => $name, 'auth_id' => $me_id, 'is_auth' => 1));

                // query("update wd_member set auth_name={$name},auth_id={$me_id} where user_id = {$user_id} ");


            }
            $this->ajaxReturn($result);
        }
    }

    /**
     * 我的爱心喇叭
     */

    public function myLove()
    {
        if (IS_GET) {
            $this->result = M('Announce')->where(array('user_id' => get_user_id()))->select();
            $this->display();
        }
        if (IS_POST) {

        }
    }

    /**
     * 个人信息
     */

    public function set()
    {
        $this->result = M('Member')->find(get_user_id());
        $this->display();
    }


    /**
     * 设置个人信息，针对弹框信息
     */

    public function set_info()
    {
        if (IS_POST) {
            $column = I('post.column');
            $value = I('post.value');
            $result = M('Member')->where(array('id' => get_user_id()))->save(array($column => $value));
            if ($result) {
                $this->ajaxReturn(1);
            }
            {
                $this->ajaxReturn(0);
            }
        }
    }



    public function test_(){
        if (IS_GET) {
            $this->display();
        }
        if (IS_POST) {
            $model = M('Config');
            $model->create();
            if ($model->add()) {
                echo 'success';
            }else{
                echo 'error';
            }

        }
    }

    /**
     * 测试返回数据的类
     */

    public function testClass(){
        if (IS_GET){
            $obj = new ReturnData();
            $obj->setCode(123);
            $obj->setMessage('456');
            $obj->setStatus('true');
            dump($obj);
            dump(json_encode($obj,true));
            $this->display();
        }
        if (IS_POST){
            cookie(null);
            $obj = new ReturnData();
            $obj->setCode(123);
            $obj->setMessage('456');
            $obj->setStatus(true);
            $this->ajaxReturn($obj->getAll());
        }
    }

    /**
     *我帮助的
     */

    public function helped()
    {
        if (IS_GET) {
            $this->display();
        }
        if (IS_POST) {
            $user_id = get_user_id();
            $id = I('post.param');
            if ($id == 0) {
                $result = M('Donor')->query("select d.*,m.username,m.photo from wd_donor as d left join wd_member m on d.user_id = m.id where d.user_id={$user_id} order by date desc");
                $this->ajaxReturn($result);
            }

            if ($id == 1) {
                $result = M('Follow')->query("select f.*,m.username,m.photo from wd_follow f left join wd_member m on f.user_id = m.id where  f.user_id={$user_id}   ");
                foreach ($result as $key => &$value) {
                    if ($value['type'] == 1) {
                        $title = M('Rescue')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                        $value['status'] = $title['status'];
                    }
                    if ($value['type'] == 2) {
                        $title = M('Dream')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                        $value['status'] = $title['status'];
                    }
                    if ($value['type'] == 3) {
                        $title = M('Gongyi')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                        $value['status'] = $title['status'];
                    }
                }
                $this->ajaxReturn($result);
            }

            if ($id == 2) {
                $result = M('report')->query("select f.*,m.username,m.photo from wd_report f left join wd_member m on f.user_id = m.id where  f.user_id={$user_id}  ");
                foreach ($result as $key => &$value) {
                    if ($value['type'] == 1) {
                        $title = M('Rescue')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                    }
                    if ($value['type'] == 2) {
                        $title = M('Dream')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                    }
                    if ($value['type'] == 3) {
                        $title = M('Gongyi')->field('title,status')->find($value['item_id']);
                        $value['title'] = $title['title'];
                    }
                }
                $this->ajaxReturn($result);
            }
        }
    }

    /**
     * 获取验证码
     */
    public function get_verify()
    {
        if (IS_POST) {
            $code = rand(1000, 9999);
            $phone = I('post.phone');
            $Obj = send_sms($phone, $code);
            if ($Obj->Code == 'OK') {
                session('verify', $code);
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(0);
            }
        }
    }

    /**
     * 绑定手机号-ajax
     */
    public function phone()
    {
        if (IS_GET) {
            //判断是否是修改手机号
            $flag = I('get.flag', 0, 'intval');
            if ($flag == 1) {
                $this->display('phone');
                return;
            }
            $this->result = M('Member')->find(get_user_id());
            $this->display();
        }
        if (IS_POST) {
            $code = I('post.code');
            $phone = I('post.phone');
            if ($code == session('verify')) {
                M('Member')->where(array('id' => get_user_id()))->save(array('phone' => $phone));
                $this->ajaxReturn(1);
            } else {
                $this->ajaxReturn(0);
            }
        }
    }

    public function introduce()
    {
        $this->result = M('Config')->where(array('name' => 'HELP_CENTER'))->FIND();
        $this->display();
    }


    /**
     * 我发起的
     */

    public function faqi()
    {
        $id = I('get.id', 0, 'intval');
        if ($id == 0) {
            $this->error('参数错误');
        }
        $this->result = M('Rescue')->where(array('status' => $id, 'user_id' => get_user_id()))->select();
        $this->display();
    }

    /**
     * 关注
     */
    public function follow()
    {
        $this->result = M('Follow')->where(array('user_id' => get_user_id()))->select();
        $this->display();
    }


}