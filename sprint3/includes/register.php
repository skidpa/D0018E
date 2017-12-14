<?php

if(isset($_POST['submit'])){
  include 'db.php';
  $user_name = mysqli_real_escape_string($db_conn,$_POST['user_name']);
  $user_password = mysqli_real_escape_string($db_conn,$_POST['user_password']);
  $user_address = mysqli_real_escape_string($db_conn,$_POST['user_address']);
  $user_email = mysqli_real_escape_string($db_conn,$_POST['user_email']);

  if(empty($user_name) || empty($user_password) ||
  empty($user_address) || empty($user_email)){
    header("Location: ../index.php?empty");
    exit();
  } else{
    $sql = "SELECT * FROM user WHERE user_name='$user_name'";
    $result = mysqli_query($db_conn, $sql);
    $resultRow = mysqli_num_rows($result);

    if($resultRow > 0){
      header("Location: ../index.php?usertaken");
      exit();
    } else {
      $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
      echo $hashed_password;
      $sql = "INSERT INTO user (user_name, user_password, user_address, user_email)
      VALUES ('$user_name', '$hashed_password', '$user_address', '$user_email')";

      mysqli_query($db_conn, $sql);
      header("Location: ../index.php?register=ok");
      exit();
    }
  }
}
