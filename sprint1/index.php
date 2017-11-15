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
