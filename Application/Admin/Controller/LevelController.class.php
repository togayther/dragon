<?php
namespace Admin\Controller;
use Think\Controller;
class LevelController extends BaseController {

    private $levelService = null;
    private $userService = null;

    function __construct() {
        parent::__construct();
        $this->levelService = D("Level","Service");
        $this->userService = D("User","Service");
    }

    public function index(){
        
        $levelList = $this->levelService->getList();

        $this->assign("levelList", $levelList);

        $this->display();
    }

    public function detail(){

        if(IS_POST && ($result = $this->levelService->editLevel()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        $levelId = I("id");
        $levelInfo = $this->levelService->getDetail($levelId);
        $this->assign("levelInfo",$levelInfo);
    
        if ($result !== true){
            $this->assign("error",$result);
        }
    
        $this->display();
    }

    public function add(){

        if(IS_POST && ($result = $this->levelService->addLevel()) === true){
            $this->success('操作成功', 'index');
            exit();
        }
    
        if ($result !== true){
            
            $this->assign("levelInfo", I("post."));
    
            $this->assign("error",$result);
        }
    
        $this->display();
    }

    public function user(){
        $levelId = I("id");
        $levelInfo = $this->levelService->getDetail($levelId);
        $this->assign("levelInfo",$levelInfo);

        $condition["level"] = $levelId;
        $userList = $this->userService->getList($condition);
        $this->assign("userList",$userList);
    
        $this->display();
    }
}