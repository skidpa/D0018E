<?php

function getBasketAmount(){
	include 'db.php';
	if (!$db_conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM user WHERE user_id='$user_id'";
	$result = mysqli_query($db_conn, $sql);
	$rowCount = '';

	if(mysqli_num_rows($result)){
		$rowCount = '('. mysqli_num_rows($result). ')';
	} else {
		$rowCount = null;
	}

	mysqli_close($conn);

	return $rowCount;

}
?>
