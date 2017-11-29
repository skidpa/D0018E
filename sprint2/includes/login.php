<?php
session_start();
if(isset($_POST['submit'])){
  include 'db.php';
  $user_name = mysqli_real_escape_string($db_conn, $_POST['user_name']);
  $user_password = mysqli_real_escape_string($db_conn, $_POST['user_password']);


  if(empty($user_name) || empty($user_password)){
		header("Location: ../index.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM user WHERE user_name='$user_name'";
		$result = mysqli_query($db_conn, $sql);
		$resultRow = mysqli_num_rows($result);

		if($resultRow < 1){
			/* error no username in Database*/
			header("Location: ../index.php?login=error1");
			exit();
		} else {
			if($row = mysqli_fetch_assoc($result)){
				/* hash password */
				$hashedPassword = $row['user_password'];
				$hashedCheck = password_verify($user_password, $hashedPassword);
				if(!$hashedCheck == 1){
  				//if(!($user_password == $row['user_password'])){
  					/* error wrong password*/
				header("Location: ../index.php?login=error2");
				exit();
		} elseif($hashedCheck == 1){
  					//elseif($user_password == $row['user_password']) {
  					/* login */
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['user_name'] = $row['user_name'];
        $_SESSION['user_address'] = $row['user_address'];
        $_SESSION['user_email'] = $row['user_email'];
        //$_SESSION['user_info'] = $row['user_info'];
        $_SESSION['is_admin'] = $row['is_admin'];

        /*if(!isset($_SESSION['user_basket'])){
          $_SESSION['user_basket'] = array();
        }*/
				header("Location: ../index.php?login=success");

        //lägga till basket array session här med.
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
