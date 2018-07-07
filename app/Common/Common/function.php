<?php

/**
 * 公共函数库
 * @author     widuu <admin@widuu.com>
 * @version       0.1
 * @copyright   Copyright (c) 2015 http://www.widuu.com
 * @date        2015/07/27
 */

//---------------------------------------------------------------



/**
 * 生成密码种子
 * @param  integer 长度
 * @return string 密码种子
 * @author widuu <admin@widuu.com>
 */

function fetch_salt($length = 4)
{
    for ($i = 0; $i < $length; $i++) {
        $salt .= chr(rand(97, 122));
    }

    return $salt;
}

/**
 * 根据 salt 混淆密码
 * @param  string passowrd 密码
 * @param  string salt     混淆密码
 * @author widuu <admin@widuu.com>
 * @return string 密码
 */

function compile_password($password, $salt)
{
    $password = md5($password);

    return $password;
}

/**
 * 检查是否邮箱
 * @param  string email
 * @return bool
 * @author widuu <admin@widuu.com>
 */

function check_email($email)
{
    return (ereg("^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+", $email));
}

/**
 * 检查登录
 * @param  bool 后台标识
 * @return bool
 * @author widuu <admin@widuu.com>
 */

function check_login($admin = false)
{
    $uid_alise = $admin ? C('ADMIN_AUTH') : C('USER_AUTH');
    $uid = cookie($uid_alise) || session($uid_alise);
    return $uid ? $uid : false;
}

/**
 * 获取用户id
 * @return string uid
 * @author widuu <admin@widuu.com>
 */

function get_uid($admin = false)
{
    $uid_alise = $admin ? C('ADMIN_AUTH') : C('USER_AUTH');
    if (session($uid_alise)) return session($uid_alise);
    if (cookie($uid_alise)) return cookie($uid_alise);
}


/**
 * 获取用户id
 * @return string uid
 * @author widuu <admin@widuu.com>
 */

function get_user_id()
{

    if (session('user_id')) return session('user_id');
}

function get_pay_status($bid)
{
    $status = M('Pay')->getFieldByPid($bid, 'status');
    //echo $bid.'--'.$status;
    return $status;
}

/**
 * 获取用户组
 * @return string gid
 * @author widuu <admin@widuu.com>
 */

function get_gid()
{
    $gid_alise = 'gid';
    if (session($gid_alise)) return session($gid_alise);
    if (cookie($gid_alise)) return cookie($gid_alise);
}

/**
 * 配置信息
 * @param  配置参数名称
 * @author widuu <admin@widuu.com>
 */

function get_config($name = '')
{
    S('WEBSIET_CONFIG', null);
    $config = S('WEBSIET_CONFIG');
    if ($config == NULL) {
        $model_config = M('Config')->field('name,value')->select();
        foreach ($model_config as $value) {
            $config[$value['name']] = $value['value'];
        }
        S('WEBSIET_CONFIG', $config);
    }
    if (!empty($name)) return $config[$name];
    return $config;
}

/**
 * 获取用户登录状态来显示不同的页面
 *
 * @author widuu <admin@widuu.com>
 */

function check_user_login()
{
    $uid = cookie('uid') ? cookie('uid') : session('uid');
    $info = '';
    if (!$uid) {
        $info = "<a href='" . U('/user/reg', array('step' => 1)) . "' class='head_lr'>注册</a> &nbsp;&nbsp;";
        $info .= "<a href='" . U('/user/login') . "' class='head_lr'>登录</a>";
    } else {
        $username = M('Member')->getFieldById($uid, 'username');
        $info = "欢迎您回来，<a href='" . U('/user/account/company') . "'/>{$username}</a>";
    }

    return $info;
}

/**
 * 验证用户密码
 *
 * @author widuu <admin@widuu.com>
 */

