<?php
if(isset($_POST['submit'])){
  session_start();
  //echo '<br> session.. ' . $_SESSION['user_basket'][(int)$_POST['art_nummer']]['amount'];
  $_SESSION['user_basket'][(int)$_POST['art_nummer']]['amount'] = (int)$_POST['amount'];
  //echo '<br> session.. ' . $_SESSION['user_basket'][(int)$_POST['art_nummer']]['amount'];

  header("Location: ../shoppingbasket.php?update=ok");
}
?>
