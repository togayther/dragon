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
  
<div class="animated fadeInUp">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="text-danger">
                <i class="fa fa-tag"></i>&nbsp;活动详情
                </a>
                <div class="pull-right">
    <a href="javascript:history.go(-1);" class="tooltip-title" data-toggle="tooltip" data-placement="left" title="返回">
    <i class="fa fa-mail-reply"></i>
    </a>
</div>
            </h4>
        </div>
        <div class="panel-body">
             <form data-validation="true" method="POST" action="<?php echo U('Activity/detail');?>">
                <?php if($error != ''): ?><div class="alert alert-danger">
                        <?php echo ($error); ?>
                    </div><?php endif; ?>
                <input type="hidden" id="id" name="id" value="<?php echo ($activityInfo["id"]); ?>"/>
                <div class="form-group">
                    <label for="">活动名称</label>
                    <input maxlength="30" type="text" check-type="required" required-message="请输入活动名称" value="<?php echo ($activityInfo["name"]); ?>" class="form-control" id="name" name="name" placeholder="请输入活动名称...">
                </div>
                <div class="form-group">
                    <label for="">活动门店</label>
                    <select name="storeid" id="storeid" class="form-control">
                      <option value="-1">所有门店</option>
                      <?php if(is_array($storeList)): $i = 0; $__LIST__ = $storeList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$store): $mod = ($i % 2 );++$i; if($store["id"] == $activityInfo['storeid']): ?><option value="<?php echo ($store["id"]); ?>" selected>
                          <?php else: ?>
                              <option value="<?php echo ($store["id"]); ?>"><?php endif; ?>
                              <?php echo ($store["name"]); ?>
                          </option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                    <p class="help-block">注：活动将在指定的门店开展</p>
                </div>
                <div class="form-group">
                    <label for="">积分要求</label>
                     <div class="list-group-item">
                        <div class="rangeSelector" id="point-selector"
                          data-type="single"
                          data-disable="false" 
                          data-max="<?php echo (C("LEVEL_MAX_POINT")); ?>"
                          data-min="-0"
                          data-step="10"
                          data-grid="true"
                          data-postfix="分"
                          data-from="<?php echo ((isset($activityInfo["point"]) && ($activityInfo["point"] !== ""))?($activityInfo["point"]):0); ?>"></div>
                     </div>
                     <p class="help-block">注：积分大小此值的用户方可参与此活动</p>
                     <input type="hidden" value="<?php echo ((isset($activityInfo["point"]) && ($activityInfo["point"] !== ""))?($activityInfo["point"]):0); ?>" id="point-selector-from" name="point">
                </div>
                <div class="form-group">
                    <label for="">活动时间</label>
                    <div class="list-group-item">
                      <div class="dateRangeSelector" id="date-selector"
                        data-active = "1"
                        data-fromVal="<?php echo ($activityInfo["startdate"]); ?>"  
                        data-toVal="<?php echo ($activityInfo["enddate"]); ?>">
                      </div>
                    </div>
                    <p class="help-block">注：活动将在选择的时间范围内开展</p>
                    <input type="hidden" value="<?php echo ($activityInfo["startdate"]); ?>" id="date-selector-from" name="startdate">
                    <input type="hidden" value="<?php echo ($activityInfo["enddate"]); ?>" id="date-selector-to" name="enddate">
                </div>
                <div class="form-group">
                    <label for="">
                      活动头图&nbsp;
                      <a href="<?php echo U('Image/index');?>" target="_blank" class="text-danger">
                        <i class="fa fa-arrow-circle-right"></i>&nbsp;点击进入图片上传服务
                      </a>
                    </label>
                    <input type="text" class="form-control" value="<?php echo ($activityInfo["pic"]); ?>" id="pic" name="pic">
                    <p class="help-block">
                      注：请粘贴网络图片地址。此头图将在前端进行展示，推荐宽高：720*320
                    </p>
                </div>
                <div class="form-group">
                    <label for="">详细说明</label>
                    <textarea class="form-control richEditor" style="height:200px;" id="content" name="content">
                    <?php echo ($activityInfo["content"]); ?>
                    </textarea>
                    <p class="help-block">
                      注：详细说明将在前端进行展示，用于向用户说明活动的详细情况
                    </p>
                </div>
                <div class="form-group">
                    <label for="">备注信息</label>
                    <textarea class="form-control" id="descr" name="descr" placeholder="请输入备注信息" rows="3"><?php echo ($activityInfo["descr"]); ?></textarea>
                </div>
                <div class="form-group">
                   <?php if($activityInfo["istop"] == '1' ): ?><input type="checkbox" id="istop"  checked/>
                    <?php else: ?>
                       <input type="checkbox" id="istop"><?php endif; ?>
                    <input type="hidden" name="istop" value="<?php echo ($activityInfo["istop"]); ?>">
                    
                    <label for="istop">是否置顶</label>
                    <p class="help-block">
                      注：置顶活动将始终在列表顶部显示
                    </p>
                </div>
                <button type="submit" class="btn btn-success">修改</button>
            </form>
        </div>
    </div>
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