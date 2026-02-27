<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>study record</title>
	<script>
		window.addEventListener("beforeunload", function(event) {
			// 发送请求到服务器来清除session
			fetch('clear_session.php');
		});
	</script>
</head>

<body>
	<?php
	if (!isset($_SESSION['start']))
		$_SESSION['start'] = 1;
	else if ($_SESSION['start'] == 1) {
		$_SESSION['start'] = 0;
		$_SESSION['stop'] = 1;
	} else {
		unset($_SESSION['start']);
		unset($_SESSION['stop']);
		session_destroy();
	}
	if ($_SESSION['start']) {
	?>
		<form method="post" action="study.php">
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

			$sql = 'SELECT * FROM subject';
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
			?>
				<select name="subject">
					<?php
					// 输出数据
					while ($row = $result->fetch_assoc()) {
					?>
						<option id="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>"><?php echo $row["title"]; ?></option>
				<?php
					}
				}
				?>
				</select>
				<input type="text" name="title">
				<input type="submit" value="start">
				<input type="reset">
		</form>
		<?php
	} else if ($_SESSION["stop"]) {
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
		date_default_timezone_set("PRC");
		$sql = "INSERT INTO record (subject,title,start) VALUES ('" . $_POST["subject"] . "','" . $_POST["title"] . "','" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "')";
		echo $sql;
		if ($conn->query($sql) === TRUE) {
			$id = $conn->insert_id;
			echo $id;
		?>
			<form method="post" action="study.php?id=<?php echo $id; ?>">
				<input type="submit" value="stop">
				<input type="reset">
			</form>
		<?php
			echo "新记录插入成功";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
		?>
	<?php
	} else if ($_GET["id"]) {
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
		date_default_timezone_set("PRC");
		$sql = "UPDATE record SET stop='" . date("Y 年 m 月 d 日 H 点 i 分 s 秒") . "' WHERE id=" . $_GET["id"];
		if ($conn->query($sql) === TRUE) {
			echo "新记录插入成功";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();
	}
	?>
</body>

</html>