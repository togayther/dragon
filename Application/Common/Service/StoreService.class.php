<?php
namespace Common\Service;
use Think\Model;

class StoreService{
	
	private $storeViewModel = null;
	private $storeModel = null;
	private $adminModel = null;
	
	function __construct() {
		
		$this->storeViewModel = D("StoreView");
		$this->storeModel = D("Store");
		$this->adminModel = D("Admin");
	}

	private function relieveStore($adminid = 0){
		if ($adminid != 0) {
			$condition["adminid"] = $adminid;
			$this->storeModel->where($condition)->setField('adminid','-1');
		}
	}

	private function relieveAdmin($adminid = 0, $storeid=-1){
			$condition["id"] = $adminid;
			$this->adminModel->where($condition)->setField('storeid', $storeid);
	}

	public function editStore(){
		if (!$this->storeModel->create()){
			return $this->storeModel->getError();
		}else{
			$adminid = I("post.adminid");
			$this->relieveStore($adminid);

			$this->storeModel->save();

			$storeid = I("post.id");
			$this->relieveAdmin($adminid, $storeid);

			return true;
		}
	}

	public function addStore(){
		if (!$this->storeModel->create()){
			return $this->storeModel->getError();
		}else{
			$adminid = I("post.adminid");
			$this->relieveStore($adminid);
			
			$storeid = $this->storeModel->add();

			$this->relieveAdmin($adminid, $storeid);
			return true;
		}
	}

	public function getList($condition = array()){
		
		if($this->storeViewModel == null){
			E("post model is undefined");
		}

		$storeList = $this->storeViewModel
		->scope("list")
		->where($condition)
		->select();

		return $storeList;
	}
	
	public function getDetail($id){
		$storeDetail = null;
		
		if ($id>0){
			$condition["id"] = $id;
			$storeDetail = $this->storeViewModel->where($condition)->scope("detail")->find();
		}
		
		return $storeDetail;
	}	
}