function check_password($password)
{
    $uid = cookie('uid') ? cookie('uid') : session('uid');
    $userinfo = M('Member')->field('password,salt')->find($uid);
    if (compile_password($password, $userinfo['salt']) == $userinfo['password']) {
        return true;
    }
    return false;
}

/**
 * 字符截取 支持UTF8
 * @param $string
 * @param $length
 * @param $dot
 * @author widuu <admin@widuu.com>
 */

function str_cut($string, $length, $dot = '...')
{
    $strlen = strlen($string);
    if ($strlen <= $length) return $string;
    $string = str_replace(array(' ', '&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵', ' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
    $strcut = '';
    $length = intval($length - strlen($dot) - $length / 3);
    $n = $tn = $noc = 0;
    while ($n < strlen($string)) {
        $t = ord($string[$n]);
        if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
            $tn = 1;
            $n++;
            $noc++;
        } elseif (194 <= $t && $t <= 223) {
            $tn = 2;
            $n += 2;
            $noc += 2;
        } elseif (224 <= $t && $t <= 239) {
            $tn = 3;
            $n += 3;
            $noc += 2;
        } elseif (240 <= $t && $t <= 247) {
            $tn = 4;
            $n += 4;
            $noc += 2;
        } elseif (248 <= $t && $t <= 251) {
            $tn = 5;
            $n += 5;
            $noc += 2;
        } elseif ($t == 252 || $t == 253) {
            $tn = 6;
            $n += 6;
            $noc += 2;
        } else {
            $n++;
        }
        if ($noc >= $length) {
            break;
        }
    }
    if ($noc > $length) {
        $n -= $tn;
    }
    $strcut = substr($string, 0, $n);
    $strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);
    return $strcut . $dot;
}


/**
 * 阿里云短信发送
 * @param $phone 手机号
 * @param $code  验证码
 * @return stdClass
 */

function send_sms($phone, $code)
{
    //导入第三方类库
    Vendor('sendsms.api_demo.SmsDemo');
    $config = C('SEND_SMS');
    $accessKey = $config['ACCESSKEYID'];
    $accessSecret = $config['ACCESSKEYSECRET'];
    $modeCode = $config['SMS_MODE_CODE'];
    $sign = $config['SMS_SIGN'];
    $sendObj = new \SmsDemo();
    $response = $sendObj::sendSms($phone, $code, $accessKey, $accessSecret, $sign, $modeCode);
    return $response;
}

/**
 *实名认证接口
 * @param $name 姓名
 * @param $id 身份证号
 * @return  错误代码，0代表成功。
 */


function real_name_auth($name,$id){
    $host = "http://idcard3.market.alicloudapi.com";
    $path = "/idcardAudit";
    $method = "GET";
    $appcode = "76c601be97de44d197901b5d7f7e23f7";
    $headers = array();
    array_push($headers, "Authorization:APPCODE " . $appcode);
    $querys = "idcard={$id}&name={$name}";
    $bodys = "";
    $url = $host . $path . "?" . $querys;

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_FAILONERROR, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, true);
    if (1 == strpos("$".$host, "https://"))
    {
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    }
    $String = curl_exec($curl);

    $str1 = explode('{"showapi_res_code', $String);
    $str1 = "{\"showapi_res_code" . $str1[1];
    $str1 = substr($str1, 0, strlen($str1) - 1);
    $match = 'code":0,"msg":"匹配'; //0
    $no_match = '身份证与姓名不匹配';//1
    $re_match = '30秒以上再次核验';//2
    $no_id = '无此身份证号码';//3
    if (strpos($str1,$match)) {
        return 0;
    }
    if (strpos($str1,$no_match)) {
        return 1;
    }
    if (strpos($str1,$re_match)) {
        return 2;
    }
    if (strpos($str1,$no_id)) {
        return 3;
    }

    return $str1;
}

/**
 * 将字符串转换为数组
 *
 * @param    string $data 字符串
 * @return    array    返回数组格式，如果，data为空，则返回空数组
 */

