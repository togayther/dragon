<?php
namespace Common\Model;
use Think\Model;

class UserPointModel extends Model{
	
	protected $insertFields = array('userid','point','type','descr','manager','attach','createdate','status');
	
    protected $updateFields =  array('id','point','type','descr', 'attach', 'status');
	
	//内容都不能留空
	protected $_validate = array(
		array("userid","require","用户不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("point","require","积分值不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("createdate","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s'))
	);
}