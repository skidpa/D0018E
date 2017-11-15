<?php
session_start();
?>
<html>
	<head>
		<title>thjooo</title>
	</head>
	<body>
		<?php
		$db_address = "localhost";
		$db_user = "d0018e";
		$db_password  = "1234";
		$db_name = "d0018e_testdb";

		$db_conn = mysqli_connect($db_address, $db_user, $db_password, $db_name);

		if(!$db_conn){
			die("Database connection failed: " . mysqli_connect_error());
		}
		echo "Database connection ok!<br>";
		/*$toAdd = "ne";
		$sql = "INSERT INTO test (password) VALUES ('$toAdd')";
		echo "before if";


		if(mysqli_query($db_conn, $sql)){
			echo "added ok";
		} else {
			echo "error: " . $sql . "<br>" . mysqli_error($db_conn);
		}*/
		/*$user_name = 'hash';
		$user_password = 'hej';
		$hashed = password_hash('b', PASSWORD_DEFAULT);
		echo '<br>' . $hashed . '<br>';
		$sql = "SELECT * FROM user WHERE user_name='$user_name'";
		$result = mysqli_query($db_conn, $sql);
		$resultOk = mysqli_num_rows($result);
		echo 'resultOK: ' . $resultOk . '<br>';
		if($resultOk < 1){

			echo '<br>failed to find user <br>';

			exit();
		} else {

			if($row = mysqli_fetch_assoc($result)){
				$hashedPassword = $row['user_password'];
				$hashedCheck = password_verify($user_password, $hashedPassword);
				echo 'user_name: ' . $row['user_name'] . ' | user_password: ' . $row['user_password'] . '<br>';
				echo 'hashedCheck: ' . $hashedCheck . '<br>';
			}
		}*/
		/*$user_id = '1';
		$tests ='';
		$sql = "SELECT MAX(order_nummer) AS nummer FROM basket WHERE user_id='$user_id'";
		$result = mysqli_query($db_conn, $sql);
		$resultOk = mysqli_num_rows($result);
		echo 'resultok: ' . $resultOk . '<br>';
		if($resultOk < 1){

			echo '<br>failed to find user <br>';

			exit();
		} else {

			if($row = mysqli_fetch_assoc($result)){
				$highest_ordernum = $row['nummer'];
				$sql = "INSERT INTO orders (user_id, order_nummer) VALUES ('$user_id', '$highest_ordernum')";
				mysqli_query($db_conn, $sql);
				echo 'sucess?';
				exit();
			}
		}
		echo $highest_ordernum;
		//if($row = mysql_fetch_assoc($result)){
		//	echo 'highest: ' . $row['nummer'] . '<br>';
		//}

		//echo 'tests: ' . $row['nummer'];
		mysqli_close($db_conn); /*close the connection. also closes when script ends.*/
		?>

		<?php

					if(isset($_SESSION['user_id'])){
						echo "<br>Välkommen " . $_SESSION['user_name'] . "<br> " . $_SESSION['user_info'] . "<br>";
						echo '<form action="logout.php" method="POST">
						<button type="submit" name="submit">Logga ut</button>
						</form>';
					} else {
						echo '<form action="register.php" method="POST">
							<input type="text" placeholder="Användarnamn" name="user_name">
							<input type="password" placeholder="Lösenord" name="user_password">
							<input type="text" placeholder="info" name="user_info">
							<button type="submit" name="submit">Registrera</button>
						</form>
						<form action="login.php" method="POST">
							<input type="text" placeholder="Användarnamn" name="user_name">
							<input type="password" placeholder="Lösenord" name="user_password">
						<button type="submit" name="submit">Logga in</button>
						</form>';
					}
		?>

	</body>
</html>
