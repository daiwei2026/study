	<?php
		ini_set('display_errors', 'On');
		$servername = 'localhost';
		$username = 'root';
		$password = '@Passw0rd';
		$dbname = 'study';
		 
		// 创建连接
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die('连接失败: ' . $conn->connect_error);
		} 
		 
		$sql = 'SELECT * FROM record';
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			// 输出数据
			while($row = $result->fetch_assoc()) {
				echo "id: " . $row["id"]. " - context" . $row["context"] .  "date" . $row["date"]. "<a href=before.php?id=" . $row["id"] . ">modify</a><a href=delete.php?id=" . $row["id"] . ">delete</a><br>";
			}
		} else {
			echo "0 结果";
		}
	?>
