<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="微信管理系统" />
	<meta name="author" content="widuu" />
	<title><?php if(!empty($title)): echo ($title); ?>-<?php endif; ?>众筹后台管理系统</title>
	<link rel="stylesheet" href="/public/admin/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="/public/admin/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/public/admin/css/bootstrap.css">
	<link rel="stylesheet" href="/public/admin/css/xenon-core.css">
	<link rel="stylesheet" href="/public/admin/css/xenon-forms.css">
	<link rel="stylesheet" href="/public/admin/css/xenon-components.css">
	<link rel="stylesheet" href="/public/admin/css/xenon-skins.css">
	<link rel="stylesheet" href="/public/admin/css/custom.css">
	<script src="/public/admin/js/jquery-1.11.1.min.js"></script>
	
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="/public/admin/js/html5shiv.min.js"></script>
		<script src="/public/admin/js/respond.min.js"></script>
	<![endif]-->
</head>
<body class="page-body">
	<div class="copyrights"></div>
	<div class="page-container">
		<div class="sidebar-menu toggle-others fixed">
			<div class="sidebar-menu-inner">
				<header class="logo-env">
					<div class="logo">
						<a href="<?php echo U('/manager/index');?>" class="logo-expanded">
							<img src="/public/images/logo.png" alt="" />
						</a>

						<!--<a href="<?php echo U('/manager/index');?>" class="logo-collapsed">
							<img src="/public/admin/images/logo1.png" width="40" alt="" />
						</a>-->
					</div>

					<div class="mobile-menu-toggle visible-xs">
						<a href="#" data-toggle="mobile-menu">
							<i class="fa-bars"></i>
						</a>
					</div>

				</header>
				<ul id="main-menu" class="main-menu">
					<li class="active">
						<a href="<?php echo U('/manager/index');?>">
								<i class="fa-home"></i>
								<span class="title">仪表盘</span>
						</a>
					</li>
					<!--class="active opened active"-->
					<li>
						<a href="<?php echo U('System/website');?>">
							<i class="linecons-cog"></i>
							<span class="title">全局设置</span>
						</a>
						<!--<ul>
							<li class="active">
								<a href="<?php echo U('System/website');?>">
									<span class="title">站点信息</span>
								</a>
							</li>
							<li>
								<a href="<?php echo U('System/features');?>">
									<span class="title">站点功能</span>
								</a>
							</li>
						</ul>-->
					</li>
					<li>
						<a href="#">
							<i class="linecons-doc"></i>
							<span class="title">爱心救助</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('jiuzhu/index');?>">
									<span class="title">列表</span>
								</a>
							</li>
							
								<li>
								<a href="<?php echo U('jiuzhu/tag');?>">
									<span class="title">标签管理</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo U('adver/index');?>">
							<i class="fa-area-chart"></i>
							<span class="title">梦想清单</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('dream/index');?>">
									<span class="title">信息列表</span>
								</a>
							</li>
							<li>
								<a href="<?php echo U('dream/type');?>">
									<span class="title">导航分类</span>
								</a>
							</li>
							<!-- <li>
								<a href="<?php echo U('Adver/apply');?>">
									<span class="title">合同申请</span>
								</a>
							</li> -->
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="linecons-note"></i>
							<span class="title">轻松公益</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('Relaxed/index');?>">
									<span class="title">列表</span>
								</a>
							</li>
							<li>
								<a href="<?php echo U('News/add');?>">
									<span class="title">添加帮助</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="linecons-note"></i>
							<span class="title">爱心宣扬</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('announce/index');?>">
									<span class="title">全部信息</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="linecons-note"></i>
							<span class="title">所有捐款</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('Donor/index');?>">
									<span class="title">捐款列表</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="linecons-note"></i>
							<span class="title">举报中心</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('Report/index');?>">
									<span class="title">举报列表</span>
								</a>
							</li>
							
						</ul>
					</li>
					<li>
						<a href="<?php echo U('User/manage');?>">
							<i class="linecons-user"></i>
							<span class="title">用户管理</span>
							<span class="label label-success pull-right"><?php echo ($member_total); ?></span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('User/index');?>">
									<span class="title">前台用户</span>
								</a>
							</li>
							
							<!--<li>
								<a href="<?php echo U('User/audience');?>">
									<span class="title">后台用户</span>
								</a>
							</li>-->
						</ul>
					</li>
					<!--<li>-->
						<!--<a href="<?php echo U('User/manage');?>">-->
							<!--<i class="fa-cc-visa"></i>-->
							<!--<span class="title">财务管理</span>-->
						<!--</a>-->
						<!--<ul>-->
							<!--<li>-->
								<!--<a href="<?php echo U('Invoice/index');?>">-->
									<!--<span class="title">发票申请</span>-->
								<!--</a>-->
							<!--</li>-->
							<!--<li>-->
								<!--<a href="<?php echo U('Invoice/apply');?>">-->
									<!--<span class="title">汇款审核</span>-->
								<!--</a>-->
							<!--</li>-->
						<!--</ul>-->
					<!--</li>-->
					<li>
						<a href="#">
							<i class="linecons-params"></i>
							<span class="title">个人设置</span>
						</a>
						<ul>
							<li>
								<a href="<?php echo U('User/modify');?>">
									<span class="title">修改密码</span>
								</a>
							</li>
							<li>
								<a href="<?php echo U('User/add');?>">
									<span class="title">添加用户</span>
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo U('Login/loginout');?>">
							<i class="fa-sign-out"></i>
							<span class="title">退出</span>
						</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="main-content">
			<!-- User Info, Notifications and Menu Bar -->
			<nav class="navbar user-info-navbar" role="navigation">
				<!-- Left links for user info navbar -->
				<ul class="user-info-menu left-links list-inline list-unstyled">
					<li class="hidden-sm hidden-xs">
						<a href="#" data-toggle="sidebar">
							<i class="fa-bars"></i>
						</a>
					</li>
				</ul>


				<!-- Right links for user info navbar -->
				<ul class="user-info-menu right-links list-inline list-unstyled">

					<!-- <li class="search-form">You can add "always-visible" to show make the search input visible

						<form method="get" action="<?php echo U('');?>">
							<input type="text" name="key" class="form-control search-field" placeholder="Type to search..." />

							<button type="submit" class="btn btn-link">
								<i class="linecons-search"></i>
							</button>
						</form>

					</li>
					 -->
					<li class="dropdown --> user-profile">
						<a href="#" data-toggle="dropdown">
							<img src="/public/admin/images/user-4.png" alt="user-image" class="img-circle img-inline userpic-32" width="28" />
							<span>
								<?php echo session('username');?>
								<i class="fa-angle-down"></i>
							</span>
						</a>

						<ul class="dropdown-menu user-profile-menu list-unstyled">
							<li>
								<a href="<?php echo U('User/modify');?>">
									<i class="fa-wrench"></i>
									个人设置
								</a>
							</li>
							<li class="last">
								<a href="<?php echo U('Login/loginout');?>">
									<i class="fa-lock"></i>
									退出
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php if(!empty($result["id"])): ?>修改<?php else: ?>添加<?php endif; ?>-<?php echo ($header); ?></h3>
			</div>
		
		<style type="text/css">
			