function string2array($data)
{
    if ($data == '') return array();
    $data = stripslashes($data);
    @eval("\$array = $data;");
    return $array;
}

/**
 * 将数组转换为字符串
 *
 * @param    array $data 数组
 * @param    bool $isformdata 如果为0，则不使用new_stripslashes处理，可选参数，默认为1
 * @return    string    返回字符串，如果，data为空，则返回空
 */

function array2string($data, $isformdata = 1)
{
    if ($data == '') return '';
    if ($isformdata) $data = new_stripslashes($data);
    return addslashes(var_export($data, TRUE));
}

/**
 * 返回经stripslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */

function new_stripslashes($string)
{
    if (!is_array($string)) return stripslashes($string);
    foreach ($string as $key => $val) $string[$key] = new_stripslashes($val);
    return $string;
}

/**
 *
 * @param  userId 用户id
 * @param $flag 如果为true则为项目id
 * @return  url 用户头像
 */

function get_user_img($userId, $itemId = '')
{
    if ($userId == null) {
        return '';
    }
    if ($itemId != '') {
        $item = M('Rescue')->field('user_id')->find($userId);
        $img = M('Member')->field('photo')->find($item['user_id']);
        return $img['photo'];
    }
    $img = M('Member')->field('photo')->find($userId);
    return $img['photo'];
}


/**
 * 获得第一张图片
 * @param  $img img id组
 * @return url
 */
function get_first_img($img)
{
    $String = explode(',', $img);
    if ($img == '') return '';
    $data = M('Images')->find($String['1']);
    return $data['url'];
}

/**
 * 获得图片
 * @param  $id 图片id
 * @return url
 */
function get_img($id)
{
    $data = M('Images')->find($id);
    return $data['url'];
}



/**
 * 首页 明星慈善活动百分比进度条
 */
function get_star_ratio($starId){
    $cnt = M('GoodStar')->where(array('star_id' => $starId))->count();
    $denominator = 15;
    $data = $cnt/$denominator;

    if (!$cnt){
        return 0;
    }
    return $data*100;
}



/**
 * 获得爱心喇叭个数
 * @param
 * @return url
 */
function get_announce_count()
{
    $data = M('Announce')->where(array('user_id' => get_user_id()))->count();
    return $data;
}

/**
 *
 * @param int userId 用户id
 * @return  array 用户信息
 */

function get_username($userId, $itemId = '')
{
    if ($userId == null) {
        return '用户不存在';
    }
    if ($itemId != '') {
        $item = M('Rescue')->field('user_id')->find($userId);
        $username = M('Member')->field('username')->find($item['user_id']);
        return $username['username'];
    }
    $username = M('Member')->field('username')->find($userId);
    return $username['username'];
}


/**
 *判断已过去多少分钟
 * @param int 时间戳
 * @return  已过去几分钟
 */

function get_diff_time($time)
{
    $timeNow = time();
    $diff = $timeNow - $time;
    $min = $diff / 60;
    if (floor($min) == 0) {
        $data = '刚刚';
        return $data;
    }
    if ($min <= 60) {
        $data = floor($min) . '分钟前';
        return $data;
    }
    if ($min / 60 >= 1 && $min / 60 < 24) {
        $hour = floor($min / 60);
        $data = $hour . '小时前';
        return $data;
    }
    if ($min / 60 >= 24) {
        $day = floor($hour / 24);
        if ($day == 0) {
            $data = '1天前';
            return $data;
        }
        $data = $day . '天前';
        return $data;
    }
    return $data;

}



/**
 *获得当前用户在爱心救助栏目的数量
 * @param 状态
 */
function get_launch_cnt($status = '')
{
    if ($status == '') $status = '0,1,2,3,4';
    $user_id = get_user_id();
    $rescue = M('Rescue')->query("select count(*) as count from wd_rescue where user_id={$user_id} and status in ({$status})");
    return $rescue[0]['count'];
}

