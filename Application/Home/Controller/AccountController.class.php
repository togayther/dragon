<?php
namespace Home\Controller;
use Think\Controller;

class AccountController extends Controller{
	
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

	/*
	 * 登录处理
	 * */
	public function login(){
		
		$phone = I('phone');
		$openid = session("openid");
		$data = array();
		if (empty($phone) || empty($openid)) {
			$data["status"] = 400;
			$data["msg"] = "登录失败，请退出重试";
		}else{
			$detectResult = $this->userService->detectPhone($phone);
			if ($detectResult === true) {
				$data["status"] = 400;
				$data["msg"] = "该手机号码已绑定";
			}else{
				$userData["phone"] = $phone;
				$userData["openid"] = session("openid");
				$userData["avatar"] = "";
				$userData["name"] = "";
				$userData["enabled"] = 1;
				$userData["useragent"] = $_SERVER['HTTP_USER_AGENT'];
				$userData["createdate"] = date('Y-m-d H:i:s');
				$userData["lastlogin"] = date('Y-m-d H:i:s');
				$userData["useragent"] = $phone;
			
				$userInfo = $this->userService->addUser($userData);
				
				if ($userInfo && count($userInfo)>0){
					session("userInfo",$userInfo);
					$data["status"] = 200;
					$data["msg"] = U("home/index/index");
					
				}else{
					$data["status"] = 400;
					$data["msg"] = "新增用户失败";
				}
			}
		}
		
		$this->ajaxReturn ( $data );
	}

	public function signin(){
		$data = array();
		$userInfo = session('session_userinfo');
		if ($userInfo && ($userid = $userInfo["id"] > 0)) {
			$signinStatus = $this->userPointService->detectSigninStatus($userid);
			if ($signinStatus === false) {
				$siginPoint = C("SIGNIN_POINT",null,10);
				
				$this->userPointService->addPointRealtime($userid, $siginPoint, "签到赠送");
				$this->updateUserPointAndLevel($userid, $siginPoint);

				$data["status"] = 200;
				$data["msg"] = $siginPoint;
			}else{
				$data["status"] = 400;
				$data["msg"] = "今日已签到";
			}
		}else{
			$data["status"] = 500;
			$data["msg"] = "签到失败，请退出重试";
		}
		$this->ajaxReturn ( $data );
	}

	public function clear(){
		session(null);
	}
}