<?php
namespace Common\Model;
use Think\Model;

class AdminModel extends Model{
	
	protected $insertFields = array('name','password','realname','email','phone','gender','birthday','descr');
	
    protected $updateFields = array('id','name','password','realname','email','phone','gender','birthday','descr');
	
	//内容都不能留空
	protected $_validate = array(
		array("name","require","登录用户名不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("password","require","登录密码不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("realname","require","店长姓名不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("phone","require","店长手机号码不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("createdate","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s')),
		array('groupid','2'),
		array('deleted','0'),
		array('enabled','1'),
	);
}