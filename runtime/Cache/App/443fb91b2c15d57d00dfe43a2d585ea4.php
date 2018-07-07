<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <meta name="apple-mobile-web-app-capable" content="yes">  
    <meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=no, width=device-width">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/home/font/iconfont.css">
    <link rel="stylesheet" href="/public/home/css/style.css">
    <link rel="stylesheet" href="/public/home/css/swiper.min.css">
    <title>Document</title>
</head>
<body>


    
<style type="text/css">.index .box1 {
height: 3rem;
overflow-y: scroll;
}

.index .box11 {
display: flex;
padding: 0.2rem;
align-items: center;
}

.index .box11 .img {
width: 0.8rem;
height: 0.8rem;
margin: 0;
}

.index_box{
padding: 0.2rem;
height:4rem;
}
.index_box>div{
height: 100%;
display:flex;
align-items: flex-end;
overflow-x: scroll;
overflow-y: hidden;
white-space: nowrap;
}
.index_box>div::-webkit-scrollbar {
display: none;
}
.index_boxC{
flex-shrink: 0; 
width: 1.5rem;
display:flex;
flex-direction: column;
align-items: center;
}
.index_boxC>span{
font-size: 0.2rem;
}
.index_img{
width: 0.6rem;
height:0.6rem;
margin: 0.1rem 0;
}
.index_boxC p{
width: 0.25rem;
margin: 0.1rem 0;
height: 2rem;
background: #eee;
position: relative;
border-radius: 0.1rem;
}
.index_boxC .icon-zan-copy-copy{
font-size: 0.3rem;
margin-left: 0.1rem;
}
.index_boxC p span{
position: absolute;
width: 100%;
background: #fd9826;
left:0;
bottom:0;
}
.index .box11 .r {
flex-grow: 1;
margin: 0 0.1rem;
display: flex;
justify-content: space-between;
}</style>
<div class="index">
    <header class="header">
        <span>公司宣传语</span>
        <span>今日累计筹款额<?php echo get_today_donor();?></span>
    </header>
    <main class="main">
        <ul class="nav">
            <a href="<?php echo U('mutual/index');?>">
                <li>
                   <i class="iconfont icon-xiangmu"></i>
                    <span>轻松互助</span>
                </li>
            </a>
            <a href="<?php echo U('favorable/index');?>">
                <li>
                    <i class="iconfont icon-aihao"></i>
                    <span>轻松公益</span>
                </li>
            </a>

            <a href="<?php echo U('dream/index');?>">
                <li>
                    <i class="iconfont icon-jineng"></i>
                    <span>梦想清单</span>
                </li>
            </a>
        </ul>

</style>
        <div class="once">
            <?php if(is_array($recommend)): $i = 0; $__LIST__ = $recommend;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="<?php echo U('loveRelife',array('id'=>$v['id']));?>">
                        <div class="box">
                            <div class="img">
                                <span><?php echo get_recomend_tag($v['tag']);?></span>
                                <img src="<?php echo get_first_img($v['personal_img']);?>" alt="">
                            </div>
                            <p style="width: 100px" class="tit"> <?php echo ($v["title"]); ?></p>
                            <div class="schedule">
                                <p>
                                    <span class="bac" style="width: <?php echo get_money_ratio($v['id'],1);?>%;"></span>
                                    <span class="b" style="left:<?php echo get_money_ratio($v['id'],1);?>%;"><?php echo get_money_ratio($v['id'],1);?>%</span>
                                </p>
                            </div>
                            <div class="bottom">
                                <span>已筹<?php echo get_sum_money($v['id'],1);?>元</span>
                            </div>
                        </div>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>

        </div>





        <!--明星慈善活动-->
        <div class="star">
            <div class="top">
                <p>
                    <span>明星慈善活动 <span style="color: red;font-size: 6px">(每个用户每24小时内只可以点击一次)</span> </span>
                    <span>Star Charity </span>
                </p>
                <i class="iconfont icon-gengduo-tianchong"></i>
            </div>

            <div class="index_box">
            <div>

         <?php if(is_array($star)): $i = 0; $__LIST__ = $star;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="index_boxC">     <!-- icon-zan zan2 -->
            <span> <span id="span_<?php echo ($s["id"]); ?>"><?php echo get_star_good_cnt($s['id']);?></span>

                <i id="<?php echo ($s["id"]); ?>" class="iconfont 

                            <?php if(get_current_good_star($s['id']) == 0): ?>icon-zan-copy-copy zan1 " onclick="greatClick(<?php echo ($s["id"]); ?>)"></i>

                                <?php else: ?>
                        icon-zan zan2  " onclick="cancleClick(<?php echo ($s["id"]); ?>)"></i><?php endif; ?></span>
            <p><span style="height:<?php echo get_star_ratio($s['id']);?>%;"></span></p >
            <div class="index_img"><img src="<?php echo ($s["img"]); ?>" alt=""></div>
            <span><?php echo ($s["name"]); ?></span>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>


            </div>
            </div>

