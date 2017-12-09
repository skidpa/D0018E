<?php
session_start(); // dont forget!
include 'db.php';
$order_id = 11;
$sql = "SELECT * FROM orders_details WHERE order_id = '$order_id'";
$result = mysqli_query($db_conn, $sql);
//  or die("Query to retrieve cart failed");
$orderSent = '';
if(!isset($_SESSION['view_order'])){
  $_SESSION['view_order'] = array();
}
if (mysqli_num_rows($result) > 0) {
  //die("Cart not found !");
  while($row = mysqli_fetch_assoc($result)){
    print_r($row);
    echo'art: '.$row['product_id'].' pris '.$row['product_price'].' antal '.$row['order_amount'];

    $orderArray[$row['product_id']] = array('art_nummer' => $row['product_id'], 'amount' => $row['order_amount'], 'price' => $row['product_price']);
    //$_SESSION['view_order'][$order_id]= array('art_nummer' => $row['product_id'], 'amount' => $row['order_amount'], 'price' => $row['product_price']);

    //echo $_SESSION['view_order'][$row['product_id']]['art_nummer'];
    //$orderSent = $row['order_sent'];
    //$tmp = $row['user_basket'];
  }
  var_dump($orderArray);
}
echo '<table>
  <tr>
    <th>Artikel nummer</th>
    <th>Namn</th>
    <th>Pris/st</th>
    <th>Antal</th>
  </tr>';
if(sizeof($orderArray) > 0){
  include 'db.php'; //key = art_num, amount, price
  foreach ($orderArray as $key => $keyvalue) {
    echo '<br> for each key:keyvalue '. $key.':'.$keyvalue['amount'] .' <br>';
    $sql = "SELECT * FROM product WHERE product_id='$keyvalue'";
    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo '<tr><td>'
        . $keyvalue['amount'] . '</td><td>'
        //. /*$orderArray[$key]['art_nummer']*/ $key . '</td><td>'
        . $row['product_name'] . '</td><td>'
        . /*$orderArray[$key]['price']*/ $key. '</td><td>'
        . /*$orderArray[$key]['amount']*/ $key. '</td><td>';
        //. $is_sent . '</td><tr>';
        //. $_SESSION['user_basket'][$i]['price'] . '</td><td>'*/
      }
    } //else {
    //  echo 'databas fel :-(';
    //}
  }
/*
  for($i = 0; $i <= sizeof($orderArray); $i++){
    //echo '<br> for each key:keyvalue '. $key.':'.$keyvalue .' <br>';
    $sql = "SELECT * FROM product WHERE product_id='$keyvalue'";
    $result = mysqli_query($db_conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo $orderArray[$i];
        echo '<tr><td>'
        . /*$orderArray[$key]['art_nummer']*/// $key . '</td><td>'
        //. $row['product_name'] . '</td><td>'
        //. /*$orderArray[$key]['price']*/ $key. '</td><td>'
        //. /*$orderArray[$key]['amount']*/ $key. '</td><td>';
        //. $is_sent . '</td><tr>';
        //. $_SESSION['user_basket'][$i]['price'] . '</td><td>'*/
      //}
  //  } else {
  //    echo 'databas fel :-(';
  //  }
  //}*/
}
echo '</table>';
 ?>
