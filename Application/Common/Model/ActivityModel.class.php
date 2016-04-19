<?php
namespace Common\Model;
use Think\Model;

class ActivityModel extends Model{
	
	protected $insertFields = array(
		'name',
		'descr',
		'pic',
		'createdate',
		'startdate',
		'istop',
		'enddate',
		'content',
		'point',
		'storeid'
	);
	
    protected $updateFields = array(
    	'id',
		'name',
		'descr',
		'pic',
		'point',
		'istop',
		'startdate',
		'enddate',
		'content',
		'point',
		'storeid'
    );
	
	//内容都不能留空
	protected $_validate = array(
		array("name","require","活动名称不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("startdate","require","开始时间不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("enddate","require","结束时间不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("content","require","活动详情不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("createdate","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s'))
	);
}