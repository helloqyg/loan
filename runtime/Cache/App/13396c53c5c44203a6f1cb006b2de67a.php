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
        .success{
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        .header{
            justify-content: center;
            position: relative;
        }
        .icon-fanhui{
            color: #fff;
            position: absolute;
            left: 0.2rem;
            top: 50%;
            transform: translate3d(0,-50%,0);
            font-size: 0.3rem;
        }
        .top1{
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .img{
            width: 2.6rem;
            height: 2.6rem;
        }
        .cont{
            background: linear-gradient(-59deg, #fd9826, #ff7d26);            
            padding: 0.15rem;
            border-radius: 0.1rem;
            margin-top: 1rem;
            color: #fff;
        }
        .btnBox{
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        .btnBox a{
            width: 80%;
            margin: 0.15rem 0;
            border-radius: 0.1rem;
            border: 1px solid #999;
        }
        .btnBox li{
            padding: 0.1rem;
            text-align: center;
        }
    </style>
    <div class="success">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>支付成功</span>
            </p>
        </header>
        <main class="main">
            <div class="top1">
                <p class="cont">感谢您的热心支持！</p>
                <div class="img">
                    <img src="/public/home/img/h.png" alt="">
                </div>
            </div>
            <ul class="btnBox">
                <a href="" style=" background: linear-gradient(-59deg, #fd9826, #ff7d26);border: none;"><li style="color:#fff;">返回主页</li></a>
                <a href="
                  <?php if($data["type"] == 1): echo U('Index/loveRelife',array('id'=>$data['item_id'])); endif; ?>
                  <?php if($data["type"] == 2): echo U('Dream/detail',array('id'=>$data['item_id'])); endif; ?>
                  <?php if($data["type"] == 3): echo U('Favorable/detail',array('id'=>$data['item_id'])); endif; ?>
                  <?php if($data["type"] == 4): echo U('announce/index',array('id'=>$data['item_id'])); endif; ?>


                "><li>查看项目</li></a>
            </ul>
        </main>
        <footer class="footer"></footer>
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

        
        
    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })


    function aja(param){
         $.ajax({
                        type:'POST',
                        url :"<?php echo U('Order/get_item_info');?>",
                        data:{order_id:param[0]},  
                        success:function(msg){
                            alert(123)
                            if(msg.type==1){
                                 window.location.href="/Index/loveRelife/id/"+msg.item_id+".html";
                            }
                            if(msg.type==2){
                                 window.location.href="/Dream/detail/id/"+msg.item_id+".html";
                            }
                            if(msg.type==3){
                                 window.location.href="/Favorable/detail"+msg.item_id+".html";
                            }
                            if(msg.type==4){
                                 window.location.href="/announce/index.html";
                            }
                        
        
                    }
                })
    }

</script>
</html>