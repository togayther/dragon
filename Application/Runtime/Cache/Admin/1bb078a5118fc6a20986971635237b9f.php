<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="HandheldFriendly" content="True"/>
        <meta name="MobileOptimized" content="320"/>
        <meta name="format-detection" content="telephone=no"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no" />
	
		<title>
			原野软件工作室
        </title>

        <!--
        <link rel="stylesheet" type="text/css" href="/qzh/Public/css/mcmurphy.css">  
        -->
        <link href="/qzh/Public/Admin/css/bootstrap.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/animate.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/font-awesome.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/jquery.dataTables.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/dataTables.bootstrap.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/rangeSlider.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/wangEditor.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/jquery.toastr.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/bootstrap-switch.css" rel="stylesheet"/>
        <link href="/qzh/Public/Admin/css/main.css" rel="stylesheet"/>
        
		

		
		<script>
			document.onreadystatechange = onloadCompleted;
			function onloadCompleted()
			{
			 	if(document.readyState == "complete")
			    {
			    	var preloader = document.getElementById("preloader");
			    	if (preloader) {
			    		var timer = setTimeout(function() {
		                    preloader.style.display = "none";
		                    clearTimeout(timer);
		                }, 500);
			    	};
			    }
			}
		</script>
		<!--[if lt IE 9]>
	      <script src="/qzh/Public/Admin/js/html5shiv.js"></script>
	      <script src="/qzh/Public/Admin/js/respond.min.js"></script>
	    <![endif]-->
		<!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
	</head>
	<body>
		<div id="preloader">
	        <span></span>
	    </div>

	    <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a href="<?php echo U('Index/index');?>" class="navbar-brand">
                <?php echo (C("LOGO_TEXT")); ?>
            </a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <?php if(is_array($adminMenu)): $i = 0; $__LIST__ = $adminMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i; if(count($menu['SUBS']) > 0 ): ?><li class="dropdown">
                            <?php if(count($menu['SUBS']) == 0): ?><a href="<?php echo ($menu['URL']); ?>"> 
                                    <?php if($menu['ICON'] != ''): ?><i class="fa <?php echo ($menu['ICON']); ?> fa-fw"></i><?php endif; ?> 
                                    <?php echo ($menu['NAME']); ?>
                                </a>
                            <?php else: ?>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <?php if($menu['ICON'] != ''): ?><i class="fa <?php echo ($menu['ICON']); ?> fa-fw"></i><?php endif; ?> 
                                    <?php echo ($menu['NAME']); ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if(is_array($menu['SUBS'])): foreach($menu['SUBS'] as $key=>$submenu): ?><li>
                                            <a href="<?php echo ($submenu['URL']); ?>"> 
                                                <?php if($menu['ICON'] != ''): ?><i class="fa <?php echo ($menu['ICON']); ?> fa-fw"></i><?php endif; ?> 
                                                <?php echo ($submenu['NAME']); ?>
                                            </a>
                                        </li><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
                        </li>
                    <?php else: ?> 
                        <li>
                            <a href="<?php echo ($menu['URL']); ?>">
                                <?php if($menu['ICON'] != ''): ?><i class="fa <?php echo ($menu['ICON']); ?> fa-fw"></i><?php endif; ?> 
                                <?php echo ($menu['NAME']); ?>
                            </a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                      <?php echo ($adminRealName); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="download">
                        <li>
                          <a href="<?php echo U('Admin/detail');?>">
                            个人信息
                          </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                          <a href="<?php echo U('Auth/logout');?>">
                            注销
                          </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

		<div class="container">
			<div class="main">
			    <div class="row">
					

<div class="col-xs-12">
	
<div class="animated fadeInUp">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="text-danger">
                <i class="fa fa-home"></i>&nbsp;门店新增
                <div class="pull-right">
    <a href="javascript:history.go(-1);" class="tooltip-title" data-toggle="tooltip" data-placement="left" title="返回">
    <i class="fa fa-mail-reply"></i>
    </a>
