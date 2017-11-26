<?php
/*
* blir visa arrayen istället...
*/
function getBasketAmount(){
	include 'db.php';
	if (!$db_conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
				//$sql = "SELECT user_id FROM test";
				//$sql = "SELECT id FROM test";
				//$sql = "SELECT user_name FROM test";
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
