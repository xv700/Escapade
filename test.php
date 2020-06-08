
<?php

$body = file_get_contents('php://input');  //字符串

// echo $body;
// var_dump($body);
$json=json_decode($body,true); //array
// var_dump($json["Filter"]); // $json["Filter"] array
echo $json["Filter"]["where"]["id"];
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