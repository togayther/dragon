<?php
namespace Common\Model;
use Think\Model;

class LevelModel extends Model{

	protected $insertFields = array('name','descr', 'pic', 'point_begin','point_end','createtime','updatetime');
	
    protected $updateFields = array('id','name','descr','pic', 'point_begin','point_end','createtime','updatetime');

    //内容都不能留空
	protected $_validate = array(
		array("name","require","等级名称不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("point_begin","require","起始积分不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("pic","require","等级图标不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("point_end","require","终止积分不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("createtime","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s')),
		array("updatetime","date",self::MODEL_BOTH,"function",array('Y-m-d H:i:s')),
		array('deleted','0')
	);
}