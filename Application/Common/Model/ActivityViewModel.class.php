<?php
namespace Common\Model;
use Think\Model\ViewModel;

class ActivityViewModel extends ViewModel{

	protected $viewFields = array(
			"activity"=>array(
					"id",
					"name",
					"descr",
					'istop',
					"createdate",
					"startdate",
					"enddate",
					"point",
					"content",
					"pic",
					"storeid",
					'_type'=>'LEFT'
			),
			"store"=>array(
					"name"=>"store_name",
					"address"=>"store_address",
					"phone"=>"store_phone",
					"email"=>"store_email",
					"id"=>"store_id",
					"_on"=>"activity.storeid = store.id",
					'_type'=>'LEFT'

			),
			"admin"=>array(
					"id"=>"store_admin_id",
					"name"=>"store_admin_name",
					"realname"=>"store_admin_realname",
					"phone"=>"store_admin_phone",
					"lastlogin"=>"store_admin_lastlogin",
					"_on"=>"store.adminid = admin.id"
			)
	);
	
	protected $_scope = array(
		"list"=>array(
			"order"=>"istop desc, createdate desc",
			"field"=>array(
					"id",
					"name",
					"point",
					"createdate",
					"startdate",
					"enddate",
					"descr",
					'istop',
					"pic",
					"storeid",
					"store_name",
					"store_phone",
					"store_address",
					"store_admin_id",
					"store_admin_realname",
					"store_admin_phone",
					"store_admin_lastlogin"
			)	
		),
		"detail"=>array(
			"field"=>array(
					"id",
					"name",
					"point",
					"createdate",
					"startdate",
					"enddate",
					"descr",
					"content",
					"pic",
					'istop',
					"storeid",
					"store_name",
					"store_phone",
					"store_address",
					"store_admin_id",
					"store_admin_realname",
					"store_admin_phone",
					"store_admin_lastlogin"
			)
		)
	);
}