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
			
    活动详情

        </title>
        <link href="/wechat/Public/Home/css/mcmurphy.min.css?v=1.1.4" rel="stylesheet"/>
        
		
	<style type="text/css">
		body{
			background-color: #fff;
		}
	</style>

	</head>
	<body>
		<div class="main">
			
<div class="animated">

    <?php if(empty($activityInfo)): ?><div class="data-empty">
          暂无活动信息
        </div>
    <?php else: ?>
        <div class="well well-activity">
            <h5>
              <?php echo ($activityInfo["name"]); ?>
            </h5>
            <p>
               <?php echo (html_entity_decode($activityInfo["content"])); ?>
            </p>
        </div><?php endif; ?>
</div>

		</div> 
		<script src="/wechat/Public/Home/js/mcmurphy.encrypt.js"></script>  
	</body>
</html>