<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/home/font/iconfont.css">
    <link rel="stylesheet" href="/public/home/css/style.css">
    <link rel="stylesheet" href="/public/home/css/mpicker.css">
    <link rel="stylesheet" href="/public/home/css/swiper.min.css">
    <script src="/public/home/scripts/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<style type="text/css">
    .postbird-box-content {
    width: 400px;
    max-width: 90%;
    min-height: 150px;
    background-color: #fff;
    border: solid 1px #dfdfdf;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    /* margin-top: -100px; */
    max-height:  200px;
    height: 213px;
}
.show_msg{
width:100%;
height:35px;
text-align:center;
position:fixed;
left: 0;
z-index: 999;
}
.show_span{
    display: inline-block;
    height: 35px;
    padding: 0 15px;
    line-height: 35px;
    background:rgba(0,0,0,0.8);
    border-radius: 50px;
    color: #fff;
    font-size: 1em;
}
</style>

    
    <style>
        .container{
            padding: 0.2rem;
        }
        textarea {
            width: 100%;
            margin-top: 0.15rem;
            border-bottom: 1px solid #ccc;
        }
        .icon-guanzhu1{
            color: #999;
        }
    </style>
    <div class="shim">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>实名认证</span>
            </p>
        </header>
        <main class="main">
            <ul>
                <li><span class="tex">目标金额</span><input type="text"></li>
                <li><span class="tex">筹款标题</span><input type="text"></li>
                <div class="container">
                    <p class="tex">求助内容</p>
                    <textarea rows="5"></textarea>
                </div>
                <li><span class="tex">身份证号</span><input type="text"></li>
                <li><span class="tex">联系电话</span><input type="text"></li>
                <li><span class="tex">电子邮箱</span><input type="text"></li>
                <li><span class="tex">银行卡号</span><input type="text"></li>
                <li><span class="tex">身份证号</span><input type="text"></li>
                <li><span class="tex">联系电话</span><input type="text"></li>
                <li><span class="tex">组织机构认证</span><input type="text"></li>
                <li><span class="tex">委员会人员职位</span><input type="text"></li>
            </ul> 
            <div class="top">
                <p>
                    <span>权威认证</span>
                    <span>Authority</span>
                </p>
            </div>
            <form action="">
                <ul>
                <li>
                    <span>名称</span>
                    <input type="text" placeholder="请输入名称">
                </li>
                <li>
                    <span>电话</span>
                    <input type="text" placeholder="请输入电话">
                </li>
                <li>
                    <span>职位</span>
                    <input type="text" placeholder="请输入职位">
                </li>
                <li>
                    <span>评价</span>
                    <div class="right">
                        <i class="iconfont icon-guanzhu1" score='1'></i>
                        <i class="iconfont icon-guanzhu1" score='2'></i>
                        <i class="iconfont icon-guanzhu1" score='3'></i>
                        <i class="iconfont icon-guanzhu1" score='4'></i>
                        <i class="iconfont icon-guanzhu1" score='5'></i>
                    </div>
                </li>
            </ul>
            </form>
        </main>
        <footer class="footer">
            <p>
                <a class="sub">提交</a>
            </p>
        </footer>
    </div>
</body>
</html>


   
</div>
</body>
<script src="/public/home/scripts/swiper.min.js"></script>
<script src="/public/home/scripts/rem.js"></script>
<script src="/public/home/scripts/jquery.min.js"></script>
<script src="/public/home/scripts/jquery-form.js"></script>

<script src="/public/home/scripts/json.js"></script>
<script src="/public/home/scripts/jsonExchange.js"></script>
<script src="/public/home/scripts/mPicker.min.js"></script>

<script src="/public/home/scripts/swiper.min.js"></script>
<script src="/public/home/js/jweixin-1.2.0.js"></script>

<script src="/public/home/scripts/json.js"></script>
<script src="/public/home/scripts/jsonExchange.js"></script>
<script src="/public/home/scripts/mPicker.min.js"></script>
<script type="text/javascript" src="/public/home/plu/selectDate.js"></script>
<link   rel="stylesheet" href="/public/home/css/mpicker.css">
<link   rel="stylesheet" href="/public/home/plu/lib/mobileSelect.css">
<script type="text/javascript" src="/public/home/plu/lib/mobileSelect.js"></script>

<!-- 提示框 -->
    <script src="/public/home/plugin/js/postbirdAlertBox.min.js"></script>
    <link rel="stylesheet" href="/public/home/plugin/css/postbirdAlertBox.css">
<script >
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


            $('.consult').click(function(){
        $('.dailog').show();
    })
    $('.know').click(function(){
        $('.dailog').hide();
    })

    //梦想清单
        $('.nav li').click(function(){
        $(this).addClass('blue').siblings().removeClass('blue')
    })

        //提示框
     function showAlert(content,url ='',title='提示',okBtn='确定') {
        PostbirdAlertBox.alert({
            'title': title,
            'content': content,
            'okBtn': okBtn,
            'contentColor': 'red',
            'onConfirm': function () {
                console.log("回调触发后隐藏提示框");
                if (url != '') {
                    window.location.href= url;
                }
                
            }
        });
    }

  

    //自动消失提示框
        function showMsg(text,position='center'){
            var show    =   $('.show_msg').length
            if(show>0){
                
            }else{
                var div     =    $('<div></div>');
                    div.addClass('show_msg');
                var span    =   $('<span></span>');
                    span.addClass('show_span');
                    span.appendTo(div);
                    span.text(text);
                $('body').append(div);
            }
            $(".show_span").text(text);
            if(position=='bottom'){
                $(".show_msg").css('bottom','5%');
            }else if(position=='center'){
                $(".show_msg").css('top','');
                $(".show_msg").css('bottom','50%');
            }else{
                $(".show_msg").css('bottom','95%');
            }
            $('.show_msg').hide();
            $('.show_msg').fadeIn(200);
            $('.show_msg').fadeOut(1000);
        }

        
        
    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })
    var score;
    $('.icon-guanzhu1').click(function(){
        score = $(this).attr('score');
        $(this).css('color','#fd9826')
        $(this).prevAll().css('color','#fd9826')
        $(this).nextAll().css('color','#999')
    })
    $('.sub').click(function(){
        console.log(score)
    })

</script>
</html>