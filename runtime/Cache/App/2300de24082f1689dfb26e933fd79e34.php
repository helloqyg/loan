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

    
    <style type="text/css"> .detail .comment {width: 100%; display: flex; margin-top: 0.1rem; flex-direction: column; background: #eee; justify-content: flex-end; } .detail .comment p {padding: 0.2rem; } .detail .comment span {color: #2ab2f6; } body{position: relative; } .cover{position:absolute; width: 100%; height:100%; left: 0; top:0; background:rgba(100,100,100,.5); display: flex; align-items: center; justify-content: center; } .cover>div{width: 5rem; height: 4rem; padding: 0.4rem; background: #eee; border-radius: 0.1rem; display: flex; flex-direction: column; align-items: flex-end; } .cover h5{width: 100%; } .cover textarea{width: 100%; padding: 0.15rem; background: #fff; margin: 0.1rem 0; } .cover .num{color: #999; font-size: 0.2rem; } .cover .btnBox{width: 100%; display: flex; } .cover .btnBox span{flex-grow: 1; text-align: center; padding: 0.2rem; } </style>
    <div class="detail">
        <header class="header">
            <p>
                <i class="iconfont icon-fanhui"></i>
                <span>标题</span>
                <i class="iconfont icon-fenxiang"></i>
            </p>
        </header>
        <main class="main">
            <ul class="unifo">
               <!-- <li>
                    <p class="img1">
                        <img src="/public/home/img/touxiang-1@2x.png" alt="">
                    </p>
                    <i class="iconfont icon-nv"></i>
                    步枪和小米
                </li>-->
                <li>
                    <p class="img1">
                        <img src="<?php echo get_img($v['ins_logo']);?>" alt="">
                    </p>
                   <?php echo ($itemInfo["ins_name"]); ?>
                </li>
                <li>
                    <i class="iconfont icon-shijian"></i>
                    剩余<b><?php echo overplus_time($itemInfo['create_date']);?></b>天
                </li>
            </ul>
            <div class="top1">
                <p class="tit"><?php echo ($itemInfo["title"]); ?></p>
                <div class="img2">
                    <img src="/public/home/img/three@2x.png" alt="">
                </div>
                <!--已经筹款-->
                <div>
                    <p class="jin">
                        <span style="width: <?php echo get_money_ratio($itemInfo['id'],3);?>%"></span>
                        <i class="iconfont icon-woniu" style="left:<?php echo get_money_ratio($itemInfo['id'],3);?>%;"></i>
                    </p>
                    <p class="tex1">
                        <span>已筹款<?php echo get_sum_money($_GET['id'],3);?>元</span><span>需筹<?php echo ($itemInfo["target_money"]); ?>元</span>
                    </p>
                </div>
                <!--已经帮助的-->
                <div>
                    <!--进度条-->
                    <p class="jin">
                        <span style="width: <?php echo get_money_ratio($itemInfo['id'],3);?>%"></span>
                        <i class="iconfont icon-woniu" style="left:<?php echo get_money_ratio($itemInfo['id'],3);?>%;"></i>
                    </p>
                    <p class="nums"><span>已帮助<?php echo get_money_cont($_GET['id'],3);?>次</span></p>
                </div>
                <!--排行榜-->
                <div class="ranking">
                    <p class="left">
                        <i class="iconfont icon-gushi"></i>
                        爱心贡献榜
                    </p>
                    <p class="right">
                        <?php if(is_array($top3)): $i = 0; $__LIST__ = $top3;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><span>
                            <img src="<?php echo get_user_img($v['user_id']);?>" alt="">
                            <i class="iconfont icon-guanjun"></i>
                        </span><?php endforeach; endif; else: echo "" ;endif; ?>

                        <a href="<?php echo U('rankList',array('id'=>$_GET['id']));?>"><i class="iconfont icon-xiangyoujiantou"></i></a>
                    </p>
                </div>
            </div>
            <style type="text/css">
                .contt{
                    display: -webkit-box;
                    -webkit-box-orient: vertical;
                    -webkit-line-clamp: 6;
                    overflow: hidden;
                    height: 2.75rem;
                }
            </style>

            <div class="center">
                <div class="top">
                    <p>
                        <span>项目详情</span>
                        <span>Project details</span>
                    </p>
                </div>
                <p class="cont contt">
                    <?php echo ($itemInfo["summary"]); ?>
                  </p>
            </div>


            <div class="bottom">
                <div class="top">
                    <p>
                        <span>TA的帮助</span><span>Help from Ta</span>
                    </p>
                </div>

                <?php if(is_array($donorList)): $i = 0; $__LIST__ = $donorList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><ul>
                    <li>
                        <?php if($v["is_anonymous"] == 1): ?><img src="/public/home/img/niming.jpg" alt="">
                            <?php else: ?>
                        <img src="<?php echo get_user_img($v['user_id']);?>" alt=""><?php endif; ?>
                    </li>
                    <li>
                        <div class="tot">
                            <p>

                                <?php if($v["is_anonymous"] == 1): ?><span style="color:#f61353;">匿名用户</span>
                                <?php else: ?>
                                    <span style="color:#f61353;"><?php echo get_username($v['user_id']);?></span><?php endif; ?>




                                支持了<span style="color:#7dffbe;"><?php echo ($v["price"]); ?>元</span></p>
                            <p style="color:#939393;"><?php echo get_diff_time($v['date']);?></p>
                        </div>
                        <p class="bob">
                            <span>
                                <i class="iconfont icon-xin d1" style="display:none;"></i>
                               <!--  <i class="iconfont icon-heart d2"></i>
                                <span style="margin:0;">4789</span> -->
                            </span>
                            <span><i class="iconfont icon-pinglun" attr='<?php echo ($v["id"]); ?>' ></i><?php echo get_comments_cnt($v['id'],1);?></span>
                        </p>
                        <div class="comment">
                            <?php if(is_array($v['comments'])): $i = 0; $__LIST__ = $v['comments'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$c): $mod = ($i % 2 );++$i;?><p><span><?php echo get_username($c['user_id']);?></span>: <?php echo ($c["content"]); ?></p ><?php endforeach; endif; else: echo "" ;endif; ?>
                            </div>
                    </li>
                </ul><?php endforeach; endif; else: echo "" ;endif; ?>


            </div>
        </main>
        <footer class="footer">
            <div class="foot">
                <a href="<?php echo U('index/report',array('id'=>$_GET['id'],'type'=>3));?>">
                    <span>
                        <i class="iconfont icon-jubao"></i>举报
                    </span>
                </a>
                <a>
                    <span>
                        <?php if($follow == null): ?><i class="iconfont icon-guanzhu"></i>

                        <?php else: ?>

                        <i class="iconfont aa icon-guanzhu1" ></i><?php endif; ?>


                        <i class="iconfont icon-guanzhu" style=" display: none"></i>
                        <i class="iconfont icon-guanzhu1" style="display: none" ></i>

                        关注
                    </span>
                </a>
                <a href="/Announce/toHelp.html">
                    <span>
                        <i  class="iconfont icon-heart"></i>爱心
                    </span>
                </a>
            </div>
            <p>
                <a href="<?php echo U('helpIt',array('id'=>$_GET["id"]));?>">
                    帮助TA
                </a>
            </p>
        </footer>
    </div>
<div class="cover" style="display:none;">
<div>
<h5>发表评论</h5>
<textarea name="iSay" id="" rows="5" placeholder="我也说一句……" maxlength="80"></textarea>
<p class="btnBox">
<span onclick="$('.cover').hide();" >取消</span>
<span class="write" >写好了</span>
</p >
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

        
        


    $('.icon-heart').click(function(){window.location.href='/Announce/toHelp.html'})

    $('.icon-fanhui').click(function(){window.location.href='/favorable/index.html'})
// 评论


var doc; 
var id ;
$('.icon-pinglun').click(function(){

        id = $(this).attr('attr');
        doc = $(this).parents('ul').find('.comment');
        $('.cover').show();
        $('textarea[name=iSay]').val('')


    }) 

    $('.write').click(function(){
   
     var text = $('textarea[name=iSay]').val();
                $('.cover').hide();

     $.ajax({
                type:'POST',
                url :"<?php echo U('index/comments');?>",
                data:{'donor_id':id,'type':3,'content':text,'item_id':<?php echo ($_GET["id"]); ?>},
                success:function(msg){
                    console.log(msg)
                if(msg == -1){
                 showMsg('请先进行捐赠再来评论！')
                }else{
                    var ele = `<p><span><?php echo get_username(get_user_id());?></span>: ${text}</p >`;
                    doc.prepend(ele)
            }

            }
        })
    

}) 

    // 点赞
    $('.d2').click(function(){
        var num = $(this).parent().find('span').text()*1;
        $(this).parent().find('span').text(num+1)
        $(this).hide().prev().show();
    })
    // 取消点赞
    $('.d1').click(function(){
        var num = $(this).parent().find('span').text()*1;
        console.log(num)
        $(this).parent().find('span').text(num-1);
        $(this).hide().next().show();
    })
    // 关注
    $('.icon-guanzhu').click(function(){
        $(this).hide().parent().find('.icon-guanzhu1').show();
        history.go(0) 
         $.ajax({
                type:'POST',
                url :"<?php echo U('index/follow');?>",
                data:{'item_id':<?php echo ($_GET["id"]); ?>,'flag':'add','type':3},
                success:function(msg){
                    console.log(msg)
                if(msg != 0){
                        //window.location.href='/release/step2/id/'+msg+'.html'
                }

            }
        })

    })
    // 取消关注
    $('.icon-guanzhu1').click(function(){
        $(this).hide().parent().find('.icon-guanzhu').show();
        history.go(0) 
        $.ajax({
                type:'POST',
                url :"<?php echo U('index/follow');?>",
                data:{'item_id':<?php echo ($_GET["id"]); ?>,'flag':'delete','type':3},
                success:function(msg){
                    console.log(msg)
                if(msg != 0){
                        //window.location.href='/release/step2/id/'+msg+'.html'
                }

            }
    })
      })
    $('.cont').click(function(){
        $(this).toggleClass('contt');
    })

    
</script>
</html>