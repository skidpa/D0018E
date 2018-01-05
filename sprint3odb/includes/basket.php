<?php

if(isset($_POST['basket-add'])) {
  addProduct($_POST['art_nummer'], $_POST['product_amount'], $_POST['product_price']);
  header("Location: ../products.php");
}

if(isset($_POST['basket-update'])) {
  echo $_POST['art_nummer'] . '<br>'. $_POST['product_amount']. '<br>';
  updateProduct($_POST['art_nummer'], $_POST['product_amount']);
  header("Location: ../shoppingbasket.php");
}

if(isset($_POST['basket-remove'])) {
  removeProduct($_POST['art_nummer']);
  header("Location: ../shoppingbasket.php");
}

if(isset($_POST['basket-clear'])) {
  clearBasket($_POST['user_id']);
  header("Location: ../shoppingbasket.php");
}

function addProduct($art, $amount, $price){
  echo 'add ' . $art . ' antal ' . $amount . '<br>';
  session_start();
  echo $_SESSION['user_id'];
  include 'db.php';
  $art_nummer = mysqli_real_escape_string($db_conn,$art);
  $product_amount = mysqli_real_escape_string($db_conn,$amount);
  $product_price = mysqli_real_escape_string($db_conn,$price);
  $sql = "SELECT * FROM basket_tmp
  WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";

  $result = mysqli_query($db_conn, $sql);
  echo 'koll';

  if(mysqli_num_rows($result) > 0){
    echo 'finns redan uppdatera istället';
    $row = mysqli_fetch_assoc($result);
    echo '<br>row echo: ' . $row['product_amount'];
    $product_amount += $row['product_amount'];
    echo '<br> nu update';
    $sql = "UPDATE basket_tmp SET product_amount='$product_amount'
    WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";
    mysqli_query($db_conn, $sql);
    echo 'if klar';

  } else {
    $sql = "INSERT INTO basket_tmp (user_id, product_id, product_name, basket_product_price, product_amount)
    VALUES ('$_SESSION[user_id]', '$art_nummer', 'produktnamn', '$product_price', '$product_amount')";
    mysqli_query($db_conn, $sql);
    echo 'else klar';
  }

}

function updateProduct($art, $amount){
  echo 'add ' . $art . ' antal ' . $amount . '<br>';
  session_start();
  echo $_SESSION['user_id'];
  include 'db.php';
  $art_nummer = mysqli_real_escape_string($db_conn,$art);
  $product_amount = mysqli_real_escape_string($db_conn,$amount);
  $sql = "SELECT * FROM basket_tmp
  WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";

  $result = mysqli_query($db_conn, $sql);
  echo 'koll<br>';

  if(mysqli_num_rows($result) > 0){
    echo 'uppdaterar istället<br>';
    $sql = "UPDATE basket_tmp SET product_amount='$product_amount'
    WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";
    mysqli_query($db_conn, $sql);
    echo 'update klar <br>';
    /*
    OBS DENNA SKRIVER ÖVER OM MAN TRYCKER PÅ ADD IGEN
    */
  } /*else {
    $sql = "INSERT INTO basket_tmp (user_id, product_id, product_name, product_price, product_amount)
    VALUES ('$_SESSION[user_id]', '$art_nummer', 'produktnamn', '$product_price', '$product_amount')";
    mysqli_query($db_conn, $sql);
    echo 'else klar';
  }*/

}

/*
function updateProduct($art_nummer, $amount){
  echo 'update ' . $art_nummer;
  echo 'add ' . $art . ' antal ' . $amount . '<br>';
  session_start();
  include 'db.php';
  $art_nummer = mysqli_real_escape_string($db_conn,$art);
  $product_amount = mysqli_real_escape_string($db_conn,$amount);
  $sql = "SELECT * FROM basket_tmp
  WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";

  $result = mysqli_query($db_conn, $sql);
  echo 'koll';

  if(mysqli_num_rows($result) > 0){
    echo 'uppdaterar istället';
    $sql = "UPDATE basket_tmp SET product_amount='$product_amount'
    WHERE user_id='$_SESSION[user_id]' AND product_id='$art_nummer'";
    mysqli_query($db_conn, $sql);
    echo 'klar';
  }
}*/

function removeProduct($art){
  echo 'remove ' . $art;
  session_start();
  include 'db.php';
  $art_nummer = mysqli_real_escape_string($db_conn,$art);
  $sql = "DELETE FROM basket_tmp WHERE product_id='$art_nummer' AND user_id='$_SESSION[user_id]'";
  mysqli_query($db_conn, $sql);
  echo '<br> remove done';
}

function clearBasket($user_id){
  echo 'clear basket ' . $user_id;
  session_start();
  include 'db.php';
  $sql = "DELETE FROM basket_tmp WHERE user_id='$_SESSION[user_id]'";
  mysqli_query($db_conn, $sql);
  echo '<br> basket clear done';
}

?>
