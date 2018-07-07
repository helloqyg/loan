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

    <style type="text/css">
    .select-value1{
        text-align: right;
    }
</style>
    <div class="toHelp">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>爱心宣扬</span>
            </p>
        </header>
        <main class="main">
            <form action="" method="post">
            <div class="banner">
                <p>需要爱心帮助的家庭</p>
                <p> N+</p>
                <p>
                    <i class="iconfont icon-yiwen"></i>
                    什么是爱心宣扬？？
                </p>
            </div>
            <div class="area">
                <span>选择帮助地区</span>
                <p>
                    <input type="text" name="a" class="select-value1 form-control " value="广东省-东莞市">
                    <i class="iconfont icon-xiangxiajiantouxiao" style="opacity: 0.5;margin-left:0.1rem;font-size:0.3rem;"></i>
                </p>
                <input type="hidden"  value="440000"  id="province">
                <input type="hidden"  value="441900"  id="city">
            </div>
            <div class="num">
                <span>项目个数</span>
                <input type="num" id="item_count"  name="item_count"  placeholder="填写帮助项目数（至少5个）">
                <span>个</span>
            </div>
            <div class="num">
                <span>单个金额</span>
                <input type="num" id="single_price"  name="single_price"  placeholder="填写单个帮助金额（至少10个）">
                <span>元</span>
            </div>
            <textarea id="content"  rows="5"  name="d"  placeholder="请填写祝福语（24字以内）" maxlength="24"></textarea>
        </main></form>
        <footer class="footer">
            <div class="foot">
                <span>
                    帮助金额：50元
                </span>
            </div>
            <p>
                <a onclick="helpIt()" href="javascript:void(0)">帮助TA</a>
            </p>
        </footer>
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



      $('.icon-fanhui').click(function(){window.location.href='/Announce/index.html'})
    var flag = 0;
    function helpIt(){
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
            var count = $('input[name=item_count]').val();
            var price = $('input[name=single_price]').val();
             var item_count =  ptrr.test(count)
            if(!item_count || count < 5){
                showMsg('请输入合法项目个数并且不少于5个')
                return false
            }
            if(!ptrr.test(price) || price < 10){
                showMsg('请输入合法的金额并且不少于10元')
                return false
            }


    var item_count = document.getElementById('item_count').value;
    var content = document.getElementById('content').value;
    var province = document.getElementById('province').value;
    var city = document.getElementById('city').value;
    var single_price = document.getElementById('single_price').value;
       window.location.href='/announce/helpIt/item_count/'+item_count+'/single_price/'+single_price+'/content/'+content+'/province/'+province+'/province/'+province+'/city/'+city+'.html'
   }
    }

    $('.icon-fanhui').click(function(){
        window.history.go(-1);
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