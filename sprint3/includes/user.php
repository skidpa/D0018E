<?php
function userMenu(){
  echo '<div class="user"><ul><li><a href="?userSettings">Inställningar</a></li>
  <li><a href="?userOrders">Ordrar</a></li>
  <li><a href="?userOrdersShipped">Skickade Ordrar</a></li></ul></div>';
}

function userOrders($id){
  session_start();
  include 'db.php';
  $sql = "SELECT * FROM orders WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Order datum</th>
      <th>Skickad</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      //echo 'order nummer: '. $row['order_id'];
      if($row['order_sent'] == 'nej'){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'
        . $row['order_date'] . '</td><td>'
        . $row['order_sent'] .'</td></tr>';
      }
    }
    echo '</table>';
  } else {
    echo 'Det finns inga ej hanterade ordrar';
  }
}

function viewOrder($order_id, $is_sent){
  session_start();
  include 'db.php';

  $sql = "SELECT orders_details.*, product.* FROM orders_details
  LEFT JOIN product ON orders_details.product_id=product.product_id WHERE order_id = '$order_id'";
  $result = mysqli_query($db_conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    $order_total ='';
    echo '<table>
      <tr>
        <th>Artikel nummer</th>
        <th>Namn</th>
        <th>Info</th>
        <th>Pris/st</th>
        <th>Antal</th>
      </tr>';
    while($row = mysqli_fetch_assoc($result)){

      echo '<tr><td>'
      . $row['product_id'] . '</td><td>'
      . $row['product_name'] . '</td><td>'
      . $row['product_desc'] . '</td><td>'
      . $row['details_product_price'] . '</td><td>'
      . $row['order_amount'] . '</td></tr>';

      $order_count = ((int)$row['details_product_price']*(int)$row['order_amount']);
      $order_total += $order_count;

    }
    echo '<tr><td>'
    .'Totalt pris: '. $order_total . '</td></tr>';
    echo '</table>';
  }
}

function userOrdersShipped($id){
  //echo 'user ' . $id . ' orders shipped';
  session_start();
  include 'db.php';
  $sql = "SELECT * FROM orders WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Order Datum</th>
      <th>Skickad</th>
      <th>Skickad Datum</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      if($row['order_sent'] == 'ja'){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'
        . $row['order_date'] . '</td><td>'
        . $row['order_sent'] .'</td><td>'
        . $row['order_date_sent'] . '</td></tr>';

      }
    }
    echo '</table>';
  } else {
    echo 'Det finns inga skickade ordrar';
  }
}

function userSettings($id){
  //echo 'user ' . $id . ' settings...';

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
