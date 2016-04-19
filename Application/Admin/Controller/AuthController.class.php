<?php

namespace Admin\Controller;

use Think\Controller;

class AuthController extends Controller {
	
	const ADMIN_NAME = "ADMIN_USERNAME";
	
	/*
	 * 登录主页
	 * */
	public function index() {
		$this->display ("login");
	}
	
	/*
	 * 登录处理
	 * */
	public function login(){
		
		$username = I('username');
		$password = I('password');
	
		$adminService = D("Admin","Service");
		
		$adminInfo = $adminService->login($username, $password);
		
		$data = array();
		
		if ($adminInfo && count($adminInfo)>0){
			
			session(C("SESSION_KEY.ADMIN_INFO"), $adminInfo);
			
			$data["status"] = 200;
			$data["msg"] = U("admin/index/index");
			
		}else{
			$data["status"] = 400;
			$data["msg"] = "错误的用户名或密码";
		}
		
		$this->ajaxReturn ( $data );
	}
	
	/*
	 * 注销登录
	 * */
	public function logout(){

		session(C("SESSION_KEY.ADMINNAME"),null);
		session(C("SESSION_KEY.ADMINREALNAME"),null);
		session(C("SESSION_KEY.ADMINID"),null);
		session(C("SESSION_KEY.ADMINGROUP"), null);
		
		$this->display('Auth/login');
	}
}