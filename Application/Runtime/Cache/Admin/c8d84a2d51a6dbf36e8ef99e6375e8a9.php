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
			<?php echo (C("LOGO_TEXT")); ?>
        </title>

        <link rel="stylesheet" type="text/css" href="/wechat/Public/Admin/css/mcmurphy.min.css">  
        
		

		
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
	      <script src="/wechat/Public/Admin/js/html5shiv.js"></script>
	      <script src="/wechat/Public/Admin/js/respond.min.js"></script>
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
                <?php if($session_admin["store_name"] != ''): ?><li>
                        <a href="<?php echo U('Store/detail_store');?>?id=<?php echo ($session_admin["id"]); ?>">
                            <?php echo ($session_admin["store_name"]); ?>
                        </a>
                    </li><?php endif; ?>
                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">
                      <?php echo ($session_admin["realname"]); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" aria-labelledby="download">
                        <li>
                          <a href="<?php echo U('Admin/detail');?>?id=<?php echo ($session_admin["id"]); ?>">
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
  <div class="well well-sm">
       <div class="row">
         <div class="col-xs-10">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="关键字搜索..." id="txt-search">
              <span class="input-group-addon" id="btn-search">
                <i class="fa fa-search"></i>
              </span>
           </div>
        </div>
        <div class="col-xs-2">
            <div class="text-right">
               <a href="<?php echo U('Activity/add');?>" class="btn btn-sm btn-primary">
                 新增
               </a>
            </div>
        </div>
       </div>
  </div>
</div>


<div class="col-xs-12">
    <div class="animated fadeInUp">
        <?php if(is_array($activityList)): $i = 0; $__LIST__ = $activityList;if( count($__LIST__)==0 ) : echo "暂无活动信息" ;else: foreach($__LIST__ as $key=>$activity): $mod = ($i % 2 );++$i;?><div class="list-group">
              <div class="list-group-item title">
                <span class="text-primary">
                  <i class="fa fa-tag"></i>
                  <?php echo ($activity["name"]); ?>
                </span>
                <a href="<?php echo U('Activity/detail');?>?id=<?php echo ($activity["id"]); ?>" 
	class="pull-right tooltip-title" 
	data-toggle="tooltip" 
	data-placement="left" 
	title="点击查看详情">
	
	<i class="fa fa-external-link"></i>
	
</a>
              </div>
              <div class="list-group-item">
                <div class="dateRangeSelector" 
                  data-fromVal="<?php echo ($activity["startdate"]); ?>"
                  data-toVal="<?php echo ($activity["enddate"]); ?>"></div>
              </div>
              <div class="list-group-item">
                  活动门店：
                  <?php if($activity["store_name"] == '' ): ?><span>所有门店</span>
                  <?php else: ?>
                    <a class="text-danger" href="<?php echo U('Store/detail');?>?id=<?php echo ($activity["storeid"]); ?>">
                      <?php echo ($activity["store_name"]); ?>
                    </a><?php endif; ?>
              </div>
              <div class="list-group-item">
                  店长信息：
                  <?php if($activity["store_admin_realname"] == '' ): ?><span>无</span>
                  <?php else: ?>
                    <a class="text-danger tooltip-title" href="<?php echo U('Admin/detail');?>?id=<?php echo ($activity["store_admin_id"]); ?>" data-toggle="tooltip" data-placement="right" title="<?php echo ($activity["store_admin_phone"]); ?>">
                      <?php echo ($activity["store_admin_realname"]); ?>
                    </a><?php endif; ?>
              </div>
            </div><?php endforeach; endif; else: echo "暂无活动信息" ;endif; ?>
    </div>
</div>

			    </div>
		    </div>
		</div>

		<div class="footer">
			<div class="container">
				<p class="text-muted pull-left">
					原野软件工作室&nbsp;
					353066897
				</p>
			</div>
		</div>

        <script src="/wechat/Public/Admin/js/mcmurphy.min.js?v=2.0"></script>   

        

	</body>
</html>