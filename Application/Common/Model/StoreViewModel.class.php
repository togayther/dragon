<?php
namespace Common\Model;
use Think\Model\ViewModel;

class StoreViewModel extends ViewModel{

	protected $viewFields = array(
			"store"=>array(
					"id",
					"name",
					"address",
					"phone",
					"email",
					"descr",
					"createtime",
					"updatetime",
					"adminid",
					'_type'=>'LEFT'
			),
			"admin"=>array(
					"realname"=>"admin_realname",
					"email"=>"admin_email",
					"phone"=>"admin_phone",
					"lastlogin"=>"admin_lastlogin",
					"id"=>"admin_id",
					"_on"=>"store.adminid = admin.id"

			)
	);
	
	protected $_scope = array(
		"list"=>array(
			"where"=>array(
				'store.deleted' => 0
			),
			"order"=>"createdate desc",
			"field"=>array(
					"id",
					"name",
					"address",
					"phone",
					"email",
					"descr",
					"createtime",
					"updatetime",
					"admin_realname",
					"admin_phone",
					"admin_email",
					"admin_lastlogin",
					"admin_id"
			)	
		),
		"detail"=>array(
			"field"=>array(
					"id",
					"name",
					"address",
					"phone",
					"email",
					"descr",
					"createtime",
					"updatetime",
					"adminid",
					"admin_realname",
					"admin_phone",
					"admin_email",
					"admin_lastlogin",
					"admin_id"
			)
		)
	);
}