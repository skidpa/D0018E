<?php

if(isset($_POST['delete-order'])) {
  delOrder($_POST['order_id']);
  header("Location: ../account.php?adminOrders");
}
if(isset($_POST['send-order'])) {
  adminSendOrder($_POST['order_id']);
  header("Location: ../account.php?adminOrders");
}

function adminMenu(){
  echo '<ul><li><a href="?adminSettings">Inställningar</a></li>
  <li><a href="?adminOrders">Ordrar</a></li>
  <li><a href="?adminOrdersShipped">Skickade Ordrar</a></li>
  <li><a href="?addProduct">Lägg till produkt</a></li>
  <li><a href="?listProduct">Lista produkter</a></li></ul>';
}

function adminOrders(){
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM orders WHERE order_sent='nej'";
  $result = mysqli_query($db_conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Mottagen</th>
      <th>Skickad</th>
      <th></th>
      <th></th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      echo'
      <tr><td>
      <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
      </td><td>'
      . $row['order_date'] . '</td><td>'
      . $row['order_sent'] .'</td><td>'
      //. '<a href="?sendOder&id=' . $row['order_id'] . '">Skicka order '.$row['order_id'].'</a>'
      . '<form action="includes/admin.php" method="POST">
        <input type="hidden" name="order_id" value="'.$row['order_id'].'">
        <button type="submit" name="send-order">Skicka order ' . $row['order_id'] . '</button>
      </form>'
      . '</td><td>'
      //. '<a href="?delOrder&id=' . $row['order_id'] . '">Radera order '.$row['order_id'].'</a>'
      . '<form action="includes/admin.php" method="POST">
        <input type="hidden" name="order_id" value="'.$row['order_id'].'">
        <button type="submit" name="delete-order">Radera order ' . $row['order_id'] . '</button>
      </form>'
      .'</td></tr>';
    }
    echo '</table>';
  } else {
    echo 'Det finns inga ej hanterade ordrar';
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
      <th>Mottagen</th>
      <th>Skickad</th>
      <th>Skickad Datum</th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'
        . $row['order_date'] . '</td><td>'
        . $row['order_sent'] . '</td><td>'
        . $row['order_date_sent'] . '</td></tr>';
    }
    echo '</table>';
  } else {
    echo 'Det finns inga skickade ordrar';
  }
}
function listProduct(){
  echo '<table>
    <tr>
      <th>Artikel nummer</th>
      <th>Namn</th>
      <th>info</th>
      <th>Lager saldo</th>
      <th>Pris</th>
      <th>Visas</th>
      <th></th>
    </tr>';
        include 'db.php';
        $sql = "SELECT * FROM product";
        $result = mysqli_query($db_conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo '<tr><td>'
                . $row['product_id'] . '</td><td>'
                . $row['product_name'] . '</td><td>'
                . $row['product_desc'] . '</td><td>'
                . $row['product_stock'] . '</td><td>'
                . $row['product_price'] . ' kr</td><td>'
                . $row['product_live'] . '</td><td>'
                . '<a href="?editProduct&art=' . $row['product_id'] . '"> Redigera </a></td></tr>';
                /*echo $row['product_tiny'];
                $val = $row['product_tiny']
                /*. if($row['product_tiny'] == true){
                  'Ja';
                } else {
                  'Nej';
                }*/
            }
        } else {
            echo '0 results';
        }

        mysqli_close($conn);

  echo '</table>';

}

function editProduct($art){
  echo 'redigera product';
  echo $art;
  include 'db.php';
  $sql = "SELECT * FROM product WHERE product_id = '$art'";
  $result = mysqli_query($db_conn, $sql);

  /*$id = '';
  $product_name = '';
  $product_desc = '';
  $product_info = '';
  $product_stock = '';
  $product_price = '';
  $product_live = '';*/
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_name = $row['product_name'];
        $product_desc = $row['product_desc'];
        $product_info = $row['product_info'];
        $product_stock = $row['product_stock'];
        $product_price = $row['product_price'];
        $product_live = $row['product_live'];
      }
  } else {
      echo '0 results';
  }

  mysqli_close($db_conn);

  echo '<div class="admin-input">
    <form action="includes/product-edit.php" method="POST">
      namn<input type="text" value="'. $product_name .'" name="product_name"><br>
      beskrivning<input type="text" value="'. $product_desc .'" name="product_desc"><br>
      info<input type="text" value="'. $product_info .'" name="product_info"><br>
      lager<input type="number" value="'. $product_stock .'" name="product_stock"><br>
      pris<input type="number" value="'. $product_price .'" name="product_price"><br>
      visas ja/nej<input type="text" value="'. $product_live .'" name="product_live"><br>
      <input type="hidden" name="product_id" value="'. $product_id .'">
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}

function addProduct(){
  echo 'Lägg till produkt. Är Live som standard';
  echo '<div class="admin-input">
    <form action="includes/product-add.php" method="POST">
      <input type="text" placeholder="Namn" name="product_name"><br>
      <input type="text" placeholder="Produkt Beskrivning" name="product_desc"><br>
      <input type="text" placeholder="Produkt info" name="product_info"><br>
      <input type="number" placeholder="Lager saldo" name="product_stock"><br>
      <input type="number" placeholder="Pris" name="product_price"><br>
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';
}

function delOrder($order_id){
  include 'db.php';
  echo 'orderid'. $order_id;
  $sql = "SELECT orders_details.*, product.product_stock FROM orders_details
  LEFT JOIN product ON orders_details.product_id=product.product_id WHERE order_id='$order_id'";
  $result = mysqli_query($db_conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      //$row = mysqli_fetch_assoc($result);
      echo '<br>stock: ' . $row['product_stock'];
      echo '<br>orderid: ' . $order_id . 'produkt id: '. $row['product_id'] . 'antal: ' . $row['order_amount'];
      $new_stock = $row['order_amount'] + $row['product_stock'];
      echo '<br>nytt lager för : ' .$row['product_id'] . ' är '. $new_stock;
      $sqlupdate = "UPDATE product SET product_stock = '$new_stock'
      WHERE product_id = '$row[product_id]'";
      mysqli_query($db_conn, $sqlupdate);
    }
  }
  $sql2 = "DELETE FROM orders_details WHERE order_id='$order_id'";
  mysqli_query($db_conn, $sql2);
  $sql3 = "DELETE FROM orders WHERE order_id='$order_id'";
  mysqli_query($db_conn, $sql3);
  mysqli_close($db_conn);
  echo 'Order ' . $order_id . ' har tagits bort.';

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
  $send_date = date("Y-m-d H:i:s");
  $sql = "SELECT order_sent FROM orders WHERE order_id = '$order_id'";
  $result = mysqli_query($db_conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo 'iif';
    $sql = "UPDATE orders SET order_sent = 'ja', order_date_sent = '$send_date'
    WHERE order_id='$order_id'";
    mysqli_query($db_conn, $sql);
  }
}
?>