<!-- 
           <div class="box1">

            <?php if(is_array($star)): $i = 0; $__LIST__ = $star;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$s): $mod = ($i % 2 );++$i;?><div class="box11">
                    <div class="img">
                        <img src="<?php echo ($s["img"]); ?>" alt="">
                    </div>

                    <div class="r">
                        <span><?php echo ($s["name"]); ?></span>
                        <p>
                        <span>
                            <i id="<?php echo ($s["id"]); ?>" class="iconfont 

                            <?php if(get_current_good_star($s['id']) == 0): ?>icon-zan-copy-copy zan1 " onclick="greatClick(<?php echo ($s["id"]); ?>)"></i>

                                <?php else: ?>
                        icon-zan zan2  " onclick="cancleClick(<?php echo ($s["id"]); ?>)"></i><?php endif; ?>

                            <span id="span_<?php echo ($s["id"]); ?>"><?php echo get_star_good_cnt($s['id']);?></span>
                        </span>
                           
                        </p >
                    </div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
           </div> -->





        </div>




















        <!--成功案例-->
        <div class="success">
            <div class="top">
                <p>
                    <span>成功案例</span>
                    <span>Success case</span>
                </p>
                <i class="iconfont icon-gengduo-tianchong"></i>
            </div>
            <div class="back swiper-container">
                <div class="swiper-wrapper">
                    

                    <?php if(is_array($successCase)): $i = 0; $__LIST__ = $successCase;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                        <div class="back">
                            <div class="middle">
                            <a href="<?php echo U('loveRelife',array('id'=>$v['id']));?>">
                                    <div class="imgBox" style="background-size: 100%; background: url(<?php echo get_first_img($v['personal_img']);?>)">
                                        <span><?php echo ($v["title"]); ?></span>
                                    </div>
                                </a>
                                <div class="schedule">
                                    <p>
                                        <span class="bac" style="width: <?php echo get_money_ratio($v['id'],1);?>%;"></span>
                                        <span class="b" style="left:<?php echo get_money_ratio($v['id'],1);?>%;"><?php echo get_money_ratio($v['id'],1);?>%</span>
                                    </p>
                                </div>
                                <div class="bottom">
                                    <span>已筹<?php echo get_sum_money($v['id'],1);?>元</span>
                                    <span>目标<?php echo ($v["target_money"]); ?>元</span>
                                </div>
                            </div>
                        </div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?>



                </div>
            </div>
        </div>
        <!--爱心救助-->
        <div class="love">
            <div class="top">
                <p>
                    <span>爱心救助</span>
                    <span>Love rescue</span>
                </p>
                <i class="iconfont icon-gengduo-tianchong"></i>
            </div>

           <?php if(is_array($relifeInfo)): $i = 0; $__LIST__ = $relifeInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="cont">
                <div class="unifo">
                        <span class="img">
                            <img src="<?php echo get_user_img($v['user_id']);?>" alt="">
                        </span>
                    <!--<i class="iconfont icon-nan"></i>-->
                    <?php echo get_username($v['user_id']);?>
                </div>
                <a href="<?php echo U('loveRelife',array('id'=>$v['id']));?>">
                    <div class="container">
                        <div class="left">
                            <img src="<?php echo get_first_img($v['personal_img']);?>" alt="">
                        </div>
                        <div class="right">
                            <p  class="tit"> <?php echo ($v["title"]); ?></p>
                            <div>
                                <div class="schedule">
                                    <p>
                                        <span class="bac" style="width: <?php echo get_money_ratio($v['id'],1);?>%;"></span>
                                        <span class="b" style="left:<?php echo get_money_ratio($v['id'],1);?>%;"><?php echo get_money_ratio($v['id'],1);?>%</span>
                                    </p>
                                </div>
                                <div class="bottom">
                                    <span>已筹<?php echo get_sum_money($v['id'],1);?>元</span>
                                    <span>目标 <?php echo ($v["target_money"]); ?>元</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div><?php endforeach; endif; else: echo "" ;endif; ?>


        </div>
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
        url :"<?php echo U('index/add_star');?>",
        data:{'star_id':id},
        success:function(msg){
            if(msg != 0){
            //window.location.href='/release/step2/id/'+msg+'.html'
            }

            }
        })

}



    
</script>
</html>