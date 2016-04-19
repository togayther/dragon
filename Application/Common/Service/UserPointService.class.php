<?php
namespace Common\Service;
use Think\Model;

class UserPointService{
	
	private $userPointViewModel = null;
	private $userPointModel = null;
	private $userPointAuditModel = null;
	
	function __construct() {
		
		$this->userPointViewModel = D("UserPointView");
		$this->userPointModel = D("UserPoint");

		$this->userPointAuditModel = D("UserPointAudit");
	}

	//增加待审核积分记录
	public function addPoint(){
		if (!$this->userPointModel->create()){
			return $this->userPointModel->getError();
		}else{
			return $this->userPointModel->add();
		}
	}


	//更新用户字段信息
	public function editPoint($id, $updateData = array()){
		if($id > 0 && count($updateData) > 0){
			$condition["id"] = $id;
			$this->userPointModel->where($condition)->setField($updateData);
		}
	}

	//用户追加积分记录，实时生效
	public function addPointRealtime($userid, $point, $type, $descr = ""){
		$data["userid"] = $userid;
		$data["point"] = $point;
		$data["type"] = $type;
		$data["descr"] = $descr;
		$data["createdate"] = date('Y-m-d H:i:s');
		$data["authmanager"] = 0;
		$data["status"] = 1;
		return $this->userPointModel->add($data);
	}
	
	//积分审核
	public function auditPoint($id, $status , $descr){
		$condition["id"] = $id;
		$data["status"] = $status;
		$this->userPointModel->where($condition)->setField($data);

		$adminInfo = session(C("SESSION_KEY.ADMIN_INFO"));

		$data["pointid"] = $id;
		$data["authmanager"] = $adminInfo["id"];
		$data["authdescr"] = $descr;
		$data["authtime"] = date('Y-m-d H:i:s');
		return $this->userPointAuditModel->add($data);
	}

	//获取待审核积分列表
	public function getAuditList($condition = array()){
		$auditList = $this->getList($condition, "auditlist");
		return $auditList;
	}

	//获取积分列表
	public function getList($condition = array(), $scope = "list"){
		
		if($this->userPointViewModel == null){
			E("post model is undefined");
		}

		$pointList = $this->userPointViewModel
		->scope($scope)
		->where($condition)
		->select();

		return $pointList;
	}
	
	//获取积分记录详情
	public function getDetail($id){
		$pointDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$pointDetail = $this->userPointViewModel->where($condition)->scope("detail")->find();
		}
		
		return $pointDetail;
	}

	//获取今日积分
	public function getTodayPoint($userid){
		$result = 0;
		if ($userid > 0) {
			$condition["userid"] = $userid;
			$condition["status"] = C("POINT_STATUS.GOOD");
			$condition["createdate"] = array(array('gt',date('Y-m-d 00:00:00')),array('lt',date('Y-m-d H:i:s')));

			$result = $this->userPointModel->where($condition)->sum("point");
		}

		return $result;
	}

	//检测用户今日是否已签到
	public function detectSigninStatus($userid){
		$result = false;
		if ($userid > 0) {
			$condition["userid"] = $userid;
			$condition["type"] = "签到赠送";
			$condition["status"] = C("POINT_STATUS.GOOD");
			$condition["createdate"] = array(array('gt',date('Y-m-d 00:00:00')),array('lt',date('Y-m-d H:i:s')));

			$result = $this->userPointModel->where($condition)->find();
			if ($result && !empty($result) && $result['id']>0) {
				$result = true;
			}
		}

		return $result;
	}

	//获取用户积分明细
	//$type = [1,0]=>["收入","支出"]
	public function getPointRecordByType($uid, $type = 1){
		$pointList = null;
		if ($uid > 0) {
			$condition["userid"] = $uid;
			$condition["status"] = C("POINT_STATUS.GOOD");
			if ($type == 1) {
				$condition["point"] = array('gt',0);
			}else{
				$condition["point"] = array('lt',0);
			}

			$pointList = $this->userPointViewModel
			->scope("list")
			->where($condition)
			->select();
		}
		return $pointList;
	}
}