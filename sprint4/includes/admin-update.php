<?php
session_start();
if(isset($_POST['submit'])){
  include 'db.php';
  $user_name = mysqli_real_escape_string($db_conn,$_SESSION['user_name']);
  $user_password = mysqli_real_escape_string($db_conn,$_POST['user_password']);
  $user_address = mysqli_real_escape_string($db_conn,$_POST['user_address']);
  $user_email = mysqli_real_escape_string($db_conn,$_POST['user_email']);

    if(empty($user_name) || empty($user_password) ||
    empty($user_address) || empty($user_email)){
      header("Location: ../account.php?adminSettings=&emptyfields");
      exit();
    } else {
      $sql = "SELECT * FROM user WHERE user_name='$user_name'";
      $result = mysqli_query($db_conn, $sql);
      $resultRow = mysqli_num_rows($result);

      $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
      $sql = "UPDATE user SET user_password = '$hashed_password' , user_address = '$user_address', user_email = '$user_email'
       WHERE user_id= '$_SESSION[user_id]'";

      mysqli_query($db_conn, $sql);
      header("Location: ../account.php?accontupdate=ok");
    }

}
