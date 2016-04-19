<?php
namespace Admin\Controller;;
use Think\Controller;

class BaseController extends Controller{
	
	public function __construct(){
		
		parent::__construct();
		
		//账户验证
		$this->_accountAuth();
		
		//菜单绑定
		$this->_accountMenu();
	}
	
	/*
	 * 管理员登录状态控制
	 * */
	private function _accountAuth(){
		$adminInfo = session(C("SESSION_KEY.ADMIN_INFO"));
		
		if (!isset($adminInfo)) {
			
			$this->redirect("Admin/Auth/index");
			exit();
		}
		$this->assign("session_admin",$adminInfo);
	}
	
	/*
	 * 管理员菜单生成
	 * 最多两级菜单。无限级可以用递归
	 * */
	private function _accountMenu(){
		
		$adminInfo = session(C("SESSION_KEY.ADMIN_INFO"));
		$menuCacheKey = "ADMIN_MENU_".$adminInfo["name"];
		//清除缓存
		S($menuCacheKey,null);
		$adminMenus = S($menuCacheKey);
    	if(!$adminMenus){
    		
    		$menuCfg = C("MENU");
    		$adminGroup = $adminInfo["groupid"];
    		$adminGroup = (int)$adminGroup;
    		
    		if ($menuCfg && count($menuCfg)>0){
    			foreach($menuCfg as $menu){
    				$menuGroup = $menu["GROUP"];
    				if (in_array($adminGroup , $menuGroup)){
    					$menuItem = array(
    							"NAME" => $menu["NAME"],
    							"ICON" => $menu["ICON"],
    							"URL" => ($menu["URL"]=="#"?"#":U($menu["URL"])),
    							"ID" => $menu["ID"],
    							"SUBS" => array()
    					);
    						
    					$menuSubs = $menu["SUBS"];
    						
    					if($menuSubs && count($menuSubs)>0){
    						foreach($menuSubs as $subMenu){
    							$subMenuGroup = $subMenu["GROUP"];
    							if (in_array($adminGroup , $subMenuGroup)){
    								$subMenuItem = array(
    										"NAME" => $subMenu["NAME"],
    										"ICON" => $subMenu["ICON"],
    										"URL" => ($subMenu["URL"]=="#"?"#":U($subMenu["URL"])),
    										"ID" => $subMenu["ID"],
    										"SUBS" => array()
    								);
    		
    								$menuItem["SUBS"][] = $subMenuItem;
    							}
    						}
    					}
    					$adminMenus[] = $menuItem;
    				}
    			}
    		}

    		S($menuCacheKey, $adminMenus, C("MENU_CACHE_TIME"));
    	}

		$this->assign("adminMenu",$adminMenus);
	}
}