<?php
namespace Admin\Controller;
use Think\Controller;
class AuditController extends BaseController {

	private $userPointService = null;

	private $userService = null;

	function __construct() {
		parent::__construct();
		$this->userPointService = D("UserPoint","Service");
		$this->userService = D("User","Service");
	}

    public function index(){
        $auditList = $this->userPointService->getAuditList();

    	$this->assign("auditList", $auditList);

        $this->display();
    }


    public function detail(){

    	if(IS_POST){
    		$auditData = I("post.");
    		$id = $auditData["id"];
    		$status = $auditData["status"];
    		$authdescr = $auditData["authdescr"];
    		$point = $auditData["point"];
    		$userid = $auditData["userid"];

    		$statusVal = C("POINT_STATUS.GOOD");
    		if ($status !== "on") {
    			$statusVal = C("POINT_STATUS.BAD");
    		}
    		$result = $this->userPointService->auditPoint($id, $statusVal, $authdescr);
    		if($result > 0){
                if($statusVal === C("POINT_STATUS.GOOD")){
                    $this->userService->updateUserPointAndLevel($userid, $point);
                }
    			$this->success('操作成功', 'index');
                exit();
    		}

        }
    
        $auditId = I("id");
        $auditInfo = $this->userPointService->getDetail($auditId);
        $this->assign("auditInfo",$auditInfo);

        if ($result !== true){
            $this->assign("error",$result);
        }

        $this->display();
    }
}