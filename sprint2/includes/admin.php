<?php
function adminMenu(){
  echo '<ul><li><a href="?adminSettings">Inställningar</a></li>
  <li><a href="?adminOrders">Ordrar</a></li>
  <li><a href="?adminOrdersShipped">Skickade Ordrar</a></li>
  <li><a href="?addProduct">Lägg till produkt</a></li></ul>
  <li><a href="?editProduct">Redigera produkt</a></li></ul>';
}

function adminOrders(){
  echo 'admin orders...';
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM orders WHERE order_sent='nej'";
  $result = mysqli_query($db_conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Skickad</th>
      <th></th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      echo'
      <tr><td>
      <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
      </td><td>'. $row['order_sent'] .'</td><td>'
      . '<a href="?sendOder&id=' . $row['order_id'] . '">Skicka order '.$row['order_id'].'</a>'
      .'</td></tr>';
    }
    echo '</table>';
  }
}

function adminViewOrder($order_id){
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
      . $row['product_info'] . '</td><td>'
      . $row['product_price'] . '</td><td>'
      . $row['order_amount'] . '</td></tr>';


      $order_count = ((int)$row['product_price']*(int)$row['order_amount']);
      $order_total += $order_count;

    }
    echo '<tr><td>'
    .'Totalt pris: '. $order_total . '</td></tr>';
    echo '</table>';

  }
}

function adminOrdersShipped(){
  echo 'admin orders shipped';
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM orders WHERE order_sent='ja'";
  $result = mysqli_query($db_conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Skickad</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'. $row['order_sent'] .'</td></tr>';
    }
    echo '</table>';
  }
}

function addProduct(){
  echo 'add product';
  echo '<div class="admin-input">
    <form action="includes/product-add.php" method="POST">
      <input type="text" placeholder="Namn" name="product_name"><br>
      <input type="text" placeholder="Produkt info" name="product_info"><br>
      <input type="number" placeholder="Lager saldo" name="product_stock"><br>
      <input type="number" placeholder="Pris" name="product_price"><br>
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}
function editProduct(){
  echo 'add product';
  echo '<div class="admin-input">
    <form action="includes/product-edit.php" method="POST">
      <input type="text" placeholder="Namn" name="product_name"><br>
      <input type="text" placeholder="Produkt info" name="product_info"><br>
      <input type="number" placeholder="Lager saldo" name="product_stock"><br>
      <input type="number" placeholder="Pris" name="product_price"><br>
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}

function adminSettings(){
  echo 'admin settings...';
  echo '<div class="admin-input">
    <form action="includes/admin-update.php" method="POST">
      <input type="text" value="' . $_SESSION['user_name'] . '" placeholder="Användarnamn" name="user_name"><br>
      <input type="password" placeholder="Lösenord" name="user_password"><br>
      <input type="text" value="' . $_SESSION['user_address'] . '" placeholder="Address" name="user_address"><br>
      <input type="text" value="' . $_SESSION['user_email'] . '" placeholder="email" name="user_email"><br>
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}

function adminSendOrder($order_id){
  session_start();
  echo $order_id;
  include 'db.php';
  $sql = "SELECT order_sent FROM orders WHERE order_id = '$order_id'";
  $result = mysqli_query($db_conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 'iif';
    $sql = "UPDATE orders SET order_sent = 'ja'
    WHERE order_id='$order_id'";
    mysqli_query($db_conn, $sql);
  }
}
?>