</div>
            </h4>
        </div>
        <div class="panel-body">
            <form data-validation="true" method="POST" action="<?php echo U('Store/add');?>"> 
                <?php if($error != ''): ?><div class="alert alert-danger">
                        <?php echo ($error); ?>
                    </div><?php endif; ?>
                <div class="form-group">
                    <label for="">门店名称</label>
                    <input type="text" check-type="required" required-message="请输入门店名称" value="<?php echo ($storeInfo["name"]); ?>" class="form-control" id="name" name="name" placeholder="请输入门店名称...">
                </div>
                <div class="form-group">
                    <label for="">门店地址</label>
                    <input type="text" check-type="required" required-message="请输入门店地址" value="<?php echo ($storeInfo["address"]); ?>" class="form-control" id="address" name="address" placeholder="请输入门店地址...">
                </div>
                <div class="form-group">
                    <label for="">门店电话</label>
                    <input type="text" check-type="required" required-message="请输入门店电话" value="<?php echo ($storeInfo["phone"]); ?>" class="form-control" id="phone" name="phone" placeholder="请输入门店电话...">
                </div>
                <div class="form-group">
                    <label for="">店长名称</label>
                    
                    <?php if(empty($adminList)): ?><div class="text-danger">
                            店长列表为空，请添加店长信息
                        </div>
                    <?php else: ?> 
                        <select name="adminid" id="adminid" class="form-control" 
                            data-change-target="#admin_phone" 
                            data-change-value="phone">
                            <option value="-1">— 请选择 —</option>
                            <?php if(is_array($adminList)): $i = 0; $__LIST__ = $adminList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$admin): $mod = ($i % 2 );++$i; if($admin["id"] == $storeInfo['adminid']): ?><option value="<?php echo ($admin["id"]); ?>" data-phone="<?php echo ($admin["phone"]); ?>" selected>
                                <?php else: ?>
                                    <option value="<?php echo ($admin["id"]); ?>" data-phone="<?php echo ($admin["phone"]); ?>"><?php endif; ?>
                                    <?php echo ($admin["realname"]); ?> - <?php echo ((isset($admin["store_name"]) && ($admin["store_name"] !== ""))?($admin["store_name"]):'未关联门店'); ?>
                                </option><?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                        <span class="help-block">
                            注：选择已关联门店的店长，将会解除该店长与原有门店的关联。
                        </span><?php endif; ?> 
                </div>
                <div class="form-group">
                    <label for="">店长电话</label>
                    <input type="text" id="admin_phone" value="" disabled class="form-control" placeholder="">
                </div>
                <div class="form-group">
                    <label for="">备注信息</label>
                    <textarea class="form-control" id="descr" name="descr" placeholder="请输入门店备注信息..." rows="3"></textarea>
                </div>
				

                <button type="submit" class="btn btn-success btn-submit">提交</button>
            </form>
        </div>
    </div>
</div>

</div>

			    </div>
		    </div>
		</div>

		<script src="/qzh/Public/Admin/js/jquery.min.js"></script>  
		<script src="/qzh/Public/Admin/js/bootstrap.js"></script> 
		<script src="/qzh/Public/Admin/js/jquery.dataTables.min.js"></script>
		<script src="/qzh/Public/Admin/js/dataTables.bootstrap.min.js"></script> 
		<script src="/qzh/Public/Admin/js/jquery.scrollUp.min.js"></script>
		<script src="/qzh/Public/Admin/js/moment.js"></script>  
		<script src="/qzh/Public/Admin/js/rangeSlider.js"></script> 
		<script src="/qzh/Public/Admin/js/wangEditor.js"></script> 
		<script src="/qzh/Public/Admin/js/spin.js"></script> 
		<script src="/qzh/Public/Admin/js/jquery.toastr.js"></script> 
		<script src="/qzh/Public/Admin/js/bootstrap-switch.js"></script>  
		<script src="/qzh/Public/Admin/js/bootstrap3-validation.js"></script>   
		<script src="/qzh/Public/Admin/js/jquery.lazyload.min.js"></script>    
        

        <script src="/qzh/Public/Admin/js/main.js?v=2.0"></script> 
	</body>
</html>