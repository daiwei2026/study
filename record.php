<?php
$servername = "localhost";
$username = "root";
$password = "@Passw0rd";
$dbname = "study";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
	die("连接失败: " . $conn->connect_error);
} 

$conn->query("SET NAMES UTF8");
date_default_timezone_set("PRC");
 
$sql = "INSERT INTO record (context,date) VALUES ('" . $_POST["context"] . "','" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "')";
$id = $conn->insert_id;
 
if ($conn->query($sql) === TRUE) {
	echo $id = $conn->insert_id;
	echo "新记录插入成功";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}
 
$conn->close();
?>
