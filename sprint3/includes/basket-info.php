<?php

function getBasketAmount(){
	include 'db.php';
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
function getBasketAmount2(){
	include 'db.php';
  sessin_start();
	$user_id = $_SESSION['user_id'];
	$sql = "SELECT * FROM basket_tmp WHERE user_id='$_SESSION[user_id]'";
	$result = mysqli_query($db_conn, $sql);
	$rowCount = '';

	if(mysqli_num_rows($result)){
		$rowCount = '('. mysqli_num_rows($result). ')';
	} else {
		$rowCount = null;
	}

	mysqli_close($db_conn);

	return $rowCount;

}
?>
