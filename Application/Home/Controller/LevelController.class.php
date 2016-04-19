<?php
namespace Home\Controller;
use Think\Controller;
class LevelController extends BaseController {

	private $levelService = null;

	public function __construct(){
		parent::__construct();
		$this->levelService = D("Level","Service");
	}

    public function index(){

    	$levelList = $this->levelService->getList();

    	$this->assign("levelList", $levelList);
        $this->display();
    }
}