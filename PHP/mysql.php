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
 
$sql = "SELECT * FROM table1";
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
?>