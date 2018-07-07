<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta name="apple-mobile-web-app-capable" content="yes">  
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/home/font/iconfont.css">
    <link rel="stylesheet" href="/public/home/css/style.css">
    <link rel="stylesheet" href="/public/home/css/swiper.min.css">
    <title>Document</title>
</head>
<body>


    
    <div class="personalCenter">
        <header class="header">
            <span>个人中心</span>
        </header>
        <main class="main">
            <div class="unifo">
                <div class="cover"></div>
                <div class="mark">
                    <div class="new">
                        <div class="left">
                            <img style="border-radius:50%" src="<?php echo ($userInfo["photo"]); ?>" alt="">
                        </div>
                        <div class="right">
                            <p>
                                <span>昵称：<?php echo ($userInfo["username"]); ?></span>
                                <span><?php echo ($userInfo["phone"]); ?>（ID：<?php echo ($userInfo["cu_id"]); ?>）</span>
                                <span class="tet">签名：<?php echo ($userInfo["sign"]); ?></span>
                                <!-- <span>邮箱：<?php echo ($userInfo["email"]); ?></span> -->
                            </p>
                            <a href="set.html"><i class="iconfont icon-xiangyoujiantou"></i></a>
                        </div>
                    </div>
                    <ul class="data">
                        <li>
                            <span><?php echo ((isset($userInfo["love_value"]) && ($userInfo["love_value"] !== ""))?($userInfo["love_value"]):'0'); ?></span>
                            <span>爱心值</span>
                        </li>
                      <a href="<?php echo U('follow');?>">  <li>
                            <span><?php echo get_follow_member($userInfo['id']);?></span>
                         <span>关注的</span>
                        </li></a>
                      <a href="/Center/faqi/id/3.html">  <li>
                            <i class="iconfont icon-service"></i>
                            <span>筹款中</span>
                        </li> </a>
                    </ul>
                </div>
            </div>
            <ul class="item">
                <a href="myLove.html">
                    <li>
                        <p>
                            <i class="iconfont icon-xin ico-left"></i>我的爱心喇叭
                        </p>
                        <p>
                            <?php echo get_announce_count();?>
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="helped.html">
                    <li>
                        <p>
                            <i class="iconfont icon-8 ico-left"></i>我帮助的
                        </p>
                        <p>
                            <?php echo get_donor_cont();?>
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="<?php echo U('faqi',array('id'=>1));?>">
                    <li>
                        <p>
                            <i class="iconfont icon-faqi ico-left"></i>我发起的
                        </p>
                        <p>
                            <?php echo get_launch_cnt();?>
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="use_money.html">
                    <li>
                        <p>
                            <i class="iconfont icon-shiyongshouce ico-left"></i>我要使用
                        </p>
                        <p>
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="warrant.html">
                    <li>
                        <p>
                            <i class="iconfont icon-zhangqidanbao ico-left"></i>我的担保人
                        </p>
                        <p>                        
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="wallet.html">
                    <li>
                        <p>
                            <i class="iconfont icon-qianbao ico-left"></i>我的钱包
                        </p>
                        <p>
                            0.00
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="<?php echo U('mutual/index');?>">
                    <li>
                        <p>
                            <i class="iconfont icon-xiangmu ico-left"></i>轻松互助
                        </p>
                        <p>
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
                <a href="introduce.html">
                    <li>
                        <p>
                            <i class="iconfont icon-bangzhu ico-left"></i>帮助中心
                        </p>
                        <p>
                            平台介绍
                            <i class="iconfont icon-xiangyoujiantou ico-right"></i>
                        </p>
                    </li>
                </a>
            </ul>
        </main>
       

    <footer class="footer">
        <ul>
            <a href="<?php echo U('index/index');?>">
                <li >
                    <i class="iconfont icon-shouye"></i>
                    <span>首页</span>
                </li>
            </a>
            <a href="<?php echo U('announce/index');?>">
                <li>
                    <i class="iconfont icon-aixin"></i>
                    <span>爱心宣扬</span>
                </li>
            </a>
            <a href="<?php echo U('release/index');?>">
                <li>
                    <i class="iconfont icon-tianjia1"></i>
                    <span>我要发起</span>
                </li>
            </a>
            <a href="<?php echo U('center/index');?>">
                <li>
                    <i class="iconfont icon-geren"></i>
                    <span>个人中心</span>
                </li>
            </a>
        </ul>
    </footer>
</div>
</body>
<script src="/public/home/scripts/swiper.min.js"></script>
<script src="/public/home/js/jweixin-1.2.0.js"></script>
<script src="/public/home/scripts/rem.js"></script>
<script src="/public/home/scripts/jquery.min.js"></script>
<script src="/public/home/scripts/jquery-form.js"></script>
<script >
    var url = location.href;

    if (url.indexOf('/index/index') >= 1) {
        $('.icon-shouye').parent().addClass('on');
    }
    if (url.indexOf('announce/index') >= 1) {
        $('.icon-aixin').parent().addClass('on');
    }
    if (url.indexOf('release/index') >= 1) {
        $('.icon-tianjia1').parent().addClass('on');
    }
    if (url.indexOf('center/index') >= 1) {
        $('.icon-geren').parent().addClass('on');
    }

     $('.icon-fanhui').click(function(){window.history.go(-1)})
    var mySwiper = new Swiper ('.seconed', {
        loop: true,
        autoplay: {
            delay: 3500,//1秒切换一次
        },
        effect : 'coverflow',
        slidesPerView: 2,
        centeredSlides: true,
        coverflowEffect: {
            rotate: 30,
            stretch: 10,
            depth: 60,
            modifier: 2,
            slideShadows : true
        },
    })
    var mySwiper = new Swiper ('.back', {
        loop: true,
        autoplay: {
            delay: 5000,//1秒切换一次
        }
    })
        
</script>
</html>