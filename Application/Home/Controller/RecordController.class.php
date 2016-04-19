<?php
namespace Home\Controller;
use Think\Controller;
class RecordController extends BaseController {

	private $userPointService = null;

	public function __construct(){
		parent::__construct();

		$this->userPointService = D("UserPoint","Service");
	}

    public function index(){

    	$userInfo = session('session_userinfo');
    	$userid = $userInfo["id"];

    	$incomePointRecord = $this->userPointService->getPointRecordByType($userid, 1);
    	$consumePointRecord = $this->userPointService->getPointRecordByType($userid, 0);

    	$this->assign("incomePointList", $incomePointRecord);
    	$this->assign("comsumePointList", $consumePointRecord);

        $this->display();
    }
}