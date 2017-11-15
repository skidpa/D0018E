<?php

if(isset($_POST['submit'])){
  $db_address = "localhost";
  $db_user = "d0018e";
  $db_password  = "1234";
  $db_name = "d0018e_testdb";

  $db_conn = mysqli_connect($db_address, $db_user, $db_password, $db_name);

  if(!$db_conn){
    die("Database connection failed: " . mysqli_connect_error());
  }

  $user_name = mysqli_real_escape_string($db_conn,$_POST['user_name']);
  $user_password = mysqli_real_escape_string($db_conn,$_POST['user_password']);
  $user_info = mysqli_real_escape_string($db_conn,$_POST['user_info']);

  echo 'användare/lösen: '. $user_name . $user_password;

  if(empty($user_name) || empty($user_password)){
    header("Location: index.php?register=empty");
    exit();
  } else{
    $sql = "SELECT * FROM user WHERE user_name='$user_name'";
    $result = mysqli_query($db_conn, $sql);
    $resultRow = mysqli_num_rows($result);

    if($resultRow > 0){
      header("Location: index.php?register=usertaken");
      exit();
    } else {
      $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
      echo $hashed_password;
      $sql = "INSERT INTO user (user_name, user_password, user_info) VALUES ('$user_name', '$hashed_password', '$user_info')";

      mysqli_query($db_conn, $sql);
      header("Location: index.php?register=ok");
      exit();
    }
  }

}
