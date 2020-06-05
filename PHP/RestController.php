<?php
require_once("SiteRestHandler.php");
		
$view = $_GET["view"];
$view = isset($view) ? $view : "";

$siteRestHandler = new SiteRestHandler();
// /*
//  * RESTful service 控制器
//  * URL 映射
// */
switch($view){

	case "all":
        // 处理 REST Url /site/list/
        
        $siteRestHandler->getAllSites();
		break;
		
	case "single":
		// 处理 REST Url /site/show/<id>/
		$siteRestHandler->getSite($_GET["id"]);
		break;

	default:
		//404 - not found;
		$siteRestHandler->Sites404();
		break;
}
// https://docs.apicloud.com/Cloud-API/data-cloud-api#6
?>
