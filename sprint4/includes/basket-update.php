<?php
if(isset($_POST['submit'])){
  session_start();
  $_SESSION['user_basket'][(int)$_POST['art_nummer']]['amount'] = (int)$_POST['amount'];
  header("Location: ../shoppingbasket.php?update=ok");
}
?>
