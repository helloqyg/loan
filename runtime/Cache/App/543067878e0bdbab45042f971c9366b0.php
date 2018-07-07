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

    
    <div class="which">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>您想和哪些明星一起做活动</span>
            </p>
        </header>
        <main class="main">
            <!--轮播图-->
            <div class="loop swiper-container">
                <ul class="swiper-wrapper">
                    <li class="swiper-slide">
                        <img src="/public/home/img/banner-1@2x.png" alt="">
                    </li>
                    <li class="swiper-slide">
                        <img src="/public/home/img/banner-2@2x.png" alt="">
                    </li>
                    <li class="swiper-slide">
                        <img src="/public/home/img/banner-3@2x.png" alt="">
                    </li>
                </ul>
            </div>
            <!--进度条-->
            <div style="background: #fff;">
                <div class="jin_top">                
                    <div>
                        <label for=""><input type="radio" name="radio1" value="radio单选项1"/> 捐赠</label>
                        <div class="jin">
                            <span style="width: 10%;"></span>
                            <i class="iconfont icon-woniu" style="left:10%;"></i>
                        </div>
                    </div>
                    <p class="times"><span>已连续捐赠21天</span></p>                    
                    <div class="dailog">
                        <p>你想和哪些明星一起做活动？快去<span style="color:#ff7d26;">@</span>他（她）吧或者输入他（她）的名字</p>
                        <input type="text">
                    </div>                   
                </div>
                <div class="jin_bottom">
                    <div>
                        <label for=""><input type="radio" name="radio1" value="radio单选项1"/> 转发</label>
                        <p class="jin">
                            <span style="width: 40%;"></span>
                            <i class="iconfont icon-woniu" style="left:40%;"></i>
                        </p>
                    </div>
                    <p class="times"><span>已连续转发21天</span></p>
                    <div class="dailog">
                        <p>你想和哪些明星一起做活动？快去<span style="color:#ff7d26;">@</span>他（她）吧或者输入他（她）的名字</p>
                        <input type="text">
                    </div>                     
                </div>
            </div>
            <!--活动介绍-->
            <div class="activities">
                <div class="top">
                    <p>
                        <span>活动介绍</span>
                        <span>Activities</span>
                    </p>
                </div>
                <p class="text">
                    选择自己支持的明星签到选择自己支持的明星签到选择自己支持的明星签到，选择自己支持的明星签到选择自己支持的明星签到
                </p>
            </div>
            <!--明星排名-->
            <div class="starRanking">
                <div class="top">
                    <p>
                        <span>明星排名</span>
                        <span>Star ranking</span>
                    </p>
                    <div class="search">
                        <i class="iconfont icon-sousuo"></i>
                        <input type="text" placeholder="请搜索你想要支持的明星">
                    </div>
                </div>

                <?php if(is_array($star)): $k = 0; $__LIST__ = $star;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($k % 2 );++$k;?><div class="star">
                    <span><?php echo ($k); ?>.</span>
                    <div class="starRight">
                        <div class="rightLeft">
                            <div class="img">
                                <img src="img/7.png" alt="">
                            </div>
                            <p><span><?php echo ($v["name"]); ?></span><span><?php echo ($v["en_name"]); ?></span></p>
                        </div>
                        <span>
                            <i class="iconfont icon-xin" style="display:none;"></i>
                            <i class="iconfont icon-heart"></i>
                            <span>963258</span>
                        </span>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>



                <p class="tit">选出自己支持的明星签到，坚持每天签到，年底会选出代表参加晚会</p>
            </div>
        </main>
        <footer class="footer">
            <p>
                <a href="myRank.html">我要排名</a>
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

        
            
    var mySwiper = new Swiper ('.loop', {
        loop : true,
        autoplay:true
    })
    $('.dailog').hide()
    $('input[type=radio]').each(function(index, ele){
        $(ele).click(function(){
            $('.dailog').each(function(ind,val){
                if(index == ind){
                    $(val).show()
                } else {
                    $(val).hide()
                }
            })
        })
    })
    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })
    $('.icon-heart').click(function(){
        var num = $(this).parent().find('span').text()*1;
        $(this).hide().parent().find('span').text(num+1).parent().find('.icon-xin').show();
    })
    $('.icon-xin').click(function(){
        var num = $(this).parent().find('span').text()*1;
        $(this).hide().parent().find('span').text(num-1).parent().find('.icon-heart').show();
    })

</script>
</html>