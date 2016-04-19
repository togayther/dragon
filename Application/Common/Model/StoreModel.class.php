<?php
namespace Common\Model;
use Think\Model;

class StoreModel extends Model{
	
	protected $insertFields = array('name','address','phone','email','adminid','descr','createtime');
	
    protected $updateFields = array('id','name','address','phone','email','adminid','descr','updatetime');
	
	//内容都不能留空
	protected $_validate = array(
		array("name","require","门店名称不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("address","require","门店地址不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("phone","require","门店联系电话不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
	);
	
	//填充默认值
	protected $_auto = array(
		array("createtime","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s')),
		array("updatetime","date",self::MODEL_BOTH,"function",array('Y-m-d H:i:s')),
		array('deleted','0')
	);
}