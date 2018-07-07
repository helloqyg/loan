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

    
    <div class="use">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>我要使用</span>
            </p>
        </header>
        <main class="main">
            <div class="top">
                <p>
                    <span>使用前</span>
                    <span>Before use</span>
                </p>
            </div>
            <div class="text">
                <p>一、资金使用人要向平台提出书面申请</p>
                <p>二、资金使用人要提供费用使用明细单子</p>
            </div>
           <ul class="imgBox" id="1">
                 <?php if(is_array($imgArray)): $i = 0; $__LIST__ = $imgArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="img">
                        <img src="<?php echo ($v["url"]); ?>" alt="">
                        <i class="iconfont icon-delete2" onclick="remove(this)"></i>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="up">
                    <span><i class="iconfont icon-plus-bold"></i></span>
                        <input  type="file" name="img" class="file">
                </li>
            </ul>
            <div class="top">
                <p>
                    <span>使用后</span>
                    <span>After use</span>
                </p>
            </div>
            <div class="text">
                <p>三、资金使用要确定使用单位收款依据单子</p>
            </div>
           <ul class="imgBox" id="1">
                 <?php if(is_array($imgArray)): $i = 0; $__LIST__ = $imgArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="img">
                        <img src="<?php echo ($v["url"]); ?>" alt="">
                        <i class="iconfont icon-delete2" onclick="remove(this)"></i>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="up">
                    <span><i class="iconfont icon-plus-bold"></i></span>
                        <input  type="file" name="img" class="file">
                </li>
            </ul>
        </main>
        <!--底部导航-->
        <footer class="footer"></footer>
    </div>
</body>
<script src="scripts/rem.js"></script>
<script src="scripts/jquery.min.js"></script>
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

        
        
      $('.top li').click(function(){
        $(this).addClass('h').siblings().removeClass('h')
    })

  $('.top li').click(function(){
        $(this).addClass('h').siblings().removeClass('h')
    })
    $('.up').click(function(event){
        event = event || window.event;
        var target = event.target || event.srcElement;
        console.log(target.nodeType)
        if(target.nodeType == 1){}
    })

</script>
</html>