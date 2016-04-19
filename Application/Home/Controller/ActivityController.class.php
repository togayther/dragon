<?php
namespace Home\Controller;
use Think\Controller;
class ActivityController extends BaseController {

	private $activityService = null;

	public function __construct(){
		parent::__construct();
		$this->activityService = D("Activity","Service");
	}


    public function index(){

    	$activityList = $this->activityService->getCurrentActivity();

    	$this->assign("activityList", $activityList);

        $this->display();
    }

    public function detail(){

    	$id = I("get.id");

    	$activityInfo = $this->activityService->getDetail($id);

    	$this->assign("activityInfo", $activityInfo);

        $this->display();
    }
}