<?php

function getCheapPrice(){
  session_start();
  include 'db.php';
  $sql = "SELECT basket_tmp.*, product.product_price FROM basket_tmp
  LEFT JOIN product ON basket_tmp.product_id=product.product_id WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      if($row['product_price'] < $row['basket_product_price']){
        //echo 'nytt är billigare';
        //echo '  ' . $_SESSION['user_id'];
        $sql = "UPDATE basket_tmp SET basket_product_price='$row[product_price]'
        WHERE user_id='$_SESSION[user_id]' AND product_id='$row[product_id]'";
        mysqli_query($db_conn, $sql);
        //updateProduct($art, $amount);
      }
    }
  }
}

?>
