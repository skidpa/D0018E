<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';
  $user_name = mysqli_real_escape_string($db_conn,$_POST['user_name']);
  $comment = mysqli_real_escape_string($db_conn,$_POST['comment']);
  $art_nummer = mysqli_real_escape_string($db_conn,$_POST['art_nummer']);
  if(empty($user_name) || empty($comment)){
    header("Location: ../product-view.php?art=" . $art_nummer . "=emptyfields");
    exit();
  } else {
    $comment_date = date("Y-m-d H:i:s");
    $sql = "INSERT INTO comments (product_id, user_id, comment_text, user_name, comment_date)
    VALUES ('$art_nummer', '$_SESSION[user_id]', '$comment', '$user_name', '$comment_date')";
    mysqli_query($db_conn, $sql);
    header("Location: ../product-view.php?art=" . $art_nummer . "=commentadded");
    exit();
  }
}

?>
