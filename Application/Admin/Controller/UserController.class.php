<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends BaseController {

	private $userService = null;
    private $userPointService = null;
	
	function __construct() {
		parent::__construct();
		$this->userService = D("User","Service");
        $this->userPointService = D("UserPoint","Service");
	}

    public function index(){

    	$userList = $this->userService->getList();

    	$this->assign("userList", $userList);

        $this->display();
    }

    public function point(){
        //处理上传的图片附件
        if(IS_POST){
            $upload = new \Think\Upload();
            $upload-> maxSize = C("IMAGE_UPLOAD_SIZE");
            $upload-> exts = C("IMAGE_UPLOAD_EXTS");
            $upload-> rootPath = "./";
            $upload-> autoSub = true;
            $upload-> savePath = C("ATTACH_UPLOAD_PATH");

            $info = $upload->upload(); 
            
            $result = null;
            if(!$info) {
                $result = $upload->getError();
            }else{
                $attachInfos = array();
                foreach($info as $file){
                    $attachInfo = substr($file['savepath'],9).$file['savename'];
                    array_push($attachInfos,$attachInfo);
                }
                if(($result = $this->userPointService->addPoint()) > 0 ){

                    $attachData["attach"] = join("|", $attachInfos);
                    $this->userPointService->editPoint($result, $attachData);

                    $this->success('操作成功', 'index');
                    exit();
                }
            }
        }

        //用户信息
        $userId = I("id");
        $userInfo = $this->userService->getDetail($userId);
        $this->assign("userInfo",$userInfo);

        //积分类型
        $pointType = C("POINT_TYPE");
        $this->assign("pointType",$pointType);

        if ($result !== true){
            $this->assign("userPointInfo", I("post."));
            $this->assign("error",$result);
        }
        $this->display();
    }

    public function detail(){

        if(IS_POST && ($result = $this->userService->editUser()) === true){
            $this->success('操作成功', 'index');
            exit();
        }

        $userId = I("id");
        $userInfo = $this->userService->getDetail($userId);
        $this->assign("userInfo",$userInfo);
        if ($result !== true){
            $this->assign("error",$result);
        }
        $this->display();
    }
}