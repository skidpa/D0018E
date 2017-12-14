<?php

if(isset($_POST['submit'])){
  include 'db.php';
  $product_name = mysqli_real_escape_string($db_conn,$_POST['product_name']);
  $product_desc = mysqli_real_escape_string($db_conn,$_POST['product_desc']);
  $product_info = mysqli_real_escape_string($db_conn,$_POST['product_info']);
  $product_stock = mysqli_real_escape_string($db_conn,$_POST['product_stock']);
  $product_price = mysqli_real_escape_string($db_conn,$_POST['product_price']);
  $product_live = mysqli_real_escape_string($db_conn,$_POST['product_live']);
  $product_id = mysqli_real_escape_string($db_conn,$_POST['product_id']);
  //<input type="hidden" name="art_nummer" value="'. $_SESSION['user_basket'][$key]['art_nummer'] .'">
  //$_SESSION['user_basket'][(int)$_POST['art_nummer']]['amount'] = (int)$_POST['amount'];
  if(empty($product_name) || empty($product_desc) ||
  empty($product_info) || empty($product_stock) ||
  empty($product_price) || empty($product_live) || empty($product_id)){
    header("Location: ../account?prodcutfield=empty");
    exit();
  } else{
    $sql = "SELECT * FROM product WHERE product_name='$product_id'";
    $result = mysqli_query($db_conn, $sql);
    $resultRow = mysqli_num_rows($result);
    $sql = "UPDATE product SET product_name = '$product_name' , product_desc = '$product_desc', product_info = '$product_info'
     , product_stock = '$product_stock', product_price = '$product_price', product_live = '$product_live' WHERE product_id= '$product_id'";

    mysqli_query($db_conn, $sql);
    header("Location: ../account.php?listProduct&productupdate=ok");
    exit();
    echo 'redo for sql injection';
    /*if($resultRow > 0){
      header("Location: ../account.php?product_name=taken");
      exit();
    } else {
      $sql = "INSERT INTO product (product_name, product_info, product_stock, product_price, product_desc)
      VALUES ('$product_name', '$product_info', '$product_stock', '$product_price', '$product_desc')";

      mysqli_query($db_conn, $sql);
      header("Location: ../account.php?addedproduct=ok");
      exit();
    }*/
  }
}
?>
