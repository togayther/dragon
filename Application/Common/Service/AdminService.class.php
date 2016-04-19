<?php
namespace Common\Service;
use Think\Model;

class AdminService{
	
	private $adminViewModel = null;
	private $adminModel = null;
	
	function __construct() {
		
		$this->adminViewModel = D("AdminView");
		$this->adminModel = D("Admin");
	}

	public function login($name, $password){
		if(empty($name) || empty($password)){
			return null;
		}
		
		$condition["name"] = $name;
		$condition["password"] = $password;
		
		$adminInfo = $this->adminViewModel->where($condition)->scope("detail")->find();
		
		if($adminInfo && count($adminInfo)>0){
			$data["lastlogin"] = date("Y-m-d H:i:s");
			$this->adminViewModel->where($condition)->save($data);
		}
		
		return $adminInfo;
	}

	public function editAdmin(){
		if (!$this->adminModel->create()){
			return $this->adminModel->getError();
		}else{
			$this->adminModel->save();
			return true;
		}
	}

	public function addAdmin(){
		if (!$this->adminModel->create()){
			return $this->adminModel->getError();
		}else{
			$this->adminModel->add();
			return true;
		}
	}

	public function getList($condition = array()){
		
		if($this->adminViewModel == null){
			E("post model is undefined");
		}

		$adminList = $this->adminViewModel
		->scope("list")
		->where($condition)
		->select();

		return $adminList;
	}
	
	public function getDetail($id){
		$adminDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$adminDetail = $this->adminViewModel->where($condition)->scope("detail")->find();
		}
		
		return $adminDetail;
	}	
}