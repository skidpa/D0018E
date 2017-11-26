<?php
  include_once 'header.php';
?>
min sida...

<?php
if(isset($_SESSION['user_id'])){
  if($_SESSION['is_admin'] == 1){
    echo $_SESSION['is_admin'] . $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is an admin';
  } else {
    echo $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is _NOT_ an admin';
  }
} else {
  header("Location: index.php");
}
?>
<?php
  include_once 'footer.php';
?>
