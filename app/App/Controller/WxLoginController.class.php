<?php
/**
 * 第三方登陆，微信登陆
 * @author       乔永刚 <helloqyg@163.com>
 * @version      0.1
 * @copyright    Copyright (c) 2018
 * @date         2018/05/14
 */

namespace App\Controller;
class WxLoginController extends \Think\Controller
{

    private $_appId;
    private $_appSecret;
    private $_webRoot;
    private $_openUrlQrc;
    private $_openUrlToken;
    private $_openUrlUserInfo;

    public function __construct()
    {
        parent::__construct();
        // echo 11111;die;
        //修改成自己的
        $this->_appId = C('AppId');//开放平台网站应用
        $this->_appSecret = C('AppSecret');
        $this->_webRoot = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/WxLogin/wxCheck';
        //返回的域名网址，必须跟网站应用的域名网址相同
        $this->_openUrlQrc = 'https://open.weixin.qq.com/connect/oauth2/authorize';//申请二维码接口
        $this->_openUrlToken = 'https://api.weixin.qq.com/sns/oauth2/access_token';//申请token接口
        $this->_openUrlUserInfo = 'https://api.weixin.qq.com/sns/userinfo';//申请用户信息接口
        // $this->register = (is_ssl()?'https://':'http://').$_SERVER['HTTP_HOST'].'/index.php/Index/register';//自定义使用
    }

    /**
     * 提交微信登录请求
     */
    public function wxLogin($register_url = '')
    {
        $stats = $this->getRandChar(16);//该参数可用于防止csrf攻击（跨站请求伪造攻击）
        session('wx_state', $stats);//把随机字符串写入session，验证时对比
        $url = $this->_openUrlQrc . '?appid=' . $this->_appId . '&redirect_uri=' . urlencode($this->_webRoot) . '&response_type=code&scope=snsapi_userinfo&state=' . $stats;
        // dump($url);die;
        redirect($url);//跳转到微信登陆
    }