.imgBox {
  padding: 0.1rem 0.25rem;
  margin-bottom: 0.4rem;
  display: flex;
  align-items: center;
  flex-wrap: wrap;
}
.imgBox img {
 width: 110px;


}
.imgBox .icon-delete2 {
  color: red;
  font-size: 0.24rem;
  position: absolute;
  top: 0rem;
  right: 0.05rem;
}



.img, .up {
  height: 1.6rem;
  margin-bottom: 0.2rem;
}

.up {
  background: none;
  border-radius: 0.1rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

.up span {
  border: 1px solid #ccc;
  width: 100%;
  height: 100%;
  background: #fff;
  border-radius: 0.1rem;
  display: flex;
  justify-content: center;
  align-items: center;
}

		</style>	
		<div class="panel-body">
				<form id="mainForm" role="form" class="form-horizontal" method="post" action="">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">目标金额</label>	
						<div class="col-sm-6">
							<input type="text" class="form-control" name="target_money" id="target_money" value="<?php echo ((isset($result["target_money"]) && ($result["target_money"] !== ""))?($result["target_money"]):''); ?>" placeholder="">
							<p class="help-block"></p>
						</div>
					</div>
					<div class="form-group-separator"></div>
					
					<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">资金用途</label>
							<div class="col-sm-6">
								<textarea class="form-control" cols="5" id="money_purpose" name="money_purpose"><?php echo ((isset($result["money_purpose"]) && ($result["money_purpose"] !== ""))?($result["money_purpose"]):''); ?></textarea>
							</div>
						</div>

					<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">项目类型</label>
							<div class="col-sm-6">
								<select id="type"  class="form-control" >
									<?php if(is_array($type)): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($t["id"]); ?>"><?php echo ($t["name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
								</select>
							</div>
						</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">标题</label>	
						<div class="col-sm-6">
							<input type="text" class="form-control" name="area" id="title" value="<?php echo ((isset($result["title"]) && ($result["title"] !== ""))?($result["title"]):''); ?>" placeholder="">
							<p class="help-block"> </p>
						</div>
					</div>
					
					<div class="form-group-separator"></div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="field-5">描述信息</label>
							<div class="col-sm-6">
								<textarea class="form-control" cols="5" id="summary" name="description"><?php echo ((isset($result["summary"]) && ($result["summary"] !== ""))?($result["summary"]):''); ?></textarea>
							</div>
						</div>
				
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">支付金额</label>	
						<div class="col-sm-6">
							<input type="text" class="form-control" name="area" id="return_money" value="<?php echo ((isset($result["return_money"]) && ($result["return_money"] !== ""))?($result["return_money"]):''); ?>" placeholder="">
							<p class="help-block"> </p>
						</div>
					</div>
				<div class="form-group">
						<label class="col-sm-2 control-label" for="field-1">回报内容</label>	
						<div class="col-sm-6">
						<textarea class="form-control" cols="5" id="return_content" name="return_content"><?php echo ((isset($result["return_content"]) && ($result["return_content"] !== ""))?($result["return_content"]):''); ?></textarea>
							<p class="help-block"> </p>
						</div>
					</div>
					<input type="hidden" id="id" name="id" value="<?php echo ($_GET["id"]); ?>">
		<div class="form-group-separator"></div>
					<div style="height: 150px" class="form-group">
						<label class="col-sm-2 control-label" for="field-1">图片</label>	
						<div class="col-sm-6">
			 <ul class="imgBox" id="1">
                       <?php if(is_array($imgArray)): $i = 0; $__LIST__ = $imgArray;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li class="img">
                        <img src="<?php echo ($v["url"]); ?>" onclick="remove(this)" alt="">
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                <li class="up">
                    <span><i class="iconfont icon-plus-bold"></i></span>
                        <input  type="file" name="img" class="file">
                </li>
            </ul>

						</div>
					</div>

					<div class="form-group-separator"></div>


							<div class="form-group">
						<label class="col-sm-2 control-label" for="field-5">状态</label>
							<div class="col-sm-6">
						
				
				  	<label class="radio-inline"><input type="radio" id="status" checkedname="organization" name="status" 	<?php if($result['status'] == 2): ?>checked<?php endif; ?> value="2">隐藏</label>

				  	<label class="radio-inline"><input type="radio"  checkedname="organization" name="status" 	<?php if($result['status'] == 3): ?>checked<?php endif; ?> value="3">筹款中(审核成功)</label>
				  	<label class="radio-inline"><input type="radio" checkedname="organization" name="status"	<?php if($result['status'] == 4): ?>checked<?php endif; ?> value="4">已结束</label>
						</div>
					</div>

					<div class="form-group-separator"></div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="field-5">是否置顶</label>
							<div class="col-sm-6">
							<label class="radio-inline">
								<input type="radio" name="is_top" id="is_top" value="1"  <?php if(($result["is_top"]) == "1"): ?>checked<?php endif; ?> /> 置顶
							</label>
							<label class="radio-inline">
								<input type="radio" name="is_top" id="is_top" value="0" <?php if(($result["is_top"]) == "0"): ?>checked<?php endif; ?>/> 不置顶
							</label>
						</div>
					</div>
					<div class="form-group text-center">
						<input type="hidden" name="id" value="<?php echo ((isset($id) && ($id !== ""))?($id):''); ?>" />
						<button type="button"  class="btn submit btn-info btn-single pull-center ajax-post"  target-form="form-horizontal"><?php if(!empty($result["id"])): ?>修改<?php else: ?>添加<?php endif; ?></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

			<footer class="main-footer sticky footer-type-1">
				<div class="footer-inner">
					<div class="footer-text">
						&copy; 2015
						<strong>Widuu</strong> </a></a>
					</div>
					<div class="go-up">
						<a href="#" rel="go-top">
							<i class="fa-angle-up"></i>
						</a>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="/public/home/scripts/jquery-form.js"></script>
	<script src="/public/admin/js/bootstrap.min.js"></script>
	<script src="/public/admin/js/TweenMax.min.js"></script>
	<script src="/public/admin/js/resizeable.js"></script>
	<script src="/public/admin/js/joinable.js"></script>
	<script src="/public/admin/js/xenon-api.js"></script>
	<script src="/public/admin/js/xenon-toggles.js"></script>
	<script src="/public/admin/js/xenon-widgets.js"></script>
	<script src="/public/admin/js/devexpress-web-14.1/js/globalize.min.js"></script>
	<script src="/public/admin/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
	<script src="/public/admin/js/toastr/toastr.min.js"></script>
	<script src="/public/admin/js/xenon-custom.js"></script>
	
<link rel="stylesheet" href="/public/js/uploadify/uploadify.css">
<script src="/public/js/uploadify/jquery.uploadify.min.js"></script>
<script src="/public/admin/js/daterangepicker/daterangepicker.js"></script>
<script src="/public/admin/js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript">
 //=======================================================
    var imgarr = [];
    $('.file').on('change',function(e){
       var inp = $(this);
       var up = $(e.currentTarget).parents('li');
        $("#mainForm").ajaxSubmit({
        url : "<?php echo U('app/Release/ajaxUpload');?>", // 请求的url  
        type : "post", // 请求方式  
        dataType : "json", // 响应的数据类型  
        async :true, // 异步  
        success: function (data1) { 
            // alert(data1);
            // $('.uploadImg').empty();
           var ele = "\
            <li class='img'>\
                <img  onclick='remove(this)' src='"+data1+"'>\
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
        console.log($('.imgBox[id='+pid+']').find('.img').length )
        if($('.imgBox[id='+pid+']').find('.img').length < 5){
            $('.imgBox[id='+pid+']').find('.up').show();
        }
    }


      $('.submit').click(function(){
        var len = $('.imgBox li').length
            var count = 0;
	    var target_money = document.getElementById('target_money').value;
	    var title =  document.getElementById('title').value;
	    var summary =  document.getElementById('summary').value;
	    var money_purpose =  document.getElementById('money_purpose').value;
	    var return_money =  document.getElementById('return_money').value;
        var is_top =  $('input[name=is_top]:checked').val();
        var return_content =  document.getElementById('return_content').value;
        var type =  document.getElementById('type').value;
	    var id =  document.getElementById('id').value;
	    var status =   $('input[name=status]:checked').val();

	            var array= [];
	            for(var i = 0; i<len-1;i++){
	    			array.push($('.imgBox li:eq('+i+') img').attr('src'))
	                   // array +=  $('.imgBox li:eq('+i+') img').attr('src')+',';
	            }
	            $.ajax({
	                type:'POST',
	                url :"<?php echo U('Dream/edit');?>",
	                data:{
	                    'array':array,
						'title':title,
						'summary':summary,
						'target_money':target_money,
						'id':id,
						'status':status,
                        'money_purpose':money_purpose,
                        'return_money':return_money,
                        'is_top':is_top,
                        'return_content':return_content,
                        'type':type,
					},
	                success:function(msg){
	                	
	                if(msg == 1){
	                       toastr.success('修改成功')
	                }else{
	                	 toastr.error('失败')
	                }

	            }
	        })
	    })
</script>


</body>
</html>