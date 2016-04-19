<?php
namespace Common\Model;
use Think\Model\ViewModel;

class LevelViewModel extends ViewModel{
	protected $viewFields = array(
			"level"=>array(
					"id",
					"name",
					"descr",
					"pic",
					"point_begin",
					"point_end",
					"createtime",
					"updatetime",
					'COUNT(user.id)'=>'user_count',
					'_type'=>'LEFT'
			),
			"user"=>array(
					"_on"=>"level.id = user.level"

			)
	);
	protected $_scope = array(
		"list"=>array(
			"where"=>array(
				'deleted' => 0
			),
			"order"=>"point_end desc",
			"group"=>"id",
			"field"=>array(
					"id",
					"name",
					"pic",
					"descr",
					"point_begin",
					"point_end",
					"user_count"
			)	
		),
		"detail"=>array(
			"field"=>array(
					"id",
					"name",
					"descr",
					"pic",
					"point_begin",
					"point_end",
					"creaatime",
					"updatetime",
					"user_count"
			)
		)
	);
}