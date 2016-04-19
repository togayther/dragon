<?php
namespace Admin\Controller;
use Think\Controller;
class PointController extends BaseController {

	private $userService = null;
    private $userPointService = null;

    function __construct() {
		parent::__construct();
		$this->userService = D("User","Service");
        $this->userPointService = D("UserPoint","Service");
	}

    public function index(){
        $this->display();
    }

    public function detail(){
        $auditId = I("id");
        $auditInfo = $this->userPointService->getDetail($auditId);
        $this->assign("auditInfo",$auditInfo);
    	$this->display();
    }

    public function user(){
    	$userId = I("id");
        $userInfo = $this->userService->getDetail($userId);
        $this->assign("userInfo",$userInfo);

        $condition["userid"] = $userId;
        $pointList = $this->userPointService->getList($condition);
        $this->assign("pointList",$pointList);
        
        $this->display();
    }
}