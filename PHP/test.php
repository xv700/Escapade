
<?php
// /*
//  * 数据库连接
//  */
function ConnSql()
{
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "test";
    
    // 创建连接
    return mysqli_connect($servername, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("连接失败: " . mysqli_connect_error());
    }
}

// /*
//  * where条件连接
//  */
function StrPeplace($str){
    $str = str_replace("Gte",">=",$str);
    $str = str_replace("Lte","<=",$str);
    $str = str_replace("Eq","=",$str);
    return $str;
}

// /*
//  * $body 为post过来的数据，可以再这一层加验证
//  */
$body = file_get_contents('php://input');  //字符串




$json = json_decode($body,true); //array
// /*
//  * Action,Fields,From三项为必填项，需要验证
//  */
$sql = $json["Action"]." ".$json["Fields"]." From ".$json["From"];

// /*
//  * Where 非必填
//  */

$where = " where 1=1";
foreach($json["Where"] as $key => $value){

    var_dump($value);
    $where = $where." ".$value["logic"]." ".$value["fields"]." ".$value["perator"]." ".$value["value"];
    
   }
$where = rtrim($where, ", ");
$sql = $sql.StrPeplace($where);

var_dump($sql);
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
$JsonArr = array(); 
// echo json_encode($JsonArr);
$conn = ConnSql();

$result = mysqli_query($conn, $sql);
 
if (mysqli_num_rows($result) > 0) {
// var_dump(mysqli_fetch_assoc($result));
    
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        array_push($JsonArr,$row); 
    //   echo json_encode($row);
    }
} else {
    echo "0 结果";
}
echo json_encode($JsonArr);
 
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
