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

    
    <div class="helpIt">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>帮助TA</span>
            </p>
        </header>
        <form action="" method="post" >
        <main class="main">
            <div class="top">
                <ul>
                    <li><span class="tex">帮助金额</span><input type="number" name="price" placeholder="输入帮助金额"></li>
                </ul>
                <p class="tex">对TA说一句鼓励的话吧</p>
                <textarea name="content" id="" rows="5"  placeholder="我想对你说……"></textarea>
                <p class="check">
                    <label for="">
                        <input type="checkbox" name="is_anonymous" value="1">匿名帮助
                    </label>
                </p>
                <input type="hidden" name="item_id" value="<?php echo ($_GET["id"]); ?>">
            </div>
            <div class="bottom">
                <span>0.00元</span>
                <p>帮助金额会以电子发票的形式发送到帮助人的邮箱</p>
            </div>
        </main>
        <!--底部导航-->
        <footer class="footer">
            <p><input type="button" class="submit"  value="确认付款"></p>
        </footer>
        </form>
    </div>
</body>


   
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

        
        

    $('.icon-fanhui').click(function(){window.location.href='/Index/loveRelife/id/<?php echo ($_GET["id"]); ?>.html'})

        var flag = 0;
   function checkLength(){

 //判断表单数据是否为空
  var t = $('form').serializeArray();
    $.each(t,function(i,item){
        if(item['value'] == '') {
            console.log('信息不可为空') 
            showMsg('信息不可为空')
            flag = 1;
            return false
        } else {
        flag = 0;
    }
    })

      if(flag == 0){
        var ptrr = /^[1-9]+\d*$/
        var string = $('input[name=price]').val();
         var data =  ptrr.test(string)
        if(!data){
            showMsg('请输入合法的金额')
            return false
        }
        showMsg('添加成功')
        return true;
    
        //------支付接口结束
    }else{
        return false
}
}

//=====================
var flag = 0;
    $('.submit').click(function(){
    //判断表单数据是否为空
      var t = $('form').serializeArray();
        $.each(t,function(i,item){
            if(item['name'] != 'id'){

                if(item['value'] == '') {
                    console.log(item['name']+'信息不可为空') 
                    showMsg('信息不可为空')
                    flag = 1;
                    return false
                    } else {
                    flag = 0;
                }
            }
        })
         if(flag == 0){
           var ptrr = /^[1-9]+\d*$/
            var string = $('input[name=price]').val();
            var content = $('textarea[name=content]').val()
             var data =  ptrr.test(string)
            if(!data){
                showMsg('请输入合法的金额')
                return false
            }
            var total_price = $('input[name=price]').val()
            var is_anonymous = $('input[name=is_anonymous]:checked').val()
            $.ajax({
                type:'POST',
                url :"<?php echo U('Order/create_order');?>",
                data:{'total_price':total_price,'type':1,content:content,is_anonymous:is_anonymous,'item_id':<?php echo ($_GET["id"]); ?>},
                success:function(msg){
                    if(msg){
                    window.location.href="/Order/request_pay/order_id/"+msg
                }
              

            }
        })
    }
        })


        //未用

                function request_pay(order_id){
                    $.ajax({
                            type:'POST',
                            url :"<?php echo U('Order/request_pay');?>",
                            data:{'order_id':order_id },
                            success:function(msg){

                                if(msg){
                               // order_id = msg;
                            }
                          

                        }
                    })
                }


</script>
</html>