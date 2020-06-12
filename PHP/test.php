
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "test";
 
// 创建连接
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("连接失败: " . mysqli_connect_error());
}



$body = file_get_contents('php://input');  //字符串

$json = json_decode($body,true); //array
// /*
//  * Action,Fields,From三项为必填项，需要验证
//  */
$sql = $json["Action"]." ".$json["Fields"]." From ".$json["From"];

// /*
//  * Where 非必填
//  */

$sql = $json["Action"]." ".$json["Fields"]." From ".$json["From"];

// /*
//  * Sort 非必填
//  */
$Sort =" Order By ";
foreach($json["Sort"] as $key => $value){

    $Sort = $Sort.$value["by"]." ".$value["order"].", ";
    
   }

$Sort = rtrim($Sort, ", ");
$sql = $sql.$Sort;

/*
 * Limit字段必须类型为字符串格式必须为"数字，数字"，非必填
 */
$Limit = " Limit ".$json["Limit"];

$sql = $sql.$Limit;

// echo $sql;

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {

    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
      var_dump($row);
      echo "<br>";
        // echo "id: " . $row[0]."<br>";
    }
} else {
    echo "0 结果";
}
 
mysqli_close($conn);

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
