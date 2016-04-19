<?php
/*
 * 列出指定目录下的所有文件
 */
function getFileList($path, $exts = '', $list = array()) {
	
	$path = str_replace('\\', '/', $path);
	if (substr($path, -1) != '/') $path = $path . '/';
	
	$files = glob($path . '*');


	foreach($files as $v) {
		if (!$exts || preg_match("/\.($exts)/i", $v)) {
			
			if(is_file($v)){
				$list[] = $v;
			}
			if (is_dir($v)) {
				$list = getFileList($v, $exts, $list);
			}
		}
	}
	return $list;
}

function explodeAttach($string, $separator){
	$result = [];
	if ($separator &&  $string) {
	 	$result = explode($separator, $string); 
	} 
	return $result;
} 