/**
 * @param $starId 明星id
 * @return int  明星获得点赞次数
 */

function get_star_good_cnt($starId)
{
    $data = M('GoodStar')->where(array('star_id' => $starId))->count();
    return $data;
}

/**
 *
 * @param int $itemId 项目id*
 * @param int $type 捐款类型，1代表筹款救助，2代表梦想清单
 * @return  array 获得筹款总额
 */

function get_sum_money($itemId, $type)
{
    $data = M('Donor')->where(array('item_id' => $itemId, 'type' => $type))->sum('price');
    if (!$data) {
        $data = 0;
    }
    return $data;
}

/**
 * 通过项目id获得捐款次数
 * @param int $itemId 项目id
 * @param int $type 捐款类型，1代表筹款救助，2代表梦想清单
 * @return  array 获得捐款人数
 */

function get_money_member($itemId, $type)
{
    $data = M('Donor')->distinct(true)->field('user_id')->where(array('item_id' => $itemId, 'type' => $type))->select();
    return count($data);
}

/**
 * 通过项目id获得捐款次数
 * @param int $itemId 项目id
 * @param int $type 捐款类型，1代表筹款救助，2代表梦想清单
 * @return  array 获得捐款次数
 */

function get_money_cont($itemId, $type)
{
    $data = M('Donor')->where(array('item_id' => $itemId, 'type' => $type))->count();
    return $data;
}

function get_donor_cont()
{
    $data = M('Donor')->where(array('user_id' => get_user_id()))->count();
    return $data;
}

/**
 * 获得筹款数额百分比
 * @param int $itemId 项目id
 * @param int $type 捐款类型，1代表筹款救助，2代表梦想清单
 * @return  array 获得捐款次数
 */

function get_money_ratio($itemId, $type)
{
    if ($type == 1) {
        //当前金额
        $current = M('Rescue')->field('target_money')->find($itemId);
        //目标金额
        $target = get_sum_money($itemId, $type);
        $ratio = intval($target) / intval($current['target_money']) * 100;
        if (!$ratio) {
            return 0;
        }
        return round($ratio);
    }
    if ($type == 2) {
        //当前金额
        $current = M('Dream')->field('target_money')->find($itemId);
        //目标金额
        $target = get_sum_money($itemId, $type);
        $ratio = intval($target) / intval($current['target_money']) * 100;
        if (!$ratio) {
            return 0;
        }
        return round($ratio);
    }
    if ($type == 3) {
        //当前金额
        $current = M('Gongyi')->field('target_money')->find($itemId);
        //目标金额
        $target = get_sum_money($itemId, $type);
        $ratio = intval($target) / intval($current['target_money']) * 100;
        if (!$ratio) {
            return 0;
        }
        return round($ratio);
    }
}

/**
 *查询剩余时间
 * @param $time 时间
 * @return day
 */

function overplus_time($time)
{
    $now_date = time();
    $diff = $now_date - $time;
    //一天是86400
    $data = 30 - floor($diff / 86400);
    return $data;
}

/**
 * 关注的人数
 * @param  user $userId
 * @return 关注人数
 */

function get_follow_member($userId)
{
    $count = M('Follow')->where(array('user_id' => $userId))->count();
    return $count;
}

/**
 * 获得今日筹款总额
 */

function get_today_donor()
{
    //2018-5-24 15:00:00 乔德秀所写
    //垃圾代码。先注释
    // $today = date("Y-m-d");
    // $todaystart = $today.' 00:00:00';
    // $todayend = $today.' 23:59:59';
    // M('Donor')->where('date_format(date, "%Y-%m-%d")>'.$todaystart.' and date_format(date, "Y-m-d") <'.$todayend)->select();

    $sum = M('Donor')->query('select sum(price) as sum from  wd_donor where  FROM_UNIXTIME(date,"%Y-%m-%d")    =  CURDATE()   ');
    if (!$sum[0]['sum']) {
        return '0';
    }
    return $sum[0]['sum'];
}

