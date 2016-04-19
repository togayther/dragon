<?php
return array(

	'SHOW_PAGE_TRACE' =>false, 

	//最高等级积分值
	"LEVEL_MAX_POINT"=>20000,

	//加载菜单
	'LOAD_EXT_CONFIG' => 'menu',

	//管理后台Logo文字
	'LOGO_TEXT'=> '蛟途贸易会员积分中心',

	//图片上传保存路径
	'IMAGE_UPLOAD_PATH'=> PUBLIC_PATH."Upload/Image/",

	//资源上传保存路径
	'ATTACH_UPLOAD_PATH'=> PUBLIC_PATH."Upload/Attach/",

	//图片上传扩展名
	'IMAGE_UPLOAD_EXTS' => array('jpg', 'gif', 'png', 'jpeg','bmp'),
		
	//图片上传大小限制
	'IMAGE_UPLOAD_SIZE' => 2048000,
		
	//SESSION键名
	'SESSION_KEY'=>array(
		"ADMIN_INFO"=>"SESSION_ADMIN_INFO"
	)
);