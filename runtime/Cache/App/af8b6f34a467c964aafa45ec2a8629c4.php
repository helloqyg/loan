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

    
    <div class="true">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>确认发送爱心</span>
            </p>
        </header>
        <main class="main">
            <div class="banner">
                <div class="absoult">
                    <p>帮助金额：<?php echo ($_GET['item_count']*$_GET['single_price']); ?>元</p>
                    <p>帮助区域：<?php echo ($address); ?></p>
                    <p>项目个数：<?php echo ($_GET['item_count']); ?>个</p>
                    <p>单个金额：<?php echo ($_GET['single_price']); ?>元</p>
                    <span>祝福语：<?php echo ($_GET['content']); ?></span>
                </div>
            </div>
            <form action="" method="post">

            <input type="hidden" name="item_count" value="<?php echo ($_GET['item_count']); ?>">
            <input type="hidden" name="single_price" value="<?php echo ($_GET['single_price']); ?>">
            <input type="hidden" name="content" value="<?php echo ($_GET['content']); ?>">
            <input type="hidden" name="province_love" value="<?php echo ($_GET['province']); ?>">
            <input type="hidden" name="city_love" value="<?php echo ($_GET['city']); ?>">
            <div class="top">
                <p>
                    <span>已匹配需要帮助的项目</span>
                    <span>Matching needs hekp projects</span>
                </p>
            </div>

                <?php if(is_array($selectItem)): $i = 0; $__LIST__ = $selectItem;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?><div class="container">
                    <div class="left">
                        <img src="<?php echo get_user_img($vv['user_id']);?>" alt="">
                    </div>
                    <div class="right">
                        <ul class="center">
                            <li class="text"><?php echo ($vv["title"]); ?></li>
                            <li>
                                <span><?php echo get_money_member($vv['id'],1);?>人帮助</span>
                                <!-- <span>74人认证</span> -->
                                <span><?php echo get_money_ratio($vv['id'],1);?>%进度</span>
                            </li>
                        </ul>
                        <span class="ri">已审核</span>
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

            <div class="top">
                <p>
                    <span>支付方式</span>
                    <span>Payment menthod</span>
                </p>
            </div>
            <div class="type">
                <p>
                    <input type="radio" value="weixin" checked="checked" name="">
                    <i class="iconfont icon-weixinzhifu"></i>
                    <span>微信支付</span>
                </p>
              <!--   <p>
                    <input type="radio" value="qita" name="type">
                    <i class="iconfont icon-qitafeiyong"></i>
                    <span>其他支付</span>
                </p> -->
            </div>
        </main>
        <footer class="footer">
            <p >
                 <input  class="submit" type="button" value="确认帮助">
            </p>

            </form>
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

        
        
      $('.icon-fanhui').click(function(){window.location.href='/Announce/toHelp.html'})
    //匹配的项目个数
    var select_item = <?php echo ($selectItemCount); ?>;
    if(select_item < 5){
        $(".submit").attr("disabled", true); 
        showAlert('当前区域项目不足5个，请选择其它区域！','/Announce/toHelp');
    }
    console.log(select_item)



//提交表单 调起支付
//=====================
var flag = 0;
    $('.submit').click(function(){
  
           var ptrr = /^[1-9]+\d*$/
            var string = $('input[name=price]').val();
             var data =  ptrr.test(string)
          
            var total_price = $('input[name=single_price]').val()*$('input[name=item_count]').val()
            var content = $('textarea[name=content]').val()
            $.ajax({
                type:'POST',
                url :"<?php echo U('Order/create_order');?>",
                data:$.param({'total_price':1,'type':4})+'&'+$('form').serialize(),  
                success:function(msg){
                    if(msg){
                    window.location.href="/Order/request_pay/order_id/"+msg
                }
              

            }
        })
        })


    
</script>
</html>