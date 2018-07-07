<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/home/font/iconfont.css">
    <link rel="stylesheet" href="/public/home/css/style.css">
    <link rel="stylesheet" href="/public/home/css/swiper.min.css">
    <title>Document</title>
</head>
<body>


    
    <div class="heart">
        <header class="header">
            <p>
                <span>爱心宣扬</span>
            </p>
        </header>
        <main class="main">
            <ul class="top">
                <li>
                    <i class="iconfont icon-xin"></i>爱心宣扬
                </li>
                <li><a href="<?php echo U('toHelp');?>"><span>去帮助</span></a></li>
            </ul>
            <?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="cont">
                <div class="new">
                    <div class="left">
                        <div class="img">
                            <img src="<?php echo get_user_img($v['user_id']);?>" alt="">
                        </div>
                        <div class="ri">
                            <p class="name">
                                <!--<i class="iconfont icon-nv"></i>-->
                                <span><?php echo get_username($v['user_id']);?></span>
                            </p>
                            <p class="text">
                                帮助了<?php echo ($v["item_count"]); ?>个家庭<span><?php echo ($v['item_count']*$v['single_price']); ?>元</span>
                            </p>
                        </div>
                    </div>
                    <p class="right" attr="<?php echo ($v['id']); ?>">
                        <i id="<?php echo ($v["id"]); ?>" class="iconfont 

                            <?php if(get_current_good($v['id']) == 0): ?>icon-zan-copy-copy zan1 " onclick="greatClick(<?php echo ($v["id"]); ?>)"></i>

                                <?php else: ?>
                        icon-zan zan2  " onclick="cancleClick(<?php echo ($v["id"]); ?>)"></i><?php endif; ?>

                            


                        <span id="span_<?php echo ($v["id"]); ?>"><?php echo get_current_good_cnt($v['id']);?></span>
                    </p>
                </div>
                <p><?php echo ($v["content"]); ?></p>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>
        </main>


    <footer class="footer">
        <ul>
            <a href="<?php echo U('index/index');?>">
                <li >
                    <i class="iconfont icon-shouye"></i>
                    <span>首页</span>
                </li>
            </a>
            <a href="<?php echo U('announce/index');?>">
                <li>
                    <i class="iconfont icon-aixin"></i>
                    <span>爱心宣扬</span>
                </li>
            </a>
            <a href="<?php echo U('release/index');?>">
                <li>
                    <i class="iconfont icon-tianjia1"></i>
                    <span>我要发起</span>
                </li>
            </a>
            <a href="<?php echo U('center/index');?>">
                <li>
                    <i class="iconfont icon-geren"></i>
                    <span>个人中心</span>
                </li>
            </a>
        </ul>
    </footer>
</div>
</body>
<script src="/public/home/scripts/swiper.min.js"></script>
<script src="/public/home/js/jweixin-1.2.0.js"></script>
<script src="/public/home/scripts/rem.js"></script>
<script src="/public/home/scripts/jquery.min.js"></script>
<script src="/public/home/scripts/jquery-form.js"></script>
<script >
    var url = location.href;

    if (url.indexOf('/index/index') >= 1) {
        $('.icon-shouye').parent().addClass('on');
    }
    if (url.indexOf('announce/index') >= 1) {
        $('.icon-aixin').parent().addClass('on');
    }
    if (url.indexOf('release/index') >= 1) {
        $('.icon-tianjia1').parent().addClass('on');
    }
    if (url.indexOf('center/index') >= 1) {
        $('.icon-geren').parent().addClass('on');
    }

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
        

    //点赞
    function greatClick(id){
    $('#'+id).removeClass('icon-zan-copy-copy')
    $('#'+id).removeClass('zan1')
    $('#'+id).addClass('icon-zan')
    $('#'+id).addClass('zan2')
    $('#'+id).removeAttr('onclick')
    $('#'+id).attr('onclick','cancleClick('+id+')')


   var num = $('#span_'+id).text()*1;
        $('#span_'+id).text(num+1)



     $.ajax({
        type:'POST',
        url :"<?php echo U('announce/good');?>",
        data:{'announce_id':id,'flag':'good'},
        success:function(msg){
            if(msg != 0){
            //window.location.href='/release/step2/id/'+msg+'.html'
            }

            }
        })

}

    //取消点赞
    function cancleClick(id){
    $('#'+id).addClass('icon-zan-copy-copy')
    $('#'+id).addClass('zan1')
    $('#'+id).removeClass('icon-zan')
    $('#'+id).removeClass('zan2')
    $('#'+id).removeAttr('onclick')
    $('#'+id).attr('onclick','greatClick('+id+')')


   var num = $('#span_'+id).text()*1;
        $('#span_'+id).text(num-1)

         $.ajax({
        type:'POST',
        url :"<?php echo U('announce/good');?>",
        data:{'announce_id':id,'flag':'cancel'},
        success:function(msg){
            if(msg != 0){
            //window.location.href='/release/step2/id/'+msg+'.html'
            }

            }
        })
}





    
</script>
</html>