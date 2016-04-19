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
                          <a href="<?php echo U('Admin/detail');?>?id=<?php echo ($adminId); ?>">
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
        <div>
            <ul class="nav nav-tabs" role="tablist">
                <li>
                    <a href="javascript:void(0);">
                    <i class="fa fa-mobile"></i>
                    &nbsp;
                    <?php echo ($auditInfo["user_phone"]); ?>
                    &nbsp;
                    <span class="badge"><?php echo ($auditInfo["point"]); ?>积分</span>
                    </a>
                </li>
                <li class="active">
                    <a href="#shenqing" data-toggle="tab">
                    申请信息
                    </a>
                </li>
                <li>
                    <a href="#shenhe" data-toggle="tab">
                    审核信息
                    </a>
                </li>
                 <li class="pull-right">
                     <a href="javascript:history.go(-1);" 
                        class="tooltip-title" 
                        data-toggle="tooltip" 
                        data-placement="left" 
                        title="返回">
                        <i class="fa fa-mail-reply"></i>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="shenqing">
                    <div class="">
                        <form>
                            <div class="form-group">
                                <label for="">积分值</label>
                                <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["point"]); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">积分类型</label>
                                <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["type"]); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">申请时间</label>
                                <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["createdate"]); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">申请附件</label>
                                <div class="row">
                                 <?php
 $attachs = explodeAttach($auditInfo["attach"], '|'); ?>
                        
                                  <?php if(is_array($attachs)): $i = 0; $__LIST__ = $attachs;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$attach): $mod = ($i % 2 );++$i;?><div class="col-xs-6 col-md-2">
                                        <a href="/qzh/Public/<?php echo ($attach); ?>" class="thumbnail" target="_blank">
                                          <img src="/qzh/Public/<?php echo ($attach); ?>" alt="">
                                        </a>
                                      </div><?php endforeach; endif; else: echo "" ;endif; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    申请门店
                                    <a href="<?php echo U('Admin/detail');?>?id=<?php echo ($auditInfo["store_id"]); ?>"  class="tooltip-title" data-toggle="tooltip" data-placement="right" title="点击查看门店详情">
                                    <i class="fa fa-info-circle"></i>
                                    </a>
                                </label>
                                <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["store_name"]); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">
                                    申请店长
                                    <a href="<?php echo U('Admin/detail');?>?id=<?php echo ($auditInfo["manager_id"]); ?>"  class="tooltip-title" data-toggle="tooltip" data-placement="right" title="点击查看店长详情">
                                    <i class="fa fa-info-circle"></i>
                                    </a>
                                </label>
                                <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["manager_realname"]); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">申请备注</label>
                                <textarea class="form-control" id="" placeholder="" rows="3" disabled><?php echo ($auditInfo["descr"]); ?></textarea>
                            </div>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="shenhe">
                    <div class="padding-lg">
                        <div class="form-group">
                            <label for="">审核人员</label>
                            <input type="text" class="form-control" disabled value="超级管理员">
                        </div>
                        <div class="form-group">
                            <label for="">审核时间</label>
                            <input type="text" class="form-control" disabled value="<?php echo ($auditInfo["audit_time"]); ?>">
                        </div>
                        <div class="form-group">
                            <label for="">审核状态</label>
                            <?php if($auditInfo["audit_status"] == '1' ): ?><input type="text" class="form-control" disabled value="通过">
                            <?php else: ?>
                                <input type="text" class="form-control" disabled value="不通过"><?php endif; ?>
                            
                        </div>
                        <div class="form-group">
                            <label for="">审核备注</label>
                            <textarea class="form-control" id="" placeholder="" rows="3" disabled><?php echo ($auditInfo["audit_descr"]); ?></textarea>
                        </div>
                    </div>
                </div>
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