/**
 * 评论次数
 * @param   $donorId  捐款id
 * @param   $type 1筹款  2梦想清单
 * @return 关注人数
 */

function get_comments_cnt($donorId, $type)
{
    $count = M('Comments')->where(array('donor_id' => $donorId, 'type' => $type))->count();
    return $count;
}

/**
 * 判断点赞 -爱心宣言
 * @param announce_id 爱心宣言id
 * @param string $path
 * @return 1代表已经点赞，0代表未点赞
 */

function get_current_good($announce_id)
{
    $result = M('Good')->where(array('user_id' => get_user_id(), 'announce_id' => $announce_id))->find();
    if ($result) {
        return 1;
    } else {
        return 0;
    }
}

/**
 * @return 获取关注的数量
 */

function get_follow_cnt()
{
    $user_id = get_user_id();
    $cnt = M('')->query("select count(*) as count from wd_follow where user_id = {$user_id}");
    return $cnt[0]['count'];
}

/**
 * @return 获取关注的数量
 */

function get_report_cnt()
{
    $user_id = get_user_id();
    $cnt = M('')->query("select count(*) as count from wd_report where user_id = {$user_id}");
    return $cnt[0]['count'];
}

/**
 * 判断点赞 -明星
 * @param announce_id 爱心宣言id
 * @param string $path
 * @return 1代表已经点赞，0代表未点赞
 */

function get_current_good_star($starId)
{
    //查询当前用户当前记录的最后一条
    $model = M('GoodStar');
    $lastRecord = $model->where(array('user_id' => get_user_id(), 'star_id' => $starId))->order('id desc')->find();
    $currentTime = time();
    $lastTime = $lastRecord['date'];
    if ($currentTime - $lastTime < 86400) {
        return 1;
    } else {
        return 0;
    }
//    $result = $model->where(array('user_id' => get_user_id(), 'star_id' => $starId))->find();
//    if ($result) {
//        return 1;
//    } else {
//        return 0;
//    }
}

/**
 * 点赞次数
 * @param announce_id 爱心宣言id
 * @param string $path
 * @return int
 */

function get_current_good_cnt($announce_id)
{
    $result = M('Good')->where(array('announce_id' => $announce_id))->count();
    return $result;
}



/**
 * 获取互助公示列表的饿title
 * @param 
 * @param itemId  项目id
 * @return 
 */


function get_mutual_title($itemId){
    $data = M('HomeMutual')->find($itemId);
    return $data['title'];
}

/**
 * 点赞次数
 * @param type 项目类型，
 * @param itemId  项目id
 * @return title  string
 */

function get_item_name($type, $itemId)
{
    if ($type == 1) {
        $data = M('Rescue')->field('title')->find($itemId);
    } else if ($type == 2) {
        $data = M('Dream')->field('title')->find($itemId);
    } else if ($type == 3) {
        $data = M('Gongyi')->field('title')->find($itemId);
    } else {

        return '';
    }
    return $data['title'];
}


/**
 * @param $itemId 项目id
 * @param $type  类型
 * @return detail
 */

function get_follow_detail($itemId, $type)
{
    if ($type == 1) {
        $data = M('Rescue')->find($itemId);
    }
    if ($type == 2) {
        $data = M('Dream')->find($itemId);
    }
    return $data;
}


/**
 *  获得推荐的标签
 * @param $itemId 项目id
 * @return string
 */

function get_recomend_tag($tagId)
{
    $data = M('Tag')->find($tagId);
    if (!$tagId) {
        return '';
    }
    return $data['name'];
}

/**
 *
 * @param $code 编号
 * @return city
 */

function get_city($code)
{
    $data = M('Cities')->where(array('cityid' => $code))->find();
    return $data['city'];
}


/**
 *
 * @param $code 编号
 * @return province
 */

