
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
    // if (!$conn) {
    //     die("连接失败: " . mysqli_connect_error());
    // }
}

// /*
//  * where条件连接
//  */
function StrPeplace($str){
    $str = str_replace("Gte",">=",$str);
    $str = str_replace("Gt",">",$str);

    $str = str_replace("Lte","<=",$str);
    $str = str_replace("Lt","<",$str);

    $str = str_replace("NotNull","IS NOT NULL",$str);
    $str = str_replace("Null","IS NULL",$str);

    $str = str_replace("NotEq","<>",$str);
    $str = str_replace("Eq","=",$str);
    
    $str = str_replace("NotLike","Not Like",$str);
    $str = str_replace("NotIn","Not In",$str);
    return $str;
}

// /*
//  * $body 为post过来的数据，可以再这一层加验证
//  */
$body = file_get_contents('php://input');  //字符串

// /*
//  * 以上增加SQL验证
//  */

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

    $where = $where." ".$value["logic"]." ".$value["fields"]." ".$value["perator"]." ".$value["value"];
    
   }
$where = rtrim($where, ", ");
$sql = $sql.StrPeplace($where);

// var_dump($sql);
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

// var_dump($sql);
// echo $sql;
$JsonArr = array(); 

// SQL执行
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

$Response = array(); 
$Response["Sql"] = $sql;
$Response["Data"] = $JsonArr;

echo json_encode($Response);
 
mysqli_close($conn);

?>
