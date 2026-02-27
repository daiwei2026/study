<?php
$servername = "localhost";
$username = "root";
$password = "@Passw0rd";
$dbname = "study";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
date_default_timezone_set("Asia/Shanghai");

$sql = "UPDATE record SET context='" . $_POST["context"] .
"',date='" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "' WHERE id=" . $_GET["id"];

if ($conn->query($sql) === TRUE) {
    echo "新记录插入成功";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>
