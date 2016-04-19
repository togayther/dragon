<?php
namespace Common\Service;
use Think\Model;

class UserService{
	
	private $userViewModel = null;
	private $userModel = null;
	private $levelViewModel = null;
	private $userPointService = null;

	function __construct() {
		$this->userViewModel = D("UserView");
		$this->userModel = D("User");
		$this->levelViewModel = D("LevelView");
		$this->userPointService = D("UserPoint","Service");
	}

	//检测手机号码是否已注册
	public function detectPhone($phone){
		$result = false;
		if (!empty($phone)) {
			$condition["phone"] = $phone;
			$userDetail = $this->userViewModel->where($condition)->scope("detail")->find();
			if ($userDetail && $userDetail["id"] > 0) {
				$result = true;
			}
		}
		return $result;
	}

	//新增用户
	public function addUser($userdata = array()){

		//添加用户
		$userid = $this->userModel->add($userdata);
		if ($userid > 0) {
			//新用户初始积分
			$newUserPoint = C("REGISTER_POINT",null,0);
			if ($newUserPoint > 0) {
				$this->userPointService->addPointRealtime($userid, $newUserPoint, "注册赠送");
			}
			//更新用户等级
			$this->updateUserPointAndLevel($userid, $newUserPoint);
		}
		return $userid;
	}

	//更新指定等级所有用户的等级数据
	//等级起始积分变更以后
	public function updateUsersLevel($levelid){
		
		$condition["level"] = $levelid;
		$this->userModel->where($condition)->setField("level", -1);

		$condition["level"] = -1;
		$userList = $this->getList($condition);
		if (count($userList) > 0) {
			foreach($userList as $user){
				$userid = $user["id"];
				$this->updateUserPointAndLevel($userid);
 			}
		}
	}

	//更新指定用户的等级和等级
	//用户积分变更
	public function updateUserPointAndLevel($userid, $point = 0){
		$userInfo  = $this->getDetail($userid);
		$userPoint = $userInfo['point'];
		$userPoint = $userPoint + $point;
		$levelList = $this->levelViewModel
					->scope("list")
					->select();

		$level = -1;

		if (count($levelList) > 0) {
			foreach($levelList as $level){
				$pointBegin = $level['point_begin'];
				$pointEnd = $level['point_end'];
				//最大值不包含
				if (($userPoint >= $pointBegin) && ($userPoint < $pointEnd)) {
					$level = $level["id"];
					break;
				}
 			}
		}

		if ($level > 0) {
			$condition["id"] = $userid;
			$data["level"] = $level;
			$data["point"] = $userPoint;

			$this->userModel->where($condition)->setField($data);
		}
	}

	//获取用户列表
	public function getList($condition = array()){
		if($this->userViewModel == null){
			E("post model is undefined");
		}

		$userList = $this->userViewModel
		->scope("list")
		->where($condition)
		->select();

		return $userList;
	}

	//用户编辑
	public function editUser(){
		if (!$this->userModel->create()){
			return $this->userModel->getError();
		}else{
			$this->userModel->save();
			return true;
		}
	}

	//根据条件查询用户
	public function getUserByCondition($condition){
		$userDetail = null;
		if (count($condition)>0){
			$userDetail = $this->userViewModel->where($condition)->scope("detail")->find();
		}
		return $userDetail;
	}
	
	//获取用户详情
	public function getDetail($id){
		$userDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$userDetail = $this->userViewModel->where($condition)->scope("detail")->find();
		}
		
		return $userDetail;
	}	
}