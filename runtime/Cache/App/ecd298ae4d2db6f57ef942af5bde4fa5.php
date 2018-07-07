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

    
    <div class="committee">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>筹款委员会信息</span>
            </p>
        </header>
        <main class="main">
            <div class="top">
                <p>
                    <span>委员会人员职位</span>
                    <span>Committee personnel</span>
                </p>
                <span class="child">委员会人员必须是权威的</span>
            </div>
            <div class="check">
                <form action="" method="post">
                    <?php if(is_array($commitInfo)): $i = 0; $__LIST__ = $commitInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><label><input type="radio" name="committee"
                        <?php if($result['committee'] == $v['id']): ?>checked<?php endif; ?>
                 name="committee" value="<?php echo ($v["id"]); ?>"><?php echo ($v["name"]); ?></label><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
      <!--       <div class="top">
                <p>
                    <span>权威认证</span>
                    <span>Authority</span>
                </p>
                <i class="iconfont icon-gengduo-tianchong"></i>
                <span class="child">需转发给权威人士填写，至少两位</span>
            </div>
            <ul>
                <li>
                    <span>名称</span>
                    <input type="text" placeholder="请输入名称">
                </li>
                <li>
                    <span>电话</span>
                    <input type="text" placeholder="请输入电话">
                </li>
                <li>
                    <span>职位</span>
                    <input type="text" placeholder="请输入职位">
                </li>
                <li>
                    <span>评价</span>
                    <div class="right">
                        <i class="iconfont icon-guanzhu"></i>
                        <i class="iconfont icon-guanzhu"></i>
                        <i class="iconfont icon-guanzhu"></i>
                        <i class="iconfont icon-guanzhu"></i>
                        <i class="iconfont icon-guanzhu"></i>
                    </div>
                </li>
            </ul> -->
        </main>
        <footer class="footer">
            <p class="sub">
                <input type="hidden" name="id" value="<?php echo ($_GET["id"]); ?>">
                <!--<input type="hidden" name="personal_img" value="<?php echo ($_GET["id"]); ?>">-->
                <button type="submit"> 提交</button>
            </p>
        </footer>
        </form>
        <div class="dailog" style="display:none;">
            <p>
                <i class="iconfont icon-QQ"></i>
                <span>QQ</span>
            </p>
            <p>
                <i class="iconfont icon-weixin"></i>
                <span>微信</span>
            </p>
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
    $('.icon-gengduo-tianchong').click(function(){
        $('.dailog').show()
    })

</script>
</html>