<?php
namespace Common\Model;
use Think\Model\ViewModel;

class UserViewModel extends ViewModel{

	protected $viewFields = array(
			"user"=>array(
					"id",
					"phone",
					"avatar",
					"point",
					"name",
					"createdate",
					"level",
					"lastlogin",
					"openid",
					"descr",
					"useragent",
					'_type'=>'LEFT'
			),
			"level"=>array(
					"id"=>"level_id",
					"name"=>"level_name",
					"point_begin"=>"level_point_begin",
					"point_end"=>"level_point_end",
					"descr"=>"level_descr",
					"_on"=>"user.level = level.id"

			)
	);
	
	protected $_scope = array(
		"list"=>array(
			"where"=>array(
				'enabled' => 1
			),
			"order"=>"level desc",
			"field"=>array(
					"id",
					"phone",
					"point",
					"level_id",
					"level_name",
					"lastlogin",
					"descr",
					"createdate"
			)	
		),
		"detail"=>array(
			"field"=>array(
					"id",
					"phone",
					"avatar",
					"point",
					"name",
					"createdate",
					"level_id",
					"level_name",
					"lastlogin",
					"descr",
					"useragent",
					"openid"
			)
		)
	);
}