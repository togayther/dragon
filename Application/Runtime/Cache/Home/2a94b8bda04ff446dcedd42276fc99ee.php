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
			
    个人中心

        </title>
        <link href="/wechat/Public/Home/css/mcmurphy.min.css?v=1.1.4" rel="stylesheet"/>
        
		

	</head>
	<body>
		<div class="main">
			
    <div class="animated">
        <div class="header">
            <div class="userinfo">
                <div class="point">
                    <p>我的积分</p>
                    <p><?php echo ($userInfo["point"]); ?></p>
                </div>
                <div class="base">
                    <p><?php echo ($userInfo["phone"]); ?></p>
                    <span class="badge"><?php echo ((isset($userInfo["level_name"]) && ($userInfo["level_name"] !== ""))?($userInfo["level_name"]):'普通会员'); ?></span>
                </div>
            </div>
            <div class="navigation">
                <ul>
                    <li>
                        <a href="<?php echo U('record/index');?>?tab=shouru">
                        今日积分&nbsp;<span class="text-danger"><?php echo ($todayPoint); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo U('record/index');?>">
                        积分明细
                        </a>
                    </li>
                </ul>
            </div>
            
            <!--
            <a class="help" href="<?php echo U('index/help');?>">
                <i class="iconfont icon-help"></i>
            </a>
            -->
        </div>
    
        <?php if(!empty($todayActivity)): ?><div class="list-group">
                <?php if(is_array($todayActivity)): $i = 0; $__LIST__ = array_slice($todayActivity,0,1,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$activityInfo): $mod = ($i % 2 );++$i;?><a href="<?php echo U('activity/index');?>" class="list-group-item">
                       <div class="item-pic">
                            <img src="/wechat/Public/home/img/hd.png" class="item-pic"/>
                        </div>
                        <div class="item-content" >
                            <h5 class="list-group-item-heading">
                                <label class="text-danger">
                                    <?php echo ($activityInfo["name"]); ?>
                                </label>
                            </h5>
                            <p class="list-group-item-text">
                                <?php echo ($activityInfo["descr"]); ?>
                            </p>
                        </div>
                        <div class="item-op">
                            <i class="iconfont icon-arrow-right"></i>
                        </div>
                        <div class="clearfix"></div>
                    </a><?php endforeach; endif; else: echo "" ;endif; ?>
            </div><?php endif; ?>

		<div class="container">
	        <div class="row">
	        	<div class="col-xs-6">
	        		<a href="<?php echo U('level/index');?>" class="btn btn-block btn-bordered">
                        <i class="iconfont icon-attention"></i>
                        会员等级制度
                    </a>
	        	</div>
	        	<div class="col-xs-6">
	        		<a href="tel:13540312451" class="btn btn-block btn-bordered">
                        <i class="iconfont icon-mobile"></i>
                        联系我们
                    </a>
	        	</div>
	        </div>
        </div>
    </div>

		</div> 
		<script src="/wechat/Public/Home/js/mcmurphy.encrypt.js"></script>  
	</body>
</html>