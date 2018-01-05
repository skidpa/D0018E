<?php
/*
* Databas config
*/

$db_address = "localhost";
$db_user = "d0018e";
$db_password = "1234";
$db_name = "d0018e_shopdb";

$db_conn = mysqli_connect($db_address, $db_user, $db_password, $db_name);

if(!$db_conn){
  die("Database connection failed: " . mysqli_connect_error());
}

?>
