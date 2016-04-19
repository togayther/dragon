<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends BaseController {
	private $adminService = null;
	
	function __construct() {
		parent::__construct();
		$this->adminService = D("Admin","Service");
	}

    public function index(){
        
        $adminList = $this->adminService->getList();

    	$this->assign("adminList", $adminList);

        $this->display();
    }

    public function detail(){

        if(IS_POST && ($result = $this->adminService->editAdmin()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        $adminId = I("id");
        $adminInfo = $this->adminService->getDetail($adminId);
        $this->assign("adminInfo",$adminInfo);
    
        if ($result !== true){
            $this->assign("error",$result);
        }
    
        $this->display();
    }

    public function add(){

        if(IS_POST && ($result = $this->adminService->addAdmin()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        if ($result !== true){
            
            $this->assign("adminInfo", I("post."));
    
            $this->assign("error",$result);
        }
    
        $this->display();
    }
}