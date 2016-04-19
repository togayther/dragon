<?php
namespace Home\Controller;
use Think\Controller;
use Think\Log;
use Org\Tencent\WeChat;
use Org\Tencent\WeChatAuth;
use Org\Util\DeEncrypt;
use Org\Net\HttpClient;

class WechatController extends Controller {

	//消息回复类型
	private $replyType = "";

	//消息回复内容
	private $replyContent = "";
	
	//微信消息处理器
	private $wechatHandler = null;

	public function __construct(){

		parent::__construct();

		$this->wechatHandler = new WeChat(C("WECHAT_TOKEN"));

		$this->replyType = WeChat::MSG_TYPE_TEXT;
	}
    	
	/*
	 	微信验证接口
	*/
	public function index(){

		if($this->checkSignature()){
        	$this->replyMessage(); 
        }else{
        	exit();
        }
	}

	/*
		回复消息
	*/
	private function replyMessage(){
    	$data = $this->wechatHandler->request();
    	
    	if($data && is_array($data)){
    		$type = $data["MsgType"];
    		$openid = $data['FromUserName'];
    		$eventKey = $data["EventKey"];
        	$transInfo = null; //多客服指定接待
        	$replyContent = null;

        	switch ($type) {
        		case WeChat::MSG_TYPE_TEXT:
        			$keyword = $data["Content"];
        			$this->setReplyContent($keyword);
        			break;
        		case WeChat::MSG_TYPE_EVENT:
        			$eventName = $data["Event"];
        			switch ($eventName) {
        				//关注事件
	        			case WeChat::MSG_EVENT_SUBSCRIBE:
	        				//设置回复内容
	        				$this->setReplyContent("welcome");
	        				break;
	        			//退订事件
	        			case WeChat::MSG_EVENT_UNSUBSCRIBE:
	        				$keyword = "iwillbeback";
	        				$this->setReplyContent($keyword);
	        				break;
	        			//菜单点击
	        			case WeChat::MSG_EVENT_CLICK:
	        				$this->setReplyContent($keyword);
	        				break;
	        			case WeChat::MSG_EVENT_SCAN:
							//设置回复内容
	        				$this->setReplyContent("welcome");
	        				break;
	        			default:
	        				break;
	        		}
        			break;
        		default:
        			break;
        	}
        	//消息回复处理
        	$this->handleReply($openid);
    	}
	}
	
	/*
	 * 消息回复处理
	 * */
	private function handleReply($openId = ""){

		if (!$this->replyType || !$this->replyContent){
			return ;
		}
		
		$this->wechatHandler->response($this->replyContent, $this->replyType);
	}
      
	/*
		根据指定关键字获取回得内容
	*/
	private function setReplyContent($keyword){
		$this->replyContent = "欢迎关注！".$keyword;
		$this->replyType = WeChat::MSG_TYPE_TEXT;
	}
	
	
	/*
		检查微信身份信息
	*/
    private function checkSignature(){
        $signature = $_REQUEST["signature"];
        $timestamp = $_REQUEST["timestamp"];
        $nonce = $_REQUEST["nonce"];
		$token = C("WECHAT_TOKEN");
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		return $tmpStr==$signature;
	}
}