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

    
    <div class="report">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>实名举报</span>
            </p>
        </header>
        <main class="main">
            <div class="banner"></div>
            <form id="mainForm" action="" method="post">
                <div class="container">
                    <span style="color: #2ab2f6;">照片上传</span>
                   <ul class="imgBox" id="1">


                    <li class="up">
                        <span><i class="iconfont icon-plus-bold"></i></span>
                        <input  type="file" name="img" class="file">
                    </li>
                </ul>
                    <ul>
                        <li><span class="tit">姓名</span><input name="auth_name" type="text" placeholder="请输入姓名"></li>
                        <li><span class="tit">身份证号</span><input name="auth_id" type="text" placeholder="请输入身份证号"></li>
                    </ul>
                    <div>
                        <p style="color: #2ab2f6;">举报理由</p>
                        <textarea name="content" rows="5"></textarea> 
                    </div>
                </div>
        </main>
        <!--底部导航-->
        <footer class="footer">
            <p> <input type="button" class="submit"  value="提交"  ></input></p>
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

        
        
     $('.icon-fanhui').click(function(){window.history.go(-1)})
    

    var flag = 0;
    $('.submit').click(function(){
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
            var prtt = /^[0-9]+$/
               var string = $('input[name=auth_id]').val();
                 var data =  prtt.test(string)
                if(!data){

                showMsg('请输入正确的身份证号')
                return false
            }

            var len = $('.imgBox li').length
            var item_id = '<?php echo ($_GET["id"]); ?>'
            var type = '<?php echo ($_GET["type"]); ?>'
            var array= [];
            for(var i = 0; i<len-1;i++){
                    array.push($('.imgBox li:eq('+i+') img').attr('src'))
                   // array +=  $('.imgBox li:eq('+i+') img').attr('src')+',';
            }
            $.ajax({
                type:'POST',
                url :"<?php echo U('index/report');?>",
                 data:$.param({'array':array,'type':type,'item_id':item_id})+'&'+$('form').serialize(),  
                success:function(msg){
                    console.log(msg)
                if(msg != 0){
                if(type == 1){$action = 'loveRelife';$controller = 'Index'}
                if(type == 2){$action = 'detail';$controller = 'Dream'}
                if(type == 3){$action = 'detail';$controller = 'Favorable'}

                showAlert('谢谢您的举报！后台人员将全力审核！','/'+$controller+'/'+$action+'/id/'+item_id+'.html')
                       // window.location.href='/release/step2/id/'+msg+'.html'
                }

            }
        })
        }
    })



    //=======================================================
    var imgarr = [];
    $('.file').on('change',function(e){
       var inp = $(this);
       var up = $(e.currentTarget).parents('li');
        $("#mainForm").ajaxSubmit({
        url : "<?php echo U('Release/ajaxUpload');?>", // 请求的url  
        type : "post", // 请求方式  
        dataType : "json", // 响应的数据类型  
        async :true, // 异步  
        success: function (data1) { 
            // alert(data1);
            // $('.uploadImg').empty();
           var ele = "\
            <li class='img'>\
                <img src='"+data1+"'>\
                <i class='iconfont icon-delete2' onclick='remove(this)'></i>\
            </li>";
            //$('.imgBox').before(ele);
            up.before(ele)
            $('#mainForm').find('input[name=image]').val(data1);
            imgarr.push(data1);
        },  
        error : function(){  
            alert("数据加载失败！"); 
        }  
         });     


    });
            $('#mainForm').submit(function(){
        
        $('.file').remove();
    });
 function remove(obj){
        var pid = $(obj).parents('.imgBox').attr('id');
        $(obj).parents('li').remove();
        if($('.imgBox[id='+pid+']').find('.img').length < 5){
            $('.imgBox[id='+pid+']').find('.up').show();
        }
    }

</script>
</html>