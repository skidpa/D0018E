<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';

  $orderdate = date('Y-m-d');
  $sql = "INSERT INTO orders (user_id, order_date)
  VALUES ('$_SESSION[user_id]', '$orderdate')";
  mysqli_query($db_conn, $sql);
  $order_id = mysqli_insert_id($db_conn);

  var_dump($_SESSION['user_basket']);
  echo '<br> före foreach <br>';
  foreach ($_SESSION['user_basket'] as $key => $keyvalue){
    echo '<br> inne i foreach <br>';

    $art = $keyvalue['art_nummer'];
    $id = $_SESSION['user_id'];
    $price = $keyvalue['price'];
    $amount = $keyvalue['amount'];
    $sql = "INSERT INTO orders_details (product_id, order_id, product_price, order_amount)
    VALUES ('$art', '$order_id', '$price', '$amount')";
    mysqli_query($db_conn, $sql);

    $sql = "SELECT product_stock FROM product WHERE product_id = '$art'";

    $result = mysqli_query($db_conn, $sql);
    if(mysqli_num_rows($result) > 0){
      $row = mysqli_fetch_assoc($result);
      echo 'stock: ' . $row['product_stock'];
      $new_stock = $row['product_stock'] - $amount;
      $sql = "UPDATE product SET product_stock = '$new_stock'
      WHERE product_id = '$art'";
      mysqli_query($db_conn, $sql);
    }

    echo '<br>'.
    'art: ' . $art
    .' id: '. $id
    .' pris: '. $price
    .' antal: ' . $amount
    .'<br>';
  }

  echo 'klar ' . date('Y-m-d');
}

?>
