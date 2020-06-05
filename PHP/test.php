
<?php
// ECHO $_SERVER['CONTENT_TYPE']

$body = file_get_contents('php://input');
// var_dump($body);
// // json_decode
// // json_encode
var_dump(json_decode($body));

// $book = array('a'=>'xiyouji','b'=>'sanguo','c'=>'shuihu','d'=>'hongloumeng');
// $json = json_encode($book);
// var_dump($json);
// $array = json_decode($json,TRUE);
// $obj = json_decode($json);
// var_dump($array);
// var_dump($obj);
?>