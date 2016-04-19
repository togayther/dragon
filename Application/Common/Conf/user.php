<?php
return array(

	//注册赠送积分
	'REGISTER_POINT'    =>  800,

	//签到赠送积分
	'SIGNIN_POINT' => 10,

	//积分状态值
	'POINT_STATUS'=>array(
		"NEW" => 0,
		"GOOD" => 1,
		"BAD" => -1
	),

	//积分来源
	'POINT_TYPE' => array(
		"BUY"=>"商品购买",
		"OFFLINE"=>"线下活动",
		"EXCHANGE"=>"积分兑换"
	)
);