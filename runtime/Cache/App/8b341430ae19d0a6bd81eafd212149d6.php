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

    
    <div class="fabu">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>我要发布</span>
            </p>
        </header>
       <form id="mainForm" action="" method="post">
            
        <main class="main">
            <div class="head">
                <span>项目信息</span>
                <span class="explain">筹款说明</span>
            </div>
            <div class="section">
                <p class="target">
                    目标金额
                    <input type="number" id="target_money" name="target_money" placeholder="填写总筹款金额">
                    元
                </p>
                <textarea name=""  rows="5" id="money_purpose"  name="money_purpose"  placeholder="请填写资金用途"></textarea>
                <!--回报-->
                <div class="requite">
                    <div>是否有回报</div>
                    <p>
                        <span  class="le"></span>
                    </p>
                </div>
                <!--添加回报-->
                <div class="add" style="display:none;">
                    <a href="javascript:void(0)" onclick="add_return()">+ 添加回报</a>
                </div>

                <div class="show_add" style="  width: 100%; display: flex; justify-content: center; background: #eeeeee; padding: 0.2rem;display:none;">
                 <a href="javascript:void(0)" >
                        捐赠<span id="return_money_span" style="color: red"></span>元 <br>
                        <span id="return_content_span"> </span> </a>
                </div>
                <div class="type">
                    <span>项目类型</span>
                    <select name="type" id="type">
                        <option value="0">请选择</option>
                        <?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><option value="<?php echo ($t["id"]); ?>"><?php echo ($t["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                    <input type="hidden" id="return_money" name="return_money">
                    <input type="hidden" id="return_content" name="return_content">
                <div class="tit">
                    <span>标题</span>
                    <input type="text"  name="title" id="title"  placeholder="你的梦想是什么">
                </div>
                <textarea   rows="5"  name="summary" id="summary"  placeholder="请描述下你的梦想和故事，认真填写，文字将会在重要的位置显示"></textarea>
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
            </div>
        </main>
        <footer class="footer">
            <p class="submit">
               提交信息
            </p>
        </footer>
        <div class="dailog">
            <div class="tan">
                <p class="tex">筹款说明筹款说明筹款说</p>
                <span class="btn">确定</span>
        </form>
            </div>
        </div>
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

        
        


    $(function(){
        $("#target_money").val(localStorage.getItem("target_money"))
        $("#money_purpose").val(localStorage.getItem("money_purpose"))
        $("#type").val(localStorage.getItem("type"))
        $("#title").val(localStorage.getItem("title"))
        $("#summary").val(localStorage.getItem("summary"))
        $("#return_content").val(localStorage.getItem("return_content"))
        $("#return_money").val(localStorage.getItem("return_money"))
        $("#return_money_span").html(localStorage.getItem("return_money"))
        $("#return_content_span").html(localStorage.getItem("return_money"))
        if($("#return_content").val()  || $("#return_money").val() ){
            $('.le').addClass('ri');
            $('.show_add').show();
    }
    })


    //添加回报按钮
    function add_return(){
        localStorage.setItem("target_money", $('#target_money').val());
        localStorage.setItem("money_purpose", $('#money_purpose').val());
        localStorage.setItem("type", $('#type').val());
        localStorage.setItem("title", $('#title').val());
        localStorage.setItem("summary", $('#summary').val());
        window.location.href='/dream/add.html'
    }


    $('.icon-fanhui').click(function(){
        window.history.go(-1);
    })
    $('.dailog').hide();
    $('.btn').click(function(){
        $('.dailog').hide();
    })
    $('.explain').click(function(){
        $('.dailog').show();
    })
    $('.le').click(function(){
        $(this).toggleClass('ri')
        if($(this).hasClass('ri')){
            // true
            $('.add').show();
        } else {
            // false
            $('.add').hide();
            $('.show_add').remove();
            localStorage.removeItem('return_content')
            localStorage.removeItem('return_money')
        }
    })

    ///--------
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
            if((item['value'] == '' && item['name'] != 'return_money' ) && (item['value'] == '' && item['name'] != 'return_content' ) ) {
                console.log('信息不可为空') 
                showMsg('信息不可为空')
                flag = 1;
                return false
            } else {
            flag = 0;
        }
        })
        if(flag == 0){
       $va =  $("#type  option:selected").text()
               if($va == ''){
                   showMsg('项目类型不可为空')  
                   return false
           }
        var len = $('.imgBox li').length
            var count = 0;
    var target_money = document.getElementById('target_money').value;
    var money_purpose = document.getElementById('money_purpose').value;
    var type = document.getElementById('type').value;
    var title = document.getElementById('title').value;
    var summary = document.getElementById('summary').value;
    var return_content = document.getElementById('return_content').value;
    var return_money = document.getElementById('return_money').value;

            var array= [];
            for(var i = 0; i<len-1;i++){
    array.push($('.imgBox li:eq('+i+') img').attr('src'))
                   // array +=  $('.imgBox li:eq('+i+') img').attr('src')+',';
            }
            console.log(array);
            $.ajax({
                type:'POST',
                url :"<?php echo U('dream/release');?>",
                data:{'array':array,'type':type,'title':title,'target_money':target_money,'money_purpose':money_purpose,'summary':summary,'return_content':return_content,'return_money':return_money},
                success:function(msg){
                        window.location.href='/dream/index.html';
                        localStorage.clear();

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