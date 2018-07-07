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
form{
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
}
</style>
    <div class="choukuan">
        <form id="mainForm" action="" method="post">

            <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>发起救助</span>
            </p>
        </header>

        <main class="main">
            <div class="fast">
                <span>不会写？帮你快速智能填写筹款信息</span><i class="iconfont icon-xiangyoujiantou"></i>
            </div>
            <div class="container">
                <p class="tex">目标金额</p>
                <p class="inp"><input type="number" value="<?php echo ($result["target_money"]); ?>" id="target_money" name="target_money" placeholder="填写目标金额">元</p>
            </div>
            <div class="container">
                <p class="tex">筹款标题<span class="consult">参考案例</span></p>
                <p class="inp"><input type="text" value="<?php echo ($result["title"]); ?>" id="title" name="title" placeholder="好的标题筹款更快（不超过20个汉字）"></p>
            </div>
            <div class="container">
                <p class="tex">求助内容<span class="consult">参考案例</span></p>
                <textarea id="summary" rows="5"  name="summary" ><?php echo ($result["summary"]); ?></textarea>
    </div>
            <input type="hidden" id="id" name="id" value="<?php echo ($result["id"]); ?>">
            <div class="container">
                <p class="tex">添加图片<span>可以添加5张图片</span></p>
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
            <!-- <input type="hidden" name="img" value=""> -->
            <p class="tit">
                <input type="checkbox" name="check">
                <span>我已阅读并同意《项目条款》及《发起人承诺书》</span>
            </p>
        </main>
        <footer class="footer">
            <p>
                <input type="button" class="submit"  value="下一步" id="agreementSub" ></input>
            </p>

        </footer></form>
        <div class="dailog" style="display:none">
            <h4>参考案例</h4>
            <p>这是一个参考案例这是一个参考案例这是一个参考案例这是一个参考案例这是一个参考案例这是一个参考案例</p>
            <span class="know">知道了</span>
        </div>
    </div>

 <div class="promulgate" style="display:none;">
        <div class="box">
            <div class="tit"><span>根据填写内容为你生成参考模板</span><i class="iconfont icon-delete2"></i></div>
            <ul>
                <li><span>您的姓名</span><input type="text" placeholder="填写您的姓名" name="username"></li>
                <li><span>为谁筹款</span><input type="text" placeholder="请选择" name="who"></li>
                <li><span>患者家乡</span><input type="text" class="select-value1 form-control" name="town" placeholder="请选择"><i class="iconfont icon-xiangyoujiantou"></i></li>
                <li><span>疾病名称</span><input type="text" placeholder="填写疾病名称" name="illness"></li>
                <li><span>确诊时间</span><input type="text" id="select_1" placeholder="请选择" name="time"><i class="iconfont icon-xiangyoujiantou"></i></li>
                <li><span>所在医院</span><input type="text" placeholder="填写所在医院" name="hospital"></li>
                <li><span>已花费金额</span><input type="text" placeholder="填写已花费金额" name="money"><span>元</span></li>
            </ul>
            <p class="create">
                <span>确认生成</span>
            </p>
        </div>
    </div>
    <p class='prompt'>信息不能为空</p> 



   
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
      $('.icon-fanhui').click(function(){window.location.href='/release/index.html'})
    $('input[name=check]').change(function(){
           $xieyi = $(this).prop('checked')
             
        })
    $(function(){
        $status = "<?php echo ($result["status"]); ?>";
        if($status == 1){
        showAlert('你尚未完成组织机构认证请在【个人中心->我发起的】转发给朋友帮忙认证 ','/release/index.html');
        }
         if($status == 2){
          showAlert('你已提交，请耐心等待工作人员审核。【个人中心->我发起的】可以查看进展','/release/index.html');
        }
         if($status == 3){
          showAlert('你的项目正在筹款中！在【个人中心->我发起的】可以查看  ','/release/index.html');
        }
    })


    // $('.file').change(function(e){
    //     var up = $(e.currentTarget).parents('li');
    //     fn(this.files[0],up);
    // })
    // function fn(da, up){
    //     var r = new FileReader();
    //     r.readAsDataURL(da);
    //     r.onload = function(e){
    //         var src = this.result;
    //         var ele = `
    //         <li class="img">
    //             <img src="${src}" alt="">
    //             <i class="iconfont icon-delete2" onclick="remove(this)"></i>
    //         </li>`;
    //         up.before(ele)
    //         if(up.parents('.imgBox').find('.img').length == 5){
    //             up.hide();
    //         }
    //     }
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
            //判断协议
          $xieyi =  $('input[name=check]').prop('checked')
           if(!$xieyi){
                flag = 1;
                showMsg('请阅读协议')
                return false
         }


    var len = $('.imgBox li').length
    var count = 0;
    var target_money = document.getElementById('target_money').value;
    var title =  document.getElementById('title').value;
    var summary =  document.getElementById('summary').value;
    var id =  document.getElementById('id').value;

            var array= [];
            for(var i = 0; i<len-1;i++){
    array.push($('.imgBox li:eq('+i+') img').attr('src'))
                   // array +=  $('.imgBox li:eq('+i+') img').attr('src')+',';
            }
            $.ajax({
                type:'POST',
                url :"<?php echo U('release/choukuan');?>",
                data:{'array':array,'title':title,'summary':summary,'target_money':target_money,'id':id},
                success:function(msg){
                    console.log(msg)
                if(msg != 0){
                        window.location.href='/release/step2/id/'+msg+'.html'
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



    //------

    $('.fast').click(function(){
        $('.promulgate').show();
        $('.promulgate .box').animate({'bottom': 0},500);
    })
    $('.icon-delete2').click(function(){
        $('.promulgate').hide();
        $('.promulgate .box').animate({'bottom': '-100%'});
    })
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
            var _this= this;
            console.info('【json里有带value的情况】');
            //更新json
            console.info('3s后更新json...');
            setTimeout(function(){
                _this.container.data('mPicker').updateData.call(_this,level3);
                var json = getVal();
                var valArr = json.value;
                console.info('更新成功!!');
                console.info('更新后的value为空', valArr[0], valArr[1]);
                console.info('更新后的value拼接值为空', json.result);
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
    var myDate = new Date();
    $.selectDate("#select_1",{
        start:2000,
        end:2918,
        select:[myDate.getFullYear(),myDate.getMonth()+1,myDate.getDate()],
        title:''
    },function (data) {
        var time = data.year+'年'+data.month+'月'+data.day+'日';
        $('input[name=time]').val(time)
    });
    var username,who,town,illness,time,hospital,money;
    $('.create').click(function(){
        username = $('input[name=username]').val();
        who = $('input[name=who]').val();
        town = $('input[name=town]').val();
        illness = $('input[name=illness]').val();
        time = $('input[name=time]').val();
        hospital = $('input[name=hospital]').val();
        money = $('input[name=money]').val();        
        if(username != '' && who != '' && town != '' && illness != '' && time != '' && hospital != '' && money != ''){
            var str = `大家好，我叫${username}，家住${town}，天有不测风云，原本幸福美满的家庭却被一场突如其来的大病拖垮。在${time}，突感不适，被送往${hospital}紧急救治，最后确诊为${illness}，如今已经花去${money}元，目前病情虽然已经控制住了，但后期治疗费用还需要很多资金，朋友亲戚该借的都借了，实在是无力承担这笔天大的费用。请大家帮帮我，多多转发，大家的恩情我一定会铭记在心，感恩，好人一生平安！`
            $('textarea[name=summary]').val(str);
            $('.promulgate').hide();
            $('.promulgate .box').animate({'bottom': '-100%'});
        } else {
            $('.prompt').animate({'opacity':1},1000);
            setTimeout(function() {
                $('.prompt').animate({'opacity':0},1000);
            }, 2500);
        }
    })

</script>
</html>