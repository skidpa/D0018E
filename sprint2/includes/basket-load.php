<?php
if(isset($_POST['submit'])){
  /*session_start();
  include 'db.php';


  $saveBasket = mysqli_real_escape_string(serialize($_SESSION['user_basket']));
  $sql = "UPDATE basket SET user_basket = '$saveBasket' WHERE user_id = '$_SESSION[user_id]'";

  mysqli_query($db_conn, $sql);
  echo '<br> provar spara <br>';
  header("Location: ../shoppingbasket.php?basketload=ok");*/

  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT user_basket FROM basket WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  //  or die("Query to retrieve cart failed");
  if (mysqli_num_rows($result) > 0) {
    //die("Cart not found !");
    while($row = mysqli_fetch_assoc($result)){
      $_SESSION['user_basket'] = unserialize($row['user_basket']);
      //$tmp = $row['user_basket'];
    }
    header("Location: ../shoppingbasket.php?basketload=ok");
  } else {
    header("Location: ../shoppingbasket.php?nobasket");
  }



  //$cart = unserialize( row["user_basket"] );

  /*$_SESSION['user_basket'] = $cart;

  echo '<br>laddat<br>';*/


  // the id of current user

/*  $sql = "SELECT user_basket FROM basket WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql)
    or die("Query to retrieve cart failed");
  if (mysqli_num_rows($result) < 1) {
    die("Cart not found !");
  }

  $row = mysqli_fetch_assoc($result);

  // serialized = array in a series of characters forming a string
  // we convert serialized STRING back into ARRAY
  $cart = unserialize( row["user_basket"] );

  // logged in customer/user gets back his cart, with contents from last visit
  // we make $_SESSION array = $cart array
  $_SESSION['user_basket'] = $cart;
*/
/*
  echo '<br> provar ladda <br>';
  //header("Location: ../shoppingbasket.php?basketsave=ok");
  echo '<br> serial <br>';
  echo '<br>' . $tmp . '<br>';
  echo '<br> dump <br>';
  echo var_dump($_SESSION['user_basket']);*/


}

?>
