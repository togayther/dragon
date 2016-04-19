<?php
namespace Common\Model;
use Think\Model\ViewModel;

class UserPointViewModel extends ViewModel{

	protected $viewFields = array(
			"user_point"=>array(
					"id",
					"point",
					"userid",
					'type',
					"descr",
					"attach",
					"createdate",
					"status",
					'_type'=>'LEFT'
			),
			"user"=>array(
					"phone"=>"user_phone",
					"openid"=>"user_openid",
					"point"=>"user_point",
					"descr"=>"user_descr",
					"levelid"=>"user_level",
					"lastlogin"=>"user_lastlogin",
					"createdate"=>"user_createdate",
					"_on"=>"user_point.userid = user.id",
					'_type'=>'LEFT'
			),
			'level'=>array(
				"id"=>"user_level_id",
				"name"=>"user_level_name",
				"_on"=>"user.level = level.id",
				'_type'=>'LEFT'
			),
			'admin'=>array(
				"id"=>"manager_id",
				"realname"=>"manager_realname",
				"phone"=>"manager_phone",
				"_on"=>"admin.id = user_point.manager",
				'_type'=>'LEFT'
			),
			'store'=>array(
				"id"=>"store_id",
				"name"=>"store_name",
				"address"=>"store_address",
				"_on"=>"admin.storeid = store.id",
				'_type'=>'LEFT'
			),
			'user_point_audit'=>array(
				"id"=>"audit_id",
				"authmanager"=>"audit_manager",
				"authdescr"=>"audit_descr",
				"authtime"=>"audit_time",
				"status"=>"audit_status",
				"_on"=>"user_point_audit.pointid = user_point.id"
			),
	);
	
	protected $_scope = array(
		"list"=>array(
			"where"=>array(
				'status' => 1 //已通过审核
			),
			"order"=>"createdate desc",
			"field"=>array(
				"id",
				'type',
				"point",
				"userid",
				"descr",
				"attach",
				"createdate",
				"user_phone",
				"user_point",
				"user_descr",
				"user_level_id",
				"user_level_name",
				"manager_id",
				"manager_realname",
				"manager_phone",
				"store_id",
				"store_name",
				"store_address"
			)	
		),
		"auditlist"=>array(
			"where"=>array(
				'status' => 0 //待审核
			),
			"order"=>"createdate desc",
			"field"=>array(
				"id",
				'type',
				"point",
				"userid",
				"descr",
				"attach",
				"createdate",
				"user_phone",
				"user_point",
				"user_descr",
				"user_level_id",
				"user_level_name",
				"manager_id",
				"manager_realname",
				"manager_phone",
				"store_id",
				"store_name",
				"store_address"
			)	
		),
		"detail"=>array(
			"field"=>array(
				"id",
				'type',
				"point",
				"userid",
				"descr",
				"attach",
				"createdate",
				"user_phone",
				"user_point",
				"user_descr",
				"user_lastlogin",
				"user_createdate",
				"user_openid",

				"user_level_id",
				"user_level_name",
				"manager_id",
				"manager_realname",
				"manager_phone",
				"store_id",
				"store_name",
				"store_address",

				"audit_id",
				"audit_manager",
				"audit_descr",
				"audit_time",
				"audit_status"
			)
		)
	);
}