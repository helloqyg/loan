<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" type="text/css" href="/public/home/css/css.css">
  <script type="text/javascript" src="/public/home/js/jquery.js"></script>
  <script type="text/javascript" src="/public/home/js/banner.js"></script>
  <link type="text/css" href="/public/css/zw_css.css"  rel="stylesheet" />

  <script src="/public/js/sea.min.js"></script>
  
</head>
<body>
<div class="top_bg">


  <div class="top">
    <div class="top_left">欢迎光临2018中国国际电梯展览会官方预订平台！</div>
    <div class="top_right fr">
          <div class="fl">客服热线: <b>0316-6078901</b></div>
          <div class="top_img fl">  <a href="" class="click-qq"><img width="24" src="/public/home/images/qq.jpg"></a>&nbsp;&nbsp;<a href=""  class="click-wechat"><img  width="24"  src="/public/home/images/wechat.jpg"></a> </div>
          <div class="login fl">&nbsp;&nbsp;
            <?php echo check_user_login();?>
          </div>
        

      

    </div>
          
    <div class="clear"></div>
  </div>
  
</div>
<div class="hr"></div>
<div class="clear"></div>
<!-- 导航栏+logo -->
<div class="nav">
    <div class="logo_img fl"> <img src="/public/home/images/logo.png"></div>
    <div class="nav_sma fr">

      <ul class="nav_small_ul">
        <li class="select"><div> <a href="<?php echo U('/');?>"> 网站首页</a></div></li>
        <li><div> <a href="<?php echo U('/user/booth/index');?>"> 展位预订</a></div></li>
        <li><div> <a href=""> 广告预订</a></div></li>
        <li><div> <a href=""> 帮助中心</a></div></li>
        <li><div> <a href=""> 我的预订</a></div></li>
      </ul>
    </div>
</div>
  <div class="clear"></div>
  <!-- 导航栏结束 -->

<div class="main" style="padding-top:8px; min-height:450px;">
  <div class="pay_css">
  <div class="pay_succ"><span><img src="/public/images/notice.png" /></span><label><?php echo($error); ?></label></div>
  <div class="clear"></div>
  
  <div class="clear"></div>
  <div class="pay_menu"><span><b id="wait"><?php echo($waitSecond); ?></b>秒后页面将自动跳转  <a id="href" id="btn-now" href="<?php echo($jumpUrl); ?>">立即跳转</a></span></div>
    <div class="clear"></div>
  </div>
</div>
<!-- foot底部 -->
  <div class="foot">
    <div class="foot_top">
    <div class="fl">
      <table >
        <tr>
          <td><a href="">新手指导</a></td>
          <td><a href="">账号密码</a></td>
          <td style="width: 285px">联系人：马振涛</td>
        </tr>
        <tr>
          <td><a href="">操作手册</a></td>
          <td><a href="">资料下载</a></td>
          <td>邮编：065001</td>
        </tr>
        <tr>
          <td><a href="">预订流程</a></td>
          <td><a href="">联系我们</a></td>
          <td>地址：河北省廊坊市开发区翔云道98号</td>
        </tr>
      </table>
    </div>
    <div class="fr">
      <div class="bot_qq fl">
      <a href="">
          <div class="con_img_we"> <img src="/public/home/images/bottom_qq.jpg"> </div>
          <div class="con_detail_we">在线客服</div>
         </a>
        </div>
        <a href="">
        <div class="bot_sina fl">
          <div class="con_img_we"> <img  width="44" src="/public/home/images/bottom_wechat.png"> </div>
          <div class="con_detail_we">微信</div>
          </a>
        </div>


        <div class="con_wechat">
          <div class="con_img_we"> <img src="/public/home/images/service.jpg"> </div>
          <div class="con_detail_we">电梯展服务号</div>
        </div>
        <div class="con_wechat">
          <div class="con_img_we"> <img src="/public/home/images/subsribe.jpg"> </div>
          <div class="con_detail_we">电梯展订阅号</div>
        </div>

    </div>
    </div>
    <div class="foot_bot">
      Copyright 2007-2016 All Right Reserved 版权所有·中国国际电梯展览会组委会
    </div>
  </div>
  <!-- foot底部结束 -->

</body>
</html>
  <script type="text/javascript" src="/public/home/js/js.js"></script>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
  var time = --wait.innerHTML;
  if(time <= 0) {
    location.href = href;
     // location.href = '/user/account/company';
    clearInterval(interval);
  };
}, 1000);
})();
</script>
</html>