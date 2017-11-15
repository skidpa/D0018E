<?php
session_start();
if(isset($_POST['submit'])){
  $db_address = "localhost";
  $db_user = "d0018e";
  $db_password  = "1234";
  $db_name = "d0018e_testdb";

  $db_conn = mysqli_connect($db_address, $db_user, $db_password, $db_name);

  if(!$db_conn){
    die("Database connection failed: " . mysqli_connect_error());
  }

  $user_name = mysqli_real_escape_string($db_conn, $_POST['user_name']);
  $user_password = mysqli_real_escape_string($db_conn, $_POST['user_password']);


  if(empty($user_name) || empty($user_password)){
		header("Location: index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE user_name='$user_name'";
		$result = mysqli_query($db_conn, $sql);
		$resultRow = mysqli_num_rows($result);

		if($resultRow < 1){
			/* error no user*/
			header("Location: index.php?login=error1");
			exit();
		} else {
			if($row = mysqli_fetch_assoc($result)){
				//echo $row['user_name'];
				/* decrypt password */
				$hashedPassword = $row['user_password'];
				$hashedCheck = password_verify($user_password, $hashedPassword);
				if(!$hashedCheck == 1){
  				//if(!($user_password == $row['user_password'])){
  					/* error wron password*/
				header("Location: index.php?login=error2");
				exit();
		} elseif($hashedCheck == 1){
  					//elseif($user_password == $row['user_password']) {
  					/* logga in */
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_info'] = $row['user_info'];
				header("Location: index.php?login=success");
				exit();
		}
	}

	}
}
} else {
  header("Location: index.php?login=error3");
  exit();
}
?>
