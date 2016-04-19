<?php
namespace Common\Model;
use Think\Model\ViewModel;

class AdminViewModel extends ViewModel{

	protected $viewFields = array(
			"admin"=>array(
					"id",
					"name",
					"password",
					"phone",
					"email",
					"birthday",
					"gender",
					"realname",
					"groupid",
					"lastlogin",
					"descr",
					'_type'=>'LEFT'
			),
			"store"=>array(
					"name"=>"store_name",
					"address"=>"store_address",
					"phone"=>"store_phone",
					"email"=>"store_email",
					"id"=>"store_id",
					"_on"=>"admin.storeid = store.id"

			)
	);
	
	protected $_scope = array(
		"list"=>array(
			"where"=>array(
				'enabled' => 1,
				'groupid' => 2
			),
			"order"=>"lastlogin desc",
			"field"=>array(
					"id",
					"name",
					"phone",
					"email",
					"birthday",
					"gender",
					"realname",
					"lastlogin",
					"descr",
					"store_id",
					"store_name"
			)	
		),
		"detail"=>array(
			"field"=>array(
					"id",
					"name",
					"password",
					"phone",
					"email",
					"birthday",
					"gender",
					"realname",
					"groupid",
					"lastlogin",
					"descr",
					"store_id",
					"store_name",
					"store_address",
					"store_phone",
					"store_email"
			)
		)
	);
}