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
			
    等级规则

        </title>
        <link href="/wechat/Public/Home/css/mcmurphy.min.css?v=1.1.4" rel="stylesheet"/>
        
		

	</head>
	<body>
		<div class="main">
			
<div class="animated">

    <?php if(empty($levelList)): ?><div class="data-empty">
          暂无等级信息
        </div>
    <?php else: ?> 
        <?php if(is_array($levelList)): $i = 0; $__LIST__ = $levelList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$levelInfo): $mod = ($i % 2 );++$i;?><div class="well well-level">
                <div class="well-pic">
                    <img src="<?php echo ($levelInfo["pic"]); ?>" alt="">
                </div>
                <div class="well-content">
                    <h6 class="title">
                        <?php echo ($levelInfo["name"]); ?>
                    </h6>
                    <p class="point">
                        积分要求：<span class="text-danger"><?php echo ($levelInfo["point_begin"]); ?></span>
                    </p>
                    <p class="descr">
                        特权：<?php echo ($levelInfo["descr"]); ?>
                    </p>
                </div>
                <div class="clearfix"></div>
            </div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
</div>

		</div> 
		<script src="/wechat/Public/Home/js/mcmurphy.encrypt.js"></script>  
	</body>
</html>