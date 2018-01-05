<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';
  $user_name = mysqli_real_escape_string($db_conn,$_POST['user_name']);
  $comment = mysqli_real_escape_string($db_conn,$_POST['comment']);
  $comment_id = mysqli_real_escape_string($db_conn,$_POST['comment_id']);
  $art_nummer = mysqli_real_escape_string($db_conn,$_POST['art_nummer']);
  if(empty($user_name) || empty($comment)){
    //header("Location: ../product-view.php?art=" . $art_nummer . "=emptyfields");
    header("Location: ../product-view.php?art=" . $art_nummer . "=&emptyfields");
    exit();
  } else {
    $comment_date = date("Y-m-d H:i:s");
    $sql = "UPDATE comments SET comment_reply = 'ja', comment_reply_text = '$comment', comment_reply_date = '$comment_date', comment_reply_from = '$user_name'
    WHERE comment_id = '$comment_id'";
    mysqli_query($db_conn, $sql);
    header("Location: ../product-view.php?art=" . $art_nummer . "=&commentadded");
    exit();
  }
}

?>
