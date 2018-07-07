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

    
    <div class="shim">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>实名认证 </span>
            </p>
        </header>
        <main class="main">
            <div class="top">
                <p>
                    <span>个人信息认证</span>
                    <span>Personal information</span>
                </p>
            </div>
            <form id="mainForm" action="" method="post">
            <ul>
                <li><span class="tex">身份证号</span><input value="<?php echo ($result["me_id"]); ?>" type="text" name="me_id" id="me_id" placeholder="请输入身份证号码"></li>
                <li><span class="tex">联系电话</span><input value="<?php echo ($result["me_tel"]); ?>" type="text"  name="me_tel"  id="me_tel" placeholder="请输入联系电话"></li>
                <li><span class="tex">电子邮箱</span><input value="<?php echo ($result["me_email"]); ?>" type="text"  name="me_email" id="me_email"  placeholder="请输入电子邮箱"></li>
                <li><span class="tex">银行卡号</span><input value="<?php echo ($result["me_bank"]); ?>" type="text"  name="me_bank" id="me_bank"  placeholder="请输入银行卡号"></li>
            </ul>
            <div class="top">
                <p>
                    <span>家人信息认证</span>
                    <span>Family information</span>
                </p>
            </div>
            <ul>
                <li><span class="tex">身份证号</span><input  value="<?php echo ($result["family_id"]); ?>" type="text"  id="family_id" name="family_id" placeholder="请输入身份证号码"></li>
                <li><span class="tex">联系电话</span><input  value="<?php echo ($result["family_tel"]); ?>" type="text" id="family_tel"  name="family_tel" placeholder="请输入联系电话"></li>
            </ul>
            <div class="top">
                <p>
                    <span>组织机构认证</span>
                    <span>Organization certification</span>
                </p>
            </div>
            <div class="check">
                <?php if(is_array($organInfo)): $i = 0; $__LIST__ = $organInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label>
                    <input type="radio"<?php if($result['organization'] == $v['id']): ?>checked<?php endif; ?> name="organization" value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?>
                  </label><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <style type="text/css">
                .imgBox li{
                    border: none;
                }
            </style>
            <p style="padding-left:0.3rem;font-size:0.15rem;opacity: .7;margin-top:0.15rem;">请上传证明资料，可以添加5张图片</p >
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
        <footer class="footer">
            <input type="hidden" id="id" name="id" value="<?php echo ($_GET["id"]); ?>">
            <p>
                <input type="button" class="submit"  value="下一步" id="agreementSub" ></input>
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

        
        


       $('.icon-fanhui').click(function(){window.history.go(-1); }) 
    // $('.file').change(function(e){
    // var up = $(e.currentTarget).parents('li');
    // fn(this.files[0],up);
    // })
    // function fn(da, up){
    // var r = new FileReader();
    // r.readAsDataURL(da);
    // r.onload = function(e){
    // var src = this.result;
    // var ele = `
    // <li class="img">
    //     <img src="${src}" alt="">
    //     <i class="iconfont icon-delete2" onclick="remove(this)"></i>
    // </li>`;
    // up.before(ele)
    // if(up.parents('.imgBox').find('.img').length == 5){
    // up.hide();
    // }
    // }
    // }
    function remove(obj){
    var pid = $(obj).parents('.imgBox').attr('id');
    $(obj).parents('li').remove();
    console.log($('.imgBox[id='+pid+']').find('.img').length )
    if($('.imgBox[id='+pid+']').find('.img').length < 5){
    $('.imgBox[id='+pid+']').find('.up').show();
    }
    }

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
           
            var len = $('.imgBox li').length
            var count = 0;
            var me_id = document.getElementById('me_id').value;
            var me_tel = document.getElementById('me_tel').value;
            var me_email = document.getElementById('me_email').value;
            var me_bank = document.getElementById('me_bank').value;
            var id = document.getElementById('id').value;
            var family_id = document.getElementById('family_id').value;
            var family_tel = document.getElementById('family_tel').value;
            var organization = $('input:radio:checked').val();
            var array= [];
        for(var i = 0; i<len-1;i++){
            array.push($('.imgBox li:eq('+i+') img').attr('src'))
            // array +=  $('.imgBox li:eq('+i+') img').attr('src')+',';
            //console.log($('.imgBox li:eq('+i+') img').attr('src'))
        }
        console.log(array);
        $.ajax({
            type:'POST',
            url :"<?php echo U('release/step2');?>",
            data:{
                'array':array,
                'me_id':me_id,
                'me_tel':me_tel,
                'me_email':me_email,
                'me_bank':me_bank,
                'family_id':family_id,
                'family_tel':family_tel,
                'organization':organization,
                'id':id

            },
                success:function(msg){
                console.log(msg)
                if(msg != 0){
                    window.location.href='/release/step3/id/'+msg+'.html'
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

</script>
</html>