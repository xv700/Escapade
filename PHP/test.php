
<?php
require './TableName.php';
//是否存在user这个表
$IshaveTable = TableName\TableNameArray("user");
if(!$IshaveTable) {
	echo "数据库名称不存在，请检查数据库名称！";
	exit();
}

require './mysql.php';
require './rules.php';

//var_dump($IshaveTable);

// SQL执行
$Conn = MySql\ConnSql();

// /*
//  * $body 为post过来的数据，可以再这一层加验证
//  */
$body = file_get_contents('php://input');  //字符串

// /*
//  * 以上增加SQL验证
//  */

$json = json_decode($body,true); //array

// /*
//  * table 别名 as
//  */
$Tables = $json["Tables"];
foreach($json["TableAs"] as $key => $value){
    $Tables = str_replace($value["name"],$value["name"]." as ".$value["as"],$Tables);
}

// /*
//  * Fields 别名 as
//  */
$Fields = $json["Fields"];
foreach($json["FieldsAs"] as $key => $value){
    $Fields = str_replace($value["name"],$value["name"]." as ".$value["as"],$Fields);
}

$Aggregation = "";
foreach($json["Aggregation"] as $key => $value){
    $Aggregation = $Aggregation.",".$value["name"]."(".$value["fields"].") as ".$value["as"];
}
// /*
//  * Action,Fields,From三项为必填项，需要验证
//  */
$sql = $json["Action"]." ".$Fields.$Aggregation." From ".$Tables;

// /*
//  * Where 非必填
//  */

$where = "";
foreach($json["Where"] as $key => $value){

    $where = $where." ".$value["logic"]." ".$value["fields"]." ".$value["perator"]." ".$value["value"];
    
   }
$where = " where ".ltrim($where, " and");
$sql = $sql.Rules\StrPeplace($where);

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


$result = mysqli_query($Conn, $sql);


if (mysqli_num_rows($result) > 0) {
    
// var_dump(mysqli_fetch_assoc($result));
    
    // 输出数据
    while($row = mysqli_fetch_assoc($result)) {
        array_push($JsonArr,$row); 
    //   echo json_encode($row);
    }
} 
else
//  {
//     echo "1 结果";
// }

$Response = array(); 
$Response["Sql"] = $sql;
$Response["Data"] = $JsonArr;

echo json_encode($Response);
 


mysqli_close($Conn);

?>
