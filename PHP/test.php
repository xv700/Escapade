
<?php

$body = file_get_contents('php://input');  //字符串

$json = json_decode($body,true); //array
// /*
//  * Action,Fields,From三项为必填项，需要验证
//  */
$sql = $json["Action"]." ".$json["Fields"]." From ".$json["From"];

// /*
//  * Sort 非必填
//  */

// var_dump($json["Sort"]);
$Sort =" Order By ";

foreach($json["Sort"] as $key => $value){

    $Sort = $Sort.$value["by"]." ".$value["order"].", ";
    
   }

$Sort = rtrim($Sort, ", ");

/*
 * Limit字段必须类型为字符串格式必须为"数字，数字"，非必填
 */
$Limit = " Limit ".$json["Limit"];

$sql = $sql.$Sort.$Limit;
echo $sql;

// var_dump($json["Sort"])

// echo $json["Filter"]["where"]["id"];
// echo $json["Action"]." ".$json["Fields"]." From ".$json["From"]." where 1=1"." Limit ".$json["Limit"];

// $json["Fields"]
// $book = array('a'=>'xiyouji','b'=>'sanguo','c'=>'shuihu','d'=>'hongloumeng');
// $json = json_encode($book);
// var_dump($json);
// $array = json_decode($json,TRUE);
// $obj = json_decode($json);
// var_dump($array);
// var_dump($obj);
?>
