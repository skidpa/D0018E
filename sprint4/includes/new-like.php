<?php

if(isset($_POST['new-like'])){
  newLike($_POST['art_nummer']);
  header("Location: ../product-view.php?art=". $_POST['art_nummer']);
}

function newLike($art){
  echo 'gilla artikel: ' . $art;
  session_start();

  include 'db.php';

  //$sql = "SELECT * FROM likes";
  $sql = "INSERT INTO likes (user_id, product_id, is_liked)
  VALUES ('$_SESSION[user_id]', '$art', 'ja')";
  mysqli_query($db_conn, $sql);


}
?>
