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
			
    最新活动

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
	
	<?php if(empty($activityList)): ?><div class="data-empty">
          暂无活动信息
        </div>
    <?php else: ?>
    	<?php if(is_array($activityList)): $i = 0; $__LIST__ = $activityList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$activityInfo): $mod = ($i % 2 );++$i; if($activityInfo["istop"] == '1'): ?><div class="activity-header">
					<a href="<?php echo U('activity/detail');?>?id=<?php echo ($activityInfo["id"]); ?>">
						<img src="<?php echo ($activityInfo["pic"]); ?>"/>
					</a>
				</div>
    		<?php else: ?>
    			<?php
 $startDate = convertDateStr($activityInfo["startdate"]); ?>
				<div class="activity-item">
					<a href="<?php echo U('activity/detail');?>?id=<?php echo ($activityInfo["id"]); ?>">
						<div class="activity-img">
							<img src="<?php echo ($activityInfo["pic"]); ?>"/>
						</div>
						<div class="activity-content">
							<h5 class="text-danger"><?php echo ($activityInfo["point"]); ?></h5>
							<p><?php echo ($activityInfo["name"]); ?></p>
							<label><?php echo ($startDate); ?></label>
							<span>
								<i class="iconfont icon-arrow-right"></i>
							</span>
						</div>
					</a>
					<div class="clearfix"></div>
				</div><?php endif; endforeach; endif; else: echo "" ;endif; endif; ?>
</div>

		</div> 
		<script src="/wechat/Public/Home/js/mcmurphy.encrypt.js"></script>  
	</body>
</html>