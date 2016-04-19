<?php
namespace Home\Controller;;
use Think\Controller;
use Think\Log;
use Org\Tencent\WeChatAuth;

class BaseController extends Controller{
	
	private $wechatAppId = null;
	private $wechatAppSecret = null;
	private $userService = null;

	public function __construct(){
		parent::__construct();

		$this->wechatAppId = C("WECHAT_APPID");
		$this->wechatAppSecret = C("WECHAT_APPSECRET");
		$this->userService = D("User","Service");


		//$this->_test();

		$this->_wechatAuth();
		$this->_wechatCallback();
	}

	private function _test(){
		$condition["openid"] = "oWXRLs_VUTPT0iwZHD4oFGnnrMKo";
		$userInfo = $this->userService->getUserByCondition($condition);
		session("session_userinfo",$userInfo);
		$this->assign("userInfo",$userInfo);
	}

	/*
	 * 微信拉取用户信息
	 * */
	private function _wechatAuth(){
		$code = I('get.code');

		if($code=="" && (!session('?openid') || !session('?session_userinfo'))){

			$wechatAppId = C("WECHAT_APPID");
			$wechatSecret = C("WECHAT_APPSECRET");
			$siteDomain = C("SITE_DOMAIN");
			$redirectUri = $siteDomain."home";

			$wechat = new WeChatAuth($wechatAppId, $wechatSecret);
			$codeUrl  = $wechat->getRequestCodeURL($redirectUri, 1,'snsapi_base');
			redirect($codeUrl);
		}
	}

	private function _wechatCallback(){
		
		if (!session('?openid') || !session('?session_userinfo')){
			$code = I('get.code');
			$state = I('get.state');
			$wechat = new WeChatAuth($this->wechatAppId, $this->wechatAppSecret);
			$token = $wechat->getAccessToken("code",$code);
			$openid = $token["openid"];
			
			//判断用户是否绑定
			$condition["openid"] = $openid;

			$userInfo = $this->userService->getUserByCondition($condition);

			Log::record(count($userInfo));
			
			session("openid", $openid);

			//用户未绑定
			if(count($userInfo)==0){
				//未绑定
				$this->redirect("home/account/index");
				exit();
			}
			session("session_userinfo",$userInfo);
		}

		$this->assign("userInfo",session("session_userinfo"));
	}
}