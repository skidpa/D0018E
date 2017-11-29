<?php
function userMenu(){
  echo '<ul><li><a href="?userSettings">Inställningar</a></li>
  <li><a href="?userOrders">Ordrar</a></li>
  <li><a href="?userOrdersShipped">Skickade Ordrar</a></li></ul>';
}

function userOrders($id){
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
    //or die("Query to retrieve cart failed");

  /*if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      //$orderSent = '';
      //$orderSent = $row['order_sent'];
      echo'
      <a href="?viewOder&id=' . $row['order_id'] . '&sent=' . $row['order_sent'] . '">Order nummer: '.$row['order_id'].'</a>';
    }

  }*/
  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Skickad</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      //echo 'order nummer: '. $row['order_id'];
      if($row['order_sent'] == 'nej'){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'. $row['order_sent'] .'</td></tr>';

      }
    }
    //echo '</tr></table>';
    echo '</table>';
  }
}

function viewOrder($order_id, $is_sent){
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test_details WHERE order_id = '$order_id'";
  $result = mysqli_query($db_conn, $sql);
  //  or die("Query to retrieve cart failed");
  $orderSent = '';
  if(!isset($_SESSION['view_order'])){
    $_SESSION['view_order'] = array();
  }
  if (mysqli_num_rows($result) > 0) {
    echo 'if';
    //die("Cart not found !");
    while($row = mysqli_fetch_assoc($result)){
      echo 'while';
      $orderArray = array('art_nummer' => $row['product_id'], 'amount' => $row['order_amount'], 'price' => $row['product_price']);
      var_dump($_SESSION['view_order']);
      //echo $_SESSION['view_order'][$row['product_id']]['art_nummer'];
      //$orderSent = $row['order_sent'];
      //$tmp = $row['user_basket'];
    }

  }
  echo '<table>
    <tr>
      <th>Artikel nummer</th>
      <th>Namn</th>
      <th>Pris/st</th>
      <th>Antal</th>
      <th>Skickad</th>
    </tr>';
  if(sizeof($_SESSION['view_order']) > 0){
    include 'db.php';
    foreach ($_SESSION['view_order'] as $key => $keyvalue) {
      $sql = "SELECT * FROM product WHERE product_id='$key'";
      $result = mysqli_query($db_conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
          echo '<tr><td>'
          . $_SESSION['view_order'][$key]['art_nummer'] . '</td><td>'
          . $row['product_name'] . '</td><td>'
          . $_SESSION['view_order'][$key]['price'] . '</td><td>'
          . $_SESSION['view_order'][$key]['amount'] . '</td><td>'
          . $is_sent . '</td><tr>';
          //. $_SESSION['user_basket'][$i]['price'] . '</td><td>'*/
        }
      } else {
        echo 'databas fel :-(';
      }
    }
  }
  echo '</table>';
}

function userOrdersShipped($id){
  echo 'user ' . $id . ' orders shipped';
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
    //or die("Query to retrieve cart failed");

  /*if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      //$orderSent = '';
      //$orderSent = $row['order_sent'];
      echo'
      <a href="?viewOder&id=' . $row['order_id'] . '&sent=' . $row['order_sent'] . '">Order nummer: '.$row['order_id'].'</a>';
    }

  }*/
  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Skickad</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      //echo 'order nummer: '. $row['order_id'];
      if($row['order_sent'] == 'ja'){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'. $row['order_sent'] .'</td></tr>';

      }
    }
    //echo '</tr></table>';
    echo '</table>';
  }
}

function userSettings($id){ // ska ta user id
  echo 'user ' . $id . ' settings...';

  echo '<div class="register-input">
    <form action="includes/user-update.php" method="POST">
      <input type="text" value="' . $_SESSION['user_name'] . '" placeholder="Användarnamn" name="user_name"><br>
      <input type="password" placeholder="Lösenord" name="user_password"><br>
      <input type="text" value="' . $_SESSION['user_address'] . '" placeholder="Address" name="user_address"><br>
      <input type="text" value="' . $_SESSION['user_email'] . '" placeholder="email" name="user_email"><br>
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}
?>
