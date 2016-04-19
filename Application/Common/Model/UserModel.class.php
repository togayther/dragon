<?php
namespace Common\Model;
use Think\Model;

class UserModel extends Model{

	protected $insertFields = array('phone','point','avatar','name','createdate','lastlogin','openid','level','descr','useragent');
	
    protected $updateFields = array('id','phone','point','avatar','name','createdate','lastlogin','openid','level','descr','useragent');

    //内容都不能留空
	protected $_validate = array(
		array("phone","require","手机号码不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH),
		array("openid","require","微信信息不能为空",self::MUST_VALIDATE,"regex",self::MODEL_BOTH)
	);
	
	//新增的时候填充默认值
	protected $_auto = array(
		array("createdate","date",self::MODEL_INSERT,"function",array('Y-m-d H:i:s')),
		array('enabled',1),
		array('level',1),
		array('point',0)
	);
}