    /**
     * 验证用户数据
     */
    public function wxCheck()
    {
        $code = I('code');//只能使用1次即销毁
        $state = I('state');
        if ($state != $_SESSION['wx_state']) {
            $login_url = 'http://' . $_SERVER['HTTP_HOST'] . '/index.php/WxLogin/wxLogin';
            redirect($login_url);
        }
        session('wx_state', null);//清除这个session

        //获取access_token和openid信息，还有用户唯一标识unionid
        $ken = $this->wxToken($code);//:access_token,expires_in,refresh_token,openid,scope,unionid
        // dump($ken);die;
        if ($ken['errcode'] == 40029) {
            $this->error("code参数已经过期");
        }

        //判断是否已存在
        $map['openid'] = $ken['openid'];
        $Member = M('Member');//这个自己写一下查询数据库
        $res = $Member->where($map)->select();//查询openid是否存在，而PC和微信端 openid不一致，只有unionid才是唯一标识
        // dump($res);die;
        if ($res) {
            session('username', '已经注册');
            // cookie('wxuser_id',$res[0]['id']);
            session('user_id', $res[0]['id']);
        } else {
            $user = $this->wxUserInfo($ken['access_token'], $ken['openid']);//获取用户信息
            $data = array(
                'openid' => $user['openid'],
                'username' => $user['nickname'],
                // 'nickname' => $user['nickname'],
                'photo' => $user['headimgurl'],
                'cu_id' => rand(1000000000, 9999999999),
                'love_value' => 0,
                //'city'=>$user['city'],
                //'province'=>$user['province'],
                'password' => '微信用户' . $this->getRandChar(8),
                'last_login' => time()

            );
            $memberId = $Member->add($data);//写入到数据库中,返回的是插入id
            // cookie('wxuser_id', $memberId,3600);
            session('user_id', $memberId);
        }
        $register_url = session('register_url');
        // dump($register_url);die;
        if (isset($register_url) && !empty($register_url)) {
            redirect(($_SERVER['REMOTE_PORT'] == 80 ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . "/index.php/Index/register1");
        } else {
            redirect(($_SERVER['REMOTE_PORT'] == 80 ? 'http://' : 'http://') . $_SERVER['HTTP_HOST'] . "/Index/index");
        }

    }

    //生成随机数,length长度
    function getRandChar($length)
    {
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;
        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        return $str;
    }

    //CURL获取url返回值
    function httpGet($url)
    {
        $oCurl = curl_init();//实例化
        if (stripos($url, "https://") !== FALSE) {
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($oCurl, CURLOPT_SSL_VERIFYHOST, FALSE);
        }
        curl_setopt($oCurl, CURLOPT_URL, $url);
        curl_setopt($oCurl, CURLOPT_RETURNTRANSFER, 1);//是否返回值，1时给字符串，0输出到屏幕
        $sContent = curl_exec($oCurl);//获得页面数据
        $aStatus = curl_getinfo($oCurl);//获取CURL连接数据的信息
        curl_close($oCurl);//关闭资源
        //获取成功
        $output_array = json_decode($sContent, true);//转换json格式
        if (intval($aStatus["http_code"]) == 200) {
            return $output_array;
        } else {
            return false;
        }
    }

    //获取token信息
    public function wxToken($code)
    {
        $url = $this->_openUrlToken . '?appid=' . $this->_appId . '&secret=' . $this->_appSecret . '&code=' . $code . '&grant_type=authorization_code';
        $sContent = $this->httpGet($url);//
        return $sContent;
    }

    //延长token时间,默认token两个小时
    public function wxrefresh($refresh)
    {

        $url = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=' . $this->_appId . '&grant_type=refresh_token&refresh_token=' . $refresh;
        return $this->httpGet($url);
    }

    //检验token授权是否有效
    public function wxchecktoken($token, $openid)
    {
        $url = 'https://api.weixin.qq.com/sns/auth?access_token=' . $token . '&openid=' . $openid;
        return $this->httpGet($url);
    }


    //获取微信用户个人信息，但公众号和开放平台opendid 会不一样，unionid是用户唯一标识
    public function wxUserInfo($token, $openid)
    {
        $url = $this->_openUrlUserInfo . '?access_token=' . $token . '&lang=zh-CN&openid=' . $openid;
        return $this->httpGet($url);
    }

    //下载微信头像到本地服务器
    function create_photo($url = '', $filename = '', $save_dir = './Public/statics/img', $type = 0)
    {
        $ext = ".jpg";//以jpg的格式结尾
        clearstatcache();//清除文件缓存
        if (trim($url) == '') {
            return array('file_name' => '', 'save_path' => '', 'error' => 1);
        }
        if (trim($save_dir) == '') {
            $save_dir = './Public/statics/img';
        }
        if (trim($filename) == '') {//保存文件名
            $filename = microtime(true) . $ext;
        } else {
            $filename = $filename . $ext;
        }
        if (0 !== strrpos($save_dir, '/')) {
            $save_dir .= '/';
        }
        //创建保存目录
        if (!is_dir($save_dir)) {//文件夹不存在，则新建
            //print_r($save_dir."文件不存在");
            mkdir(iconv("UTF-8", "GBK", $save_dir), 0777, true);
            //mkdir($save_dir,0777,true);
        }
        //获取远程文件所采用的方法
        if ($type) {
            $ch = curl_init();
            $timeout = 3;
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $img = curl_exec($ch);
            curl_close($ch);
        } else {
            ob_start();
            readfile($url);
            $img = ob_get_contents();
            ob_end_clean();
        }
        $size = strlen($img);
        $fp2 = @fopen($save_dir . $filename, 'w');
        fwrite($fp2, $img);
        fclose($fp2);
        unset($img, $url);
        return array('file_name' => $filename, 'save_path' => $save_dir . $filename, 'error' => 0);
    }

}

// public function test()
// {
//     $WxLogin = new WxLoginController();
//     $WxLogin->wxLogin();
// }