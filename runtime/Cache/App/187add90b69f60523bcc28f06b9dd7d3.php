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

    
    <div class="phone">
        <style>
            body{
                position: relative;
            }
            .prompt{
                position: absolute;
                left: 50%;
                top: 50%;
                transform:translate3d(-50%,-50%,0);
                background: #999;
                border-radius: 0.2rem;
                padding: 0.1rem 0.2rem;
                color: #fff;
                opacity: 0;
                z-index: 3;
            }
        </style>
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>绑定手机号</span>
                <a href="<?php echo U('phone',array('flag'=>1));?>"><span>更换</span></a>
            </p>
        </header>
        <main class="main">
            <p class='prompt'></p>
            <?php if($result['phone'] != '' ): ?><p class="showPhone"><span>绑定手机号</span><span><?php echo ($result["phone"]); ?></span></p><?php endif; ?>

         <?php if($result['phone'] == '' ): ?><form action="">
                <ul>
                    <li>
                        <i class="iconfont icon-shouji"></i>
                        <input type="text" id="phone" placeholder="填写您的手机号" name="phone">
                        <button class="generate_code">获取验证码</button>
                    </li>
                    <li>
                        <i class="iconfont icon-yanzhengma"></i>
                        <input type="text" id="code" placeholder="填写手机验证码" name="code">
                    </li>
                </ul>
                 <p class="submit" >
                    <span>提交认证</span>
                </p>
            </form><?php endif; ?>
        </main>
    

   
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
<script src="/public/home/scripts/vue.min.js"></script>
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

        
        // 
    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })
    // 手机号
    var reg = /^1[3|4|5|7|8][0-9]{9}$/,phone='',code='';
    $('input[name=phone]').keyup(function(){
        phone = $(this).val();
    })
    $('input[name=code]').keyup(function(){
        code = $(this).val();
        
    })
    $('.submit').click(function(){
        $phone = $('#phone').val();
        $code = $('#code').val();
        if($phone == ''){
        $('.prompt').text('请输入手机号').animate({'opacity':1},1000)
                    setInterval(function(){
                        $('.prompt').animate({'opacity':0},1000)                
                    },2000)
    }
     $.ajax({
            type:'POST',
            url :"<?php echo U('center/phone');?>",
            data:{
                'phone':$phone,
                'code':$code
            },
            success:function(msg){
            console.log(msg)
                if(msg == 1){
                 $('.prompt').text('修改成功').animate({'opacity':1},1000)

                 setInterval(function(){
                       window.location.href='/Center/phone'               
                    },2000)
                } else { // 验证码错误
                    $('.prompt').text('验证码错误').animate({'opacity':1},1000)
                    setInterval(function(){
                        $('.prompt').animate({'opacity':0},1000)                
                    },2000)
                }

        }
    })

        // 验证码正确
        
    })
    // 倒计时
    var countdown=60;  
    var _generate_code = $(".generate_code"); 
    function settime() {  
        if (countdown == 0) {  
            _generate_code.attr("disabled",false);  
            _generate_code.html("获取验证码");  
            countdown = 60;  
            return false;  
        } else {  
            $(".generate_code").attr("disabled", true);  
            _generate_code.html("重新发送(" + countdown + ")");  
            countdown--;  
        }  
        setTimeout(function() {  
            settime();
        },1000);
    }  
    _generate_code.click(function(event){


        if(phone == ''){
            $('.prompt').text('手机号不能为空').animate({'opacity':1},1000)
            setInterval(function(){
                $('.prompt').animate({'opacity':0},1000)                
            },2000)
            event.preventDefault();
        } else {
        //13121668464
            if(reg.test(phone)){
                $phone = $('#phone').val();
                $.ajax({
                            type:'POST',
                            url :"<?php echo U('center/get_verify');?>",
                            data:{
                                'phone':$phone
                            },
                            success:function(msg){
                                console.log(msg)

                        }
                    })

                settime()
            } else {
                $('.prompt').text('手机号码格式错误').animate({'opacity':1},1000)
                setInterval(function(){
                    $('.prompt').animate({'opacity':0},1000)                
                },2000)
                event.preventDefault();
            }
        }
        
    })  

</script>
</html>