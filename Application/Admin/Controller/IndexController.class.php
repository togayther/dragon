<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends BaseController {

	private $userPointService = null;
	
	function __construct() {
		parent::__construct();
		$this->userPointService = D("UserPoint","Service");
	}

    public function index(){

    	$auditList = $this->userPointService->getAuditList();

    	$this->assign("auditCount", count($auditList));

        $this->display();
    }
}