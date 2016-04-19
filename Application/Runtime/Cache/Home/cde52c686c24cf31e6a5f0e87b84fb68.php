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
			
积分明细

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
    <ul class="nav nav-tabs" role="tablist">
        <li class="active">
            <a href="#income" data-toggle="tab">
            收入明细
            </a>
        </li>
        <li>
            <a href="#consume" data-toggle="tab">
            兑换记录
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="income">
            <?php if(empty($incomePointList)): ?><div class="data-empty">
                  暂无收入记录
                </div>
            <?php else: ?>    
                <ul class="list-group record-list">
                    <?php if(is_array($incomePointList)): $i = 0; $__LIST__ = $incomePointList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$incomePoint): $mod = ($i % 2 );++$i;?><li class="list-group-item">
                            <h5>
                                <?php echo ($incomePoint["type"]); ?>
                            </h5>
                            <label class="text-danger">
                                +<?php echo ($incomePoint["point"]); ?>
                            </label>
                            <span>
                                <?php echo ($incomePoint["createdate"]); ?>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endif; ?>
        </div>
         <div class="tab-pane" id="consume">
            <?php if(empty($comsumePointList)): ?><div class="data-empty">
                  暂无兑换记录
                </div>
            <?php else: ?>    
                <ul class="list-group record-list">
                    <?php if(is_array($comsumePointList)): $i = 0; $__LIST__ = $comsumePointList;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$consumePoint): $mod = ($i % 2 );++$i;?><li class="list-group-item">
                            <h5>
                                <?php echo ($consumePoint["type"]); ?>
                            </h5>
                            <label class="text-danger">
                                <?php echo ($consumePoint["point"]); ?>
                            </label>
                            <span>
                                <?php echo ($consumePoint["createdate"]); ?>
                            </span>
                        </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul><?php endif; ?>
        </div>
    </div>
</div>

		</div> 
		<script src="/wechat/Public/Home/js/mcmurphy.encrypt.js"></script>  
	</body>
</html>