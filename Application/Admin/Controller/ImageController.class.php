<?php

namespace Admin\Controller;
use Think\Controller;

class ImageController extends BaseController {
	function __construct(){
		parent::__construct();
	}
	
	/*
	 * 首页
	 * */
	public function index() {
		
		$path = C("IMAGE_UPLOAD_PATH");

		$fileList = getFileList($path);

		$imageFiles = array();
		
		if ($fileList && count($fileList)>0){
			
			$siteDomain = C("SITE_DOMAIN");
			
			foreach ($fileList as $file){
				
				if (strpos($file, "./") === 0){
					$file = substr($file,2);
				}
				
				$imageFiles[] = $siteDomain.$file;
			}
		}
		
		//按日期排序
		
		rsort($imageFiles);
		
		$this->assign("imageList",$imageFiles);
		
		$this->display();
	}
	
	/*
	 * 图片删除
	 * */
	public function delete(){
		$imgName = I("get.name");
		
		if (!empty($imgName)){
			$siteDomain = C("SITE_DOMAIN");
			
			$imgName = str_replace($siteDomain,"", $imgName);
			
			$result = @unlink ($imgName);
			
			if($result == true){
				$data["status"] = 200;
				$data["msg"] = "删除成功";
			}
			else{
				$data["status"] = 400;
				$data["msg"] = "删除失败";
			}
			$this->ajaxReturn($data);
		}
	}
	
	/*
	 * 图片上传
	 * */
	public function upload(){
		
		if(IS_POST){
			$upload = new \Think\Upload();
			$upload-> maxSize = C("IMAGE_UPLOAD_SIZE");
			$upload-> exts = C("IMAGE_UPLOAD_EXTS");
			$upload-> rootPath = "./";
			$upload-> autoSub = true;
			$upload-> savePath = C("IMAGE_UPLOAD_PATH");
			
			$info = $upload->uploadOne($_FILES['image']);
			
			$resultMsg = null;
			
			if(!$info) {
				$resultMsg = $upload->getError();
			}else{
				$siteDomain = C("SITE_DOMAIN");
				$savePath = $info["savepath"];
				if (strpos($savePath, "./") === 0){
					$savePath = substr($savePath,2);
				}
				$saveName = $info["savename"];
				$filePath = $siteDomain.$savePath.$saveName;
				$resultMsg = "上传成功，路径为：".$filePath;
			}
			
			$this->assign("msg",$resultMsg);
		}
		
		$this->display();
	}
}