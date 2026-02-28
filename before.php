<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
</head>

<body>
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

	$sql = "SELECT context FROM record WHERE id=" . $_GET["id"];
	$result = $conn->query($sql);
	$row = $result->fetch_column();
	$conn->close();
	?>
	<form action="modify.php?id=<?php echo $_GET["id"]; ?>" method="post">
		<input type="text" name="context" value="<?php echo $row; ?>">
		<input type="submit">
		<input type="reset">
	</form>
</body>

</html>