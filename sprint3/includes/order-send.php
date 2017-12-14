<?php
if(isset($_POST['submit'])){
  session_start();
  include 'price-update.php';
  getCheapPrice();
  include 'db.php';

  $orderdate = date("Y-m-d H:i:s");
  $sql = "INSERT INTO orders (user_id, order_date)
  VALUES ('$_SESSION[user_id]', '$orderdate')";
  mysqli_query($db_conn, $sql);
  $order_id = mysqli_insert_id($db_conn);

  // direkt in i db

  include 'includes/db.php';
  /*
  $sql = "SELECT basket_tmp.*, product.product_name, product.product_stock FROM basket_tmp
  LEFT JOIN product ON basket_tmp.product_id=product.product_id WHERE user_id = '$_SESSION[user_id]'";
  */
  $sql = "SELECT * FROM basket_tmp WHERE user_id='$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  $art = '';
  $amount = '';
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      $sql = "INSERT INTO orders_details (product_id, order_id, details_product_price, order_amount)
      VALUES ('$row[product_id]', '$order_id', '$row[basket_product_price]', '$row[product_amount]')";
      mysqli_query($db_conn, $sql);

      $art = $row['product_id'];
      $amount = $row['product_amount'];


      $sql2 = "SELECT product_stock FROM product WHERE product_id = '$art'";

      $result2 = mysqli_query($db_conn, $sql2);
      if(mysqli_num_rows($result2) > 0){
        $row2 = mysqli_fetch_assoc($result2);
        //echo 'stock: ' . $row2['product_stock'];
        $new_stock = $row2['product_stock'] - $amount;
        $sql2 = "UPDATE product SET product_stock = '$new_stock'
        WHERE product_id = '$art'";
        mysqli_query($db_conn, $sql2);
      }

    }
    $sqlClearBasket = "DELETE FROM basket_tmp WHERE user_id='$_SESSION[user_id]'";
    mysqli_query($db_conn, $sqlClearBasket);
  }

  header("Location: ../account.php?userOrders");
  echo 'klar ' . date('Y-m-d');
}

?>
