<?php

namespace Common\Controller;
use Think\Controller;

class BaseApiController extends Controller {
	
	public function responseAjaxData($responseData, $emptyMsg = "未查询到相关信息"){
		if ($responseData) {
			$data ["status"] = 200;
			$data ["data"] = $responseData;
		} else {
			$data ["status"] = 400;
			$data ["data"] = $emptyMsg;
		}
		
		header("Access-Control-Allow-Origin: *");
		
		echo json_encode($data);
	}
	
}