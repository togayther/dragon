<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController {

	private $userPointService = null;
    private $activityService = null;

	public function __construct(){
		parent::__construct();

		$this->userPointService = D("UserPoint","Service");
        $this->activityService = D("Activity","Service");
	}

    public function index(){
    	$userInfo = session('session_userinfo');
    	$userid = $userInfo["id"];
    	$todayPoint = $this->userPointService->getTodayPoint($userid);
        if ($todayPoint > 0) {
            $todayPoint = "+".$todayPoint;
        }
        $todayActivity = $this->activityService->getCurrentActivity();

        $this->assign("todayActivity", $todayActivity);

    	$this->assign("todayPoint", $todayPoint);
        $this->display();
    }

    public function help(){
        $this->display();
    }

    public function contact(){
        $this->display();
    }
}