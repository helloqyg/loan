<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <meta name="apple-mobile-web-app-capable" content="yes">  
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width">
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

    
    <div class="set">
            <style> body{position: relative; } .prompt{position: absolute; left: 50%; top: 50%; transform:translate3d(-50%,-50%,0); background: #999; border-radius: 0.2rem; padding: 0.1rem 0.2rem; color: #fff; opacity: 0; z-index: 3; } </style>
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>个人信息设置</span>
            </p>
        </header>
        <main class="main">
            <ul>
                <li>
                    <span>头像</span>
                    <p><img src="<?php echo ($result["photo"]); ?>" alt=""><i class="iconfont icon-xiangyoujiantou"></i></p>
                </li>
                <li>
                    <span>账号昵称</span>
                    <p class="tan" attr='username'><span><?php echo ($result["username"]); ?></span><i class="iconfont icon-xiangyoujiantou"></i></p>
                </li>
                <li style="margin-bottom:0.15rem;border:none;">
                    <span>个性签名</span>
                    <p class="tan" attr='sign'><span><?php echo ($result["sign"]); ?></span><i class="iconfont icon-xiangyoujiantou"></i></p>
                </li>
                <a href="phone.html">
                    <li>
                        <span>绑定手机号</span>
                        <p><span><?php echo ($result["phone"]); ?></span><i class="iconfont icon-xiangyoujiantou"></i></p>
                    </li>
                </a>
                <li style="margin-bottom:0.15rem;border:none;">
                    <span>我的家乡</span>
                    <p><input type="text" class="select-value1 form-control" value="<?php echo get_province($result['home_province']);?>-<?php echo get_city($result['home_city']);?>"><i class="iconfont icon-xiangyoujiantou"></i></p>
                </li> 
                <a href="attestation.html">               
                    <li>
                        <span>实名认证</span>
                        <p>   <?php if($result["is_auth"] == 1 ): ?><span>已认证</span>  <?php else: ?>  <span>未认证</span><?php endif; ?>              <i class="iconfont icon-xiangyoujiantou"></i></p>
                    </li>
                </a>
                <!-- <a href="address.html">
                    <li>
                        <span>收件地址</span>
                        <p><i class="iconfont icon-xiangyoujiantou"></i></p>
                    </li>
                </a> -->
                <a href="conceal.html">
                    <li style="margin-bottom:0.15rem;border:none;">
                        <span>隐私设置</span>
                        <p><i class="iconfont icon-xiangyoujiantou"></i></p>
                    </li>
                </a>
            </ul>
        </main>
        <footer class="footer">
            <p>
                <a href="">退出登录</a>
            </p>
        </footer>
    </div>  
    <p class='prompt'>修改成功</p>  
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

    $('.select-value1').mPicker({
        //级别
        level:2,
        //需要渲染的json，二级联动的需要嵌套子元素，有一定的json格式要求
        dataJson:dataJson,
        //true:联动
        Linkage:true,
        //显示行数
        rows:6,
        //默认值填充
        idDefault:true,
        //分割符号
        splitStr:'-',
        //头部代码
        // header:'<\div class="mPicker-header">两级联动选择插件<\/div>',
        confirm:function(){
            //更新json
            this.container.data('mPicker').updateData(level3);
            //console.info($('.select-value').data('value1')+'-'+$('.select-value').data('value2'));
        },
        cancel:function(){
            //console.info($('.select-value').data('value1')+'-'+$('.select-value').data('value2'));
        }
    })
    $('.select-value1').mPicker({
        level: 2,
        dataJson: dataJson,
        Linkage: true,
        rows: 6,
        idDefault: true,
        splitStr: '-',
        // header: '<div class="mPicker-header">两级联动选择插件</div>',
        confirm: function (json) {
            console.info('当前选中json：', json);

            addressArray = json.values.split('-');
            $('#province').val(addressArray['0'])
            $('#city').val(addressArray['1'])
            post_info(addressArray['0'],'home_province')
            post_info(addressArray['1'],'home_city')


            var _this= this;
            setTimeout(function(){
                _this.container.data('mPicker').updateData.call(_this,level3);
                var json = getVal();
                var valArr = json.value;
            },3000);
            
        },
        cancel: function (json) {
        }
    })
    //获取value
    function getVal(){
        var value1 = $('.select-value1').data('value1');
        var value2 = $('.select-value1').data('value2');
        var result='';
        value1 = value1 || '';
        value2 = value2 || '';
        if(value1){
            result= value1;
        }
        if(value2){
            result = result+'-'+ value2;
        }
        return {
            value:[value1, value2],
            result: result
        };
    }
    // 修改内容
    $('.tan').click(function(){ 
        var text = $(this).prev().text();  
        var input_obj = $(this).attr('attr')
        var ele = `<div class="dailog">
                        <div class="box">
                            <h5 class="tit">${text}</h5>
                            <textarea name="" id="" rows="5" placeholder="请填写内容"></textarea>
                            <p class="btnBox"><span onclick="quxiao()">取消</span><span attr='${input_obj}' onclick="write1(this,'${input_obj}')">写好了</span></p>
                        </div>
                    </div>`;
        $(this).parent().append(ele);
    })
    function quxiao(){
       $('.dailog').remove();
    }
    function write1(obj,input_obj){
        var val = $(obj).parent().prev().val();
        if(val != ''){
               post_info(val,input_obj)

                 $(obj).parents('.dailog').prev().find('span').text(val);
                            $('.dailog').remove();
                            $('.prompt').text('修改成功');
                            $('.prompt').animate({'opacity':1},1000);
                            setTimeout(function() {
                                $('.prompt').animate({'opacity':0},1000);
                            }, 1500);

        } else {
            var tex = '内容不能为空';
            $('.prompt').text(tex);
            $('.prompt').animate({'opacity':1},1000);
            setTimeout(function() {
                $('.prompt').animate({'opacity':0},1000);
            }, 1500);

        }
   }


   function post_info(value,column){
      $.ajax({
                type:'POST',
                url :"<?php echo U('center/set_info');?>",
                data:{
                    'value':value,
                    'column':column
                },
                success:function(msg){
            }

        })
    }
   
</script>
</html>