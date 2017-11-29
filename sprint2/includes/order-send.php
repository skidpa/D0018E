<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';


  /*$sql = "SELECT * FROM order_test WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  $resultRow = mysqli_num_rows($result);
  $orderBasket = serialize($_SESSION['user_basket']);

  if($resultRow > 0){
    echo 'if <br>';
    $sql = "UPDATE order_test SET order_details = '$orderBasket' WHERE user_id = '$_SESSION[user_id]'";
    mysqli_query($db_conn, $sql);
    header("Location: ../shoppingbasket.php?basketsave=ok");
  } else {
    echo 'else <br>';
    $sql = "INSERT INTO order_test (user_id, order_details)
    VALUES ('$_SESSION[user_id]', '$orderBasket')";
    mysqli_query($db_conn, $sql);
    //header("Location: ../shoppingbasket.php?basketsave=ok");
  }*/

/*
  echo '<br> provar spara <br>';
  //header("Location: ../shoppingbasket.php?basketsave=ok");
  echo '<br> serial <br>';
  echo '<br>' . $saveBasket . '<br>';
  echo '<br> dump <br>';
  echo var_dump($_SESSION['user_basket']);*/
  $orderdate = date('Y-m-d');
  $sql = "INSERT INTO orders (user_id, order_date)
  VALUES ('$_SESSION[user_id]', '$orderdate')";
  mysqli_query($db_conn, $sql);
  $order_id = mysqli_insert_id($db_conn);
  for($i = 1; $i<= sizeof($_SESSION['user_basket']); $i++){
    echo 'for loop';
    echo $_SESSION['user_basket'][$i]['art_nummer'];
    $art = $_SESSION['user_basket'][$i]['art_nummer'];
    $id = $_SESSION['user_id'];
    $price = $_SESSION['user_basket'][$i]['price'];
    $amount = $_SESSION['user_basket'][$i]['amount'];
    $sql = "INSERT INTO orders_details (product_id, order_id, product_price, order_amount)
    VALUES ('$art', '$order_id', '$price', '$amount')";
    mysqli_query($db_conn, $sql);
  }

  /*foreach ($_SESSION['user_basket'] as $key => $keyvalue) {
    $sql = "SELECT * FROM product WHERE product_id='$key'";
    $result = mysqli_query($db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo '<tr><td>'
        . $_SESSION['user_basket'][$key]['art_nummer'] . '</td><td>'
        . $row['product_name'] . '</td><td>'
        . $row['product_stock'] .  '</td><td>'
        . $_SESSION['user_basket'][$key]['price'] . '</td><td>'
        . '<form action="includes/basket-update.php" method="POST">
        <input type="number" placeholder="antal" name="amount" value="' . $_SESSION['user_basket'][$key]['amount'] . '">
        <input type="hidden" name="art_nummer" value="'. $_SESSION['user_basket'][$key]['art_nummer'] .'">
        <input type="submit" name="submit" value="Uppdatera">
        </form></td><td>'
        . '<a href="includes/basket-remove.php?art='. $_SESSION['user_basket'][$key]['art_nummer'] . '">Ta bort</a></td><tr>';
        //. $_SESSION['user_basket'][$i]['price'] . '</td><td>'
      }
    } else {
      echo 'databas fel :-(';
    }
  }*/


  echo 'klar ' . date('Y-m-d');
}

?>
