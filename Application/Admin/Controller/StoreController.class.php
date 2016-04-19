<?php
namespace Admin\Controller;
use Think\Controller;
class StoreController extends BaseController {
	private $storeService = null;
    private $adminService = null;
	
	function __construct() {
		parent::__construct();
		$this->storeService = D("Store","Service");
        $this->adminService = D("Admin","Service");
	}

    public function index(){
        
        $storeList = $this->storeService->getList();

    	$this->assign("storeList", $storeList);

        $this->display();
    }

    public function detail(){

        if(IS_POST && ($result = $this->storeService->editStore()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        $storeId = I("id");
        $storeInfo = $this->storeService->getDetail($storeId);
        $this->assign("storeInfo",$storeInfo);


        $adminList = $this->adminService->getList();
        $this->assign("adminList",$adminList);
    
        if ($result !== true){
            $this->assign("error",$result);
        }
    
        $this->display();
    }

     public function detail_store(){
        $storeId = I("id");
        if(IS_POST && ($result = $this->storeService->editStore()) === true){

            $this->success('操作成功', 'detail_store?id='.$storeId);
            exit();
        }
    
        $storeInfo = $this->storeService->getDetail($storeId);
        $this->assign("storeInfo",$storeInfo);

        if ($result !== true){
            $this->assign("error",$result);
        }
    
        $this->display();
    }


    public function add(){

        if(IS_POST && ($result = $this->storeService->addStore()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        if ($result !== true){
            
            $this->assign("storeInfo", I("post."));
    
            $this->assign("error",$result);
        }

        $adminList = $this->adminService->getList();
        $this->assign("adminList",$adminList);
    
        $this->display();
    }
}