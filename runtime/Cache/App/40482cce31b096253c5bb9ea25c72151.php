<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/home/font/iconfont.css">
    <link rel="stylesheet" href="/public/home/css/style.css">
    <link rel="stylesheet" href="/public/home/css/swiper.min.css">
    <title>Document</title>
</head>
<body>


    

    <div class="publish">
        <header class="header">
            <span>发起救助</span>
        </header>
        <main class="main">
            <div class="banner">
                <img src="/public/home/img/banner_02.gif" alt="">
            </div>
            <p class="step">轻松五步，快速筹款</p>
            <div class="cont">
                <p>
                    <i class="iconfont icon-faqi"></i>第一步：实名认证（目前未限制）
                </p>
                <span>3分钟完成填写，极致简单，发起成功后获1对1辅导资格</span>
            </div>
            <div class="cont">
                <p>
                    <i class="iconfont icon-pengyouquan"></i>第二步：发起筹款 
                </p>
                <span>3分钟完成填写，极致简单，发起成功后获1对1辅导资格</span>
            </div>
            <div class="cont">
                <p>
                    <i class="iconfont icon-qunfengzijintixian"></i>第三步：分享给权威人士证实信息真实性
                </p>
                <span>全程为您免费服务，100%资金安全</span>
            </div>
            <div class="cont">
                <p>
                    <i class="iconfont icon-qunfenggerenziliao"></i>第四步：后台审核，成功后开始筹款
                </p>
                <span>参与筹款的好友将获得健康服务2亿爱心人士共同帮助你</span>
            </div>
            <div class="cont">
                <p>
                    <i class="iconfont icon-chakan"></i>第五步：项目结束，提交使用资金单据，拿到款项。
                </p>
                <span>此栏目个人不可填写，需要转发给权威人士填写</span>
            </div>
            <p class="text">如有任何疑问，请联系客服010-8546794</p>
            <p class="btn">
                <span><a href="<?php echo U('release/choukuan');?> ">发起筹款</a></span>
            </p>
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