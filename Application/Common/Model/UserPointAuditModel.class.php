<?php
namespace Common\Model;
use Think\Model;

class UserPointAuditModel extends Model{
	
	protected $insertFields = array('pointid','authmanager','authtime','authdescr','status');
	
    protected $updateFields = array('id','pointid','authmanager','authtime','authdescr','status');
	
	//内容都不能留空
	protected $_validate = array(
		array("pointid","require","积分申请不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("status","require","审核状态不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("authmanager","require","审核人员不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("authtime","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s'))
	);
}