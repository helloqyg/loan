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
            <main class="main">
        <form action="" method="post" onsubmit="return checkLength()" >
                <div class="top">
                    <ul>
                        <li><span class="tex">帮助金额</span><input type="number" name="price" placeholder="输入帮助金额"></li>
                    </ul>
  <!--                   <div class="area">
<span style="color: #2ab2f6">选择帮助地区</span>
<p>
<input type="text" class="select-value1 form-control" value="广东省-东莞市">
<i class="iconfont icon-xiangxiajiantouxiao" style="opacity: 0.5;margin-left:0.1rem;font-size:0.3rem;"></i>
</p >
</div>
<ul>
<li><span class="tex">详细地址</span><input type="text" name="detail_address" placeholder="输入详细地址"></li>
</ul>
 -->                <input type="hidden"  value="440000" name="province"  id="province">
                <input type="hidden"  value="441900"  name="city" id="city">
                <input type="hidden"    name="type" value="2">
                <input type="hidden"    name="item_id" value="<?php echo ($_GET['id']); ?>">
                    <p class="tex">对TA说一句鼓励的话吧</p>
                    <textarea name="content" id="" rows="5"  placeholder="我想对你说……"></textarea>
                    <!-- <p class="check">
                        <label for="">
                            <input type="checkbox" name="is_anonymous" value="1">匿名帮助
                        </label>
                    </p> -->
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

        
        
   $('.icon-fanhui').click(function(){window.location.href='/Dream/detail/id/<?php echo ($_GET["id"]); ?>.html'})
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
    sleep(100);
    return true;
}else{
    return false
}
}

//提交表单 调起支付
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
             var data =  ptrr.test(string)
            if(!data){
                showMsg('请输入合法的金额')
                return false
            }
            var total_price = $('input[name=price]').val()
            var content = $('input[name=content]').val()
            alert(content)
            $.ajax({
                type:'POST',
                url :"<?php echo U('Order/create_order');?>",
                data:{'total_price':total_price,'type':2,content:content,'item_id':<?php echo ($_GET["id"]); ?>},
                success:function(msg){
                    if(msg){
                    window.location.href="/Order/request_pay/order_id/"+msg
                }
              

            }
        })
    }
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
            addressArray = json.values.split('-');
    $('#province').val(addressArray['0'])
    $('#city').val(addressArray['1'])
            console.log(json.values.split('-'))
            var _this= this;
            //console.info('【json里有带value的情况】');
            //更新json
              // console.info('3s后更新json...');
   //          setTimeout(function(){
   //              _this.container.data('mPicker').updateData.call(_this,level3);
   //              var json = getVal();
   //              var valArr = json.value;
   //              console.info('更新成功!!');
   //              console.info('更新后的value为空', valArr[0], valArr[1]);
   //              console.info('更新后的value拼接值为空', json.result);
   //          },3000);


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


</script>
</html>