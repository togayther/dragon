<?php
namespace Common\Service;
use Think\Model;

class ActivityService{
	
	private $activityViewModel = null;
	private $activityModel = null;
	
	function __construct() {
		
		$this->activityViewModel = D("ActivityView");
		$this->activityModel = D("Activity");
	}

	public function editActivity(){
		if (!$this->activityModel->create()){
			return $this->activityModel->getError();
		}else{
			$this->activityModel->save();
			return true;
		}
	}

	public function addActivity(){
		if (!$this->activityModel->create()){
			return $this->activityModel->getError();
		}else{
			$this->activityModel->add();
			return true;
		}
	}

	public function getList($condition = array()){
		
		if($this->activityViewModel == null){
			E("post model is undefined");
		}

		$activityList = $this->activityViewModel
		->scope("list")
		->where($condition)
		->select();

		return $activityList;
	}

	public function getStoreActivity($storeid){
		$activityList = null;
		if ($storeid > 0) {
			if($this->activityViewModel == null){
				E("post model is undefined");
			}

			$activityList = $this->activityViewModel
			->scope("list")
			->where("activity.storeid = -1 or activity.storeid = ".$storeid)
			->select();
		}
		return $activityList;
	}

	public function getCurrentActivity(){
		if($this->activityViewModel == null){
			E("post model is undefined");
		}

		$condition["startdate"] = array('lt',date('Y-m-d H:i:s'));
		$condition["enddate"] = array('gt',date('Y-m-d H:i:s'));

		$activityList = $this->activityViewModel
		->scope("list")
		->where($condition)
		->select();

		return $activityList;
	}
	
	public function getDetail($id){
		$activityDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$activityDetail = $this->activityViewModel->where($condition)->scope("detail")->find();
		}
		
		return $activityDetail;
	}	
}