function get_province($code)
{
    $data = M('Provinces')->where(array('provinceid' => $code))->find();
    return $data['province'];
}

/**
 * 获取组织机构
 * @param 组织机构代号
 * @return string
 */

function get_committee($id)
{
    $data = M('Committee')->where(array('id' => $id))->find();
    return $data['name'];
}

/**
 * 获取组织机构
 * @param 组织机构代号
 * @return string
 */

function get_organization($id)
{
    $data = M('Organization')->where(array('id' => $id))->find();
    return $data['name'];
}

/**
 *我要使用-  获得名称
 *
 */
function get_item_title($itemId, $type)
{
    if ($type == 1) {
        $data = M('Rescue')->find($itemId);
    }
    if ($type == 2) {
        $data = M('Dream')->find($itemId);
    }
    if ($type == 3) {
        $data = M('Gongyi')->find($itemId);
    }

    return $data['title'];
}

/**
 *
 * @param $itemId 项目id
 * @param $type  类型
 * @return detail
 */

function get_dream_type($typeId)
{
    $data = M('DreamType')->find($typeId);
    return $data['name'];
}

//=============================================================================================
//文件上传
function uploadFile($fileInfo, $path = './public/static/images/', $flag = true, $allowExt = array('jpeg', 'jpg', 'png', 'gif', 'mp3', 'wav', 'wma', ''), $maxSize = 524288000)
{
    //判断错误号
    if ($fileInfo['error'] == 0) {
        //检测上传文件的大小  
        if ($fileInfo['size'] > $maxSize) {
            $res['mes'] = $fileInfo['name'] . '上传文件过大';
        }
        $ext = strtolower(pathinfo($fileInfo['name'], PATHINFO_EXTENSION));
        //检测上传文件的文件类型  
        if (!in_array($ext, $allowExt)) {
            $res['mes'] = $fileInfo['name'] . '非法文件类型';
        }
        //检测是否是真实的图片类型  
        if ($flag) {
            if (!getimagesize($fileInfo['tmp_name'])) {
                $res['mes'] = $fileInfo['name'] . '不是真实图片类型';
            }
        }
        // 检测文件是否是通过HTTP POST上传上来的  
        if (!is_uploaded_file($fileInfo['tmp_name'])) {
            $res['mes'] = $fileInfo['name'] . '文件不是通过HTTP POST方式上传上来的';
        }
        if ($res) return $res; //如果要不显示错误信息的话，用if( @$res ) return $res;

        //$path='./uploads';  
        //如果没有这个文件夹，那么就创建一  
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
            chmod($path, 0777);
        }

        //新文件名唯一  
        $uniName = md5(uniqid(microtime(true), true));
        $destination = $path . '/' . $uniName . '.' . $ext;

        //@符号是为了不让客户看到错误信，也可以删除 
        if (!@move_uploaded_file($fileInfo['tmp_name'], $destination)) {
            $res['mes'] = $fileInfo['name'] . '文件移动失败';
        }
        $res['mes'] = $fileInfo['name'] . '上传成功';
        $res['status'] = 1;
        $res['dest'] = $destination;
        return $res;
    } else {
        //匹配错误信息  
        //注意！错误信息没有5  
        switch ($fileInfo['error']) {
            case 1:
                $res['mes'] = '上传文件超过了PHP配置文件中upload_max_filesize选项的值';
                break;
            case 2:
                $res['mes'] = '超过了HTML表单MAX_FILE_SIZE限制的大小';
                break;
            case 3:
                $res['mes'] = '文件部分被上传';
                break;
            case 4:
                $res['mes'] = '没有选择上传文件';
                break;
            case 6:
                $res['mes'] = '没有找到临时目录';
                break;
            case 7:
                $res['mes'] = '文件写入失败';
                break;
            case 8:
                $res['mes'] = '上传的文件被PHP扩展程序中断';
                break;

        }
        $res['status'] = -1;
        return $res;
    }


}


