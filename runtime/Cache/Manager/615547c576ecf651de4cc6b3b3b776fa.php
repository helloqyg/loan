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
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo ($header_title); ?></h3>		
				<div class="panel-options">
				<div class="vertical-top">
				</div>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>用户</th>
									<th>项目名称 <span style="color: red">（点击可进入项目）</span>	</th>
									<th>捐款金额</th>
									<th>捐款类型</th>
									<th>是否匿名</th>
									<th>捐赠时间</th>
									<th class="col-md-2 text-center">
										操作
									</th>
								</tr>
							</thead>
							<tbody>
								<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><tr>
									<td><?php echo get_username($m['user_id']);?></td>
									<td>
										<a style="text-decoration:underline;" href="
										<?php if($m["type"] == 1): echo U('jiuzhu/edit',array('id'=>$m['item_id']));?>
											<?php elseif($m["type"] == 2): echo U('Dream/edit',array('id'=>$m['item_id']));?>
											<?php elseif($m["type"] == 3): echo U('Relaxed/add',array('id'=>$m['item_id']));?>
											<?php else: endif; ?>

										"> <?php echo get_item_name($m['type'],$m['item_id']);?> </a>

										</td>
									<td><?php echo ($m["price"]); ?></td>
									<td>
										<?php if($m["type"] == 1): ?>爱心救助
											<?php elseif($m["type"] == 2): ?>梦想清单
											<?php elseif($m["type"] == 3): ?>轻松公益
											<?php else: endif; ?>
									</td>
									<td>
											<?php if($m["is_anonymous"] == 1): ?>已匿名
											<?php else: ?> 没有<?php endif; ?>
										

									</td>
									<td><?php echo (date('Y-m-d',$m["date"])); ?></td>
									
									
									<td>
										<!-- <a class="btn btn-info" href="<?php echo U('donor/item_detail',array('type'=>$m['type'],'item_id'=>$m['item_id']));?>" role="button">详情</a> -->
										<!-- <a class="btn btn-info" href="<?php echo U('jiuzhu/edit',array('id'=>$m['id']));?>" role="button">修改</a> -->
										<a class="btn btn-warning" href="javascript:void(0);" onClick="del(<?php echo ($m["id"]); ?>)" role="button">删除</a>
									</td>
								</tr><?php endforeach; endif; else: echo "" ;endif; ?>
							</tbody>
						</table>			
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 text-center">
						<ul class="pagination">
							<?php echo ($page); ?>
						</ul>
					</div>
				</div>
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
	
<script type="text/javascript">
function myrefresh(){window.location.reload();}
//删除
function del(aid){
	if (confirm("确认删除吗")) {


	var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-top-full-width",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "2000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
		};
	$.get("<?php echo U('Donor/del');?>", {id:aid},function(data){
		if(data.status == 1){
			toastr.success(data.info, opts);
			setTimeout('myrefresh()',2000);
		}else{
			toastr.error(data.info, opts);
		}

	});
	}
}
</script>


</body>
</html>