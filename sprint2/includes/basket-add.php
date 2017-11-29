<?php
session_start();

if(!isset($_SESSION['user_basket'])){
  $_SESSION['user_basket'] = array();
}

if(array_key_exists($_GET['art'], $_SESSION['user_basket'])){
  echo '<br>finns redan<br>';
  $_SESSION['user_basket'][$_GET['art']]['amount']++;
  header("Location: ../products.php?fanns");
} else {
  echo '<br> fanns inte lägger till<br>';
  $_SESSION['user_basket'][$_GET['art']] = array('art_nummer' => $_GET['art'], 'amount' => 1, 'price' => $_GET['price']);
  header("Location: ../products.php?fannsinte");
}
//$_SESSION['user_basket'][$_GET['art']] = array('art_nummer'=>$_GET['art'], 'amount' =>1, 'price' => $_GET['price']);

//header("Location: ../products.php?prodctadded=ok")

?>
