<?php

if(isset($_POST['submit'])){
  include 'db.php';
  $product_name = mysqli_real_escape_string($db_conn,$_POST['product_name']);
  $product_desc = mysqli_real_escape_string($db_conn,$_POST['product_info']);
  $product_info = mysqli_real_escape_string($db_conn,$_POST['product_info']);
  $product_stock = mysqli_real_escape_string($db_conn,$_POST['product_stock']);
  $product_price = mysqli_real_escape_string($db_conn,$_POST['product_price']);

  if(empty($product_name) || empty($product_info) ||
  empty($product_stock) || empty($product_price)){
    header("Location: ../account.php?addProduct&prodcutfield=empty");
    exit();
  } else{
    $sql = "SELECT * FROM product WHERE product_name='$product_name'";
    $result = mysqli_query($db_conn, $sql);
    $resultRow = mysqli_num_rows($result);

    if($resultRow > 0){
      header("Location: ../account.php?addProduct&product_name=taken");
      exit();
    } else {
      $sql = "INSERT INTO product (product_name, product_info, product_stock, product_price, product_desc)
      VALUES ('$product_name', '$product_info', '$product_stock', '$product_price', '$product_desc')";

      mysqli_query($db_conn, $sql);
      header("Location: ../account.php?addedproduct=ok");
      exit();
    }
  }
}
