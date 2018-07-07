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

    
            <div class='head'>
                <a href="{:U('Index/index')}"><img src="/public/statics/img/head2.png" alt="" /></a>
            </div>
            <div class='content'>
                <div class='box'>
                    <div class='title'>您关注公众号的日期为<span class='y'>{$time[0]}</span>年<span class='m'>{$time[1]}</span>月<span class='r'>{$time[2]}</span>日</div>
                    <div class='c'>
                        截止到参加活动时，您已经关注了<span id='year'>{$time1.nian}</span>年<span id='month'>{$time1.yue}</span>月<span id='day'>{$time1.ri}</span>日<span id='h'></span>时<span id='min'></span>分<span id='s'></span>秒
                    </div>
                    
                </div>
                <div class='center-box'>
                    
                    共有<span>{$res.people_num}</span>人在这天关注，占活动总人数的<span>{$res.percentage}%</span>
                </div>
                <div class='box' >
                    <div class='abs'>
                        <div><span class='m'>{$time[1]}</span>月</div>
                        <div><span class='r'>{$time[2]}</span>日</div>
                    </div>
                    <img src="/public/statics/img/zi.png" alt="" style='position: absolute;top:0;left:0;'>
                    <div class='c textcont'>                        
                        <?php if(is_array($event_list)): foreach($event_list as $key=>$vo): ?><div style='font-size: 16px;'>
                                {$vo.title}
                        </div>
                        <div>
                        {$vo.content}
                        </div><?php endforeach; endif; ?>                      
                    </div>
                    </div>
                </div>
                <?php if($type == 0): ?><a href="javascript:;" class='red-btn red-btn1'>立即分享</a>
                <?php else: ?>
                <a href="{:U('Index/index')}" class='red-btn'>立即参与</a><?php endif; ?>
                <style>
                        .red-btn{
                            display: block;
                            margin:10px auto;
                            width:120px;
                            background:#F93E3C;
                            color:#fff;
                            font-size:14px;
                            text-align: center;
                            line-height: 30px;
                            height:30px;
                            border-radius: 5px;
                        }
                        .fu{
                            position: fixed;
                            top:0;
                            left:0;
                            width:100%;
                            height:100%;
                            background:rgba(000,000,000,.6);
                            z-index: 10;
                            overflow: hidden;
                            display: none;

                        }
                        .f1{
                            position: absolute;
                            top:10px;
                            right:0;
                            width:320px;
                        }
                        .f2{
                            position: absolute;
                            bottom:40%;
                            left:50%;
                            width:180px;
                            margin-left:-90px;
                        }
                </style>
            </div>
            <img src="/public/statics/img/foot.png" alt="" class='foot' />
            <div class='fu' >
                    <img src="/public/statics/img/f1.png" alt="" class='f1'>
                    <img src="/public/statics/img/f2.png" alt="" class='f2'>
            </div>
    <body>
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

        
        
    $('.red-btn1').click(function(){
            $('.fu').show();
    });
    $('.fu').click(function(){
            $('.fu').hide();
    });
        // alert('{$share.link}');
        wx.config({
                debug: false,
                appId: '{$weixin2.appId}',
                timestamp: '{$weixin2.timestamp}',
                nonceStr: '{$weixin2.nonceStr}',
                signature: '{$weixin2.signature}',
                jsApiList: [
                  'onMenuShareTimeline','onMenuShareAppMessage','showOptionMenu'
                ]
              });
              
            wx.ready(function () {
              // 1 判断当前版本是否支持指定 JS 接口，支持批量判断
              
                wx.checkJsApi({
                    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'], // 需要检测的JS接口列表，所有JS接口列表见附录2,
                    success: function(res) {
                    // 以键值对的形式返回，可用的api值true，不可用为false
                    // alert(res)
                    // alert(res.errMsg);
                    // 如：{"checkResult":{"chooseImage":true},"errMsg":"checkJsApi:ok"}
                }});
                    
                wx.onMenuShareTimeline({
                    title: '{$share.title}', // 分享标题
                    // desc: '{$share.description}', // 分享描述
                    link: '{$share.link}', // 分享链接
                    imgUrl: '{$share.img}', // 分享图标
                    success: function () { 
                        // $(document).ready(function(){
                        // var type  = $('#canshu').attr('typea');
                        // var id = $('#canshu').val();
                        //  $.ajax({
                        //      type:'post',
                        //      data:{type:type,id:id},
                        //      url:'/Mobile/Activity/ajaxshare',
                        //      success:function(data){
                        //          if(data==1){
                        //              alert('分享成功');
                        //          }
                        //      }
                        //  });
                            
                        // });
                    },
                    cancel: function () { 
                        
                    }
                });
                
                wx.onMenuShareAppMessage({
                    title: '{$share.title}', // 分享标题
                    desc: '{$share.description}', // 分享描述
                    link: '{$share.link}', // 分享链接
                    imgUrl: '{$share.img}', // 分享图标
                    type: '', // 分享类型,music、video或link，不填默认为link
                    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                    success: function () { 
                        // var type  = $('#canshu').attr('typea');
                        // var id = $('#canshu').val();
                        //  $.ajax({
                        //      type:'post',
                        //      data:{type:type,id:id},
                        //      url:'/Mobile/Activity/ajaxshare',
                        //      success:function(data){
                        //          if(data==1){
                        //              alert('分享成功');
                        //          }
                        //      }
                        //  });
                        //window.location.href="/Stage/Index/share";
                        // alert(111111);
                    },
                    cancel: function () { 
                        // 用户取消分享后执行的回调函数
                    }
                });
                
                
            });
            // $('.erw img').click(function(e){
            //  e.stopPropagation();
            // })       
    

</script>
</html>