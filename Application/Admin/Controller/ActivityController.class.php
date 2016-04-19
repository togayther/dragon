<?php
namespace Admin\Controller;
use Think\Controller;
class ActivityController extends BaseController {
	private $activityService = null;
    private $storeService = null;
	
	function __construct() {
		parent::__construct();
		$this->activityService = D("Activity","Service");
        $this->storeService = D("Store","Service");
	}

    public function index(){
        
        $activityList = $this->activityService->getList();

    	$this->assign("activityList", $activityList);

        $this->display();
    }

    public function index_store(){
        $adminInfo = session(C("SESSION_KEY.ADMIN_INFO"));

        $adminStoreid = $adminInfo["store_id"];

        $activityList = $this->activityService->getStoreActivity($adminStoreid);

        $this->assign("activityList", $activityList);

        $this->display();
    }

    public function detail(){

        if(IS_POST && ($result = $this->activityService->editActivity()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        $activityId = I("id");
        $activityInfo = $this->activityService->getDetail($activityId);
        $this->assign("activityInfo",$activityInfo);

        $storeList = $this->storeService->getList();
        $this->assign("storeList",$storeList);
    
        if ($result !== true){
            $this->assign("error",$result);
        }
    
        $this->display();
    }

    public function detail_store(){

        $activityId = I("id");
        $activityInfo = $this->activityService->getDetail($activityId);
        $this->assign("activityInfo",$activityInfo);

        $this->display();
    }

    public function add(){

        if(IS_POST && ($result = $this->activityService->addActivity()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        if ($result !== true){
            
            $this->assign("activityInfo", I("post."));
    
            $this->assign("error",$result);
        }

        $storeList = $this->storeService->getList();
        $this->assign("storeList",$storeList);
    
        $this->display();
    }
}