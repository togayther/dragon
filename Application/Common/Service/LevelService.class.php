<?php
namespace Common\Service;
use Think\Model;

class LevelService{
	
	private $levelViewModel = null;
	private $levelModel = null;
	private $userService = null;

	function __construct() {
		$this->levelViewModel = D("LevelView");
		$this->levelModel = D("Level");
		$this->userService = D("User","Service");
	}

	public function editLevel(){
		if (!$this->levelModel->create()){
			return $this->levelModel->getError();
		}else{

			$levelId = I("post.id");

			$this->levelModel->save();

			$this->userService->updateUsersLevel($levelId);

			return true;
		}
	}

	public function addLevel(){
		if (!$this->levelModel->create()){
			return $this->levelModel->getError();
		}else{
			$levelid = $this->levelModel->add();
			return true;
		}
	}

	public function getList($condition = array()){
		
		if($this->levelViewModel == null){
			E("post model is undefined");
		}

		$levelList = $this->levelViewModel
		->scope("list")
		->where($condition)
		->select();

		return $levelList;
	}
	
	public function getDetail($id){
		$levelDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$levelDetail = $this->levelViewModel->where($condition)->scope("detail")->find();
		}
		
		return $levelDetail;
	}	
}