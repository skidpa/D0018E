<?php
if(isset($_POST['submit'])){
  session_start();
  include 'db.php';
  $sql = "SELECT user_basket FROM basket WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $_SESSION['user_basket'] = unserialize($row['user_basket']);
    }
    header("Location: ../shoppingbasket.php?basketload=ok");
  } else {
    header("Location: ../shoppingbasket.php?nobasket");
  }
}

?>
