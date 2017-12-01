<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';
  
  $sql = "SELECT * FROM basket WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  $resultRow = mysqli_num_rows($result);
  $saveBasket = serialize($_SESSION['user_basket']);

  if($resultRow > 0){
    $sql = "UPDATE basket SET user_basket = '$saveBasket' WHERE user_id = '$_SESSION[user_id]'";
    mysqli_query($db_conn, $sql);
    header("Location: ../shoppingbasket.php?basketsave=ok");
  } else {
    $sql = "INSERT INTO basket (user_id, user_basket)
    VALUES ('$_SESSION[user_id]', '$saveBasket')";
    mysqli_query($db_conn, $sql);
    header("Location: ../shoppingbasket.php?basketsave=ok");
  }

}

?>
