<?php 
require_once("SimpleRest.php");
require_once("Site.php");

class SiteRestHandler extends SimpleRest {

	function getAllSites() {	
      
		$site = new Site();
		$rawData = $site->getAllSite();
        
		// if(empty($rawData)) {
		// 	$statusCode = 404;
		// 	$rawData = array('error' => 'No sites found!');		
		// } else {
		// 	$statusCode = 200;
        // }
        

        // $requestContentType = $_SERVER['HTTP_ACCEPT'];
		header("Content-Type:application/json;charset=UTF-8");
		echo json_encode($rawData);
		// $this ->setHttpHeaders($requestContentType, $statusCode);
		// 	echo $requestContentType;
			// echo $statusCode;
			
		// if(strpos($requestContentType,'application/json') !== false){
		// 	$response = $this->encodeJson($rawData);
		// 	echo $response;
		// } else if(strpos($requestContentType,'text/html') !== false){
		// 	$response = $this->encodeJson($rawData);
		// 	echo $response;
		// } else if(strpos($requestContentType,'application/xml') !== false){
		// 	$response = $this->encodeXml($rawData);
		// 	echo $response;
		// }
	}
	function Sites404() {
		header("Content-Type:application/json;charset=UTF-8");
		header("status: 404");
		$rawData = array('error' => 'No sites found!');	
		echo json_encode($rawData);
	}
	// public function encodeHtml($responseData) {
	
	// 	$htmlResponse = "<table border='1'>";
	// 	foreach($responseData as $key=>$value) {
    // 			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
	// 	}
	// 	$htmlResponse .= "</table>";
	// 	return $htmlResponse;		
	// }
	
	// public function encodeJson($responseData) {
	// 	$jsonResponse = json_encode($responseData);
	// 	return $jsonResponse;		
	// }
	
	// public function encodeXml($responseData) {
	// 	// 创建 SimpleXMLElement 对象
	// 	$xml = new SimpleXMLElement('<?xml version="1.0"? ><site></site>');
	// 	foreach($responseData as $key=>$value) {
	// 		$xml->addChild($key, $value);
	// 	}
	// 	return $xml->asXML();
	// }
	
	public function getSite($id) {

		$site = new Site();
		$rawData = $site->getSite($id);

		header("Content-Type:application/json;charset=UTF-8");
		echo json_encode($rawData);

				

	}
}
?>
