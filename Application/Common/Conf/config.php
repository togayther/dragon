<?php
return array(

	//'URL_MODULE_MAP'    =>    array('manage'=>'admin'),

	'LOAD_EXT_CONFIG' => 'user',

	//默认访问模块
	'DEFAULT_MODULE'=>'Home',

	'DEFAULT_CHARSET'=>'utf-8',

	//URL路由模式
	'URL_MODEL'=>2,
		
	//缓存不过期
	'DATA_CACHE_TIME' => 0,
	
	//缓存键前缀
	'DATA_CACHE_PREFIX'=> 'MCMURPHY_',
	
	//数据库类型
	'DB_TYPE'               =>  'mysql',

	//数据库服务器地址
    'DB_HOST'               =>  '127.0.0.1',

	//数据库名称
    'DB_NAME'               =>  'wechat',
		
	//数据库用户名
    'DB_USER'               =>  'root',
		
	//数据库密码
    'DB_PWD'                =>  'fuckpassword@123',
		
	//数据库端口号
    'DB_PORT'               =>  '3306',
		
	//数据库表前缀
    'DB_PREFIX'             =>  'tp_',
	
	//数据库编码
    'DB_CHARSET'            =>  'utf8',


    //站点域名
	"SITE_DOMAIN" => "http://www.jiaotumaoyi.com/wechat/",

    //微信相关配置
	"WECHAT_TOKEN" => "justtestthetoken",
	"WECHAT_APPID" => "wx795865832665dceb",
	"WECHAT_APPSECRET" => "bade414924e72f66217df21970a15324"
);