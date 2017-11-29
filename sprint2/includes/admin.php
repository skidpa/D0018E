<?php
function adminMenu(){
  echo '<ul><li><a href="?adminSettings">Inställningar</a></li>
  <li><a href="?adminOrders">Ordrar</a></li>
  <li><a href="?adminOrdersShipped">Skickade Ordrar</a></li>
  <li><a href="?addProduct">Lägg till produkt</a></li></ul>';
}

function adminOrders(){
  echo 'admin orders...';
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test WHERE order_sent='nej'";
  $result = mysqli_query($db_conn, $sql);
    //or die("Query to retrieve cart failed");

  /*if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      echo 'order nummer: '. $row['order_id'];
      echo'<table>
      <tr>
        <th>Order nummer</th>
        <th>Skickad</th>
      </tr>
      <tr><td>
      <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
      </td><td>'. $row['order_sent'] .'</td></tr>
      </table>';
      //}
    }

  }*/

  if (mysqli_num_rows($result) > 0) {
    echo'<table>
    <tr>
      <th>Order nummer</th>
      <th>Skickad</th>
      <th></th>
    </tr>';
    while($row = mysqli_fetch_assoc($result)){
      //echo 'order nummer: '. $row['order_id'];
      echo'
      <tr><td>
      <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
      </td><td>'. $row['order_sent'] .'</td><td>'
      . '<a href="?sendOder&id=' . $row['order_id'] . '">Skicka order '.$row['order_id'].'</a>'
      .'</td></tr>';

      //}
    }
    //echo '</tr></table>';
    echo '</table>';
  }
}

function adminViewOrder($id){
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test WHERE order_id = '$id'";
  $result = mysqli_query($db_conn, $sql);
  //  or die("Query to retrieve cart failed");
  $orderSent = '';
  if(!isset($_SESSION['view_order'])){
    $_SESSION['view_order'] = array();
  }
  if (mysqli_num_rows($result) > 0) {
    //die("Cart not found !");
    while($row = mysqli_fetch_assoc($result)){
      $_SESSION['view_order'] = unserialize($row['order_details']);
      $orderSent = $row['order_sent'];
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
          . $orderSent . '</td><tr>';
          //. $_SESSION['user_basket'][$i]['price'] . '</td><td>'*/
        }
      } else {
        echo 'databas fel :-(';
      }
    }
  }
  echo '</table>';
}

function adminOrdersShipped(){
  echo 'admin orders shipped';
  session_start(); // dont forget!
  include 'db.php';
  $sql = "SELECT * FROM or_test WHERE order_sent='ja'";
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
      //if($row['order_sent'] == 'ja'){
        echo'
        <tr><td>
        <a href="?viewOder&id=' . $row['order_id'] . '">Order nummer: '.$row['order_id'].'</a>
        </td><td>'. $row['order_sent'] .'</td></tr>';

      //}
    }
    //echo '</tr></table>';
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

function adminSettings(){ // ska ta user id
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
  session_start(); // dont forget!
  echo $order_id;
  include 'db.php';
  $sql = "SELECT order_sent FROM or_test WHERE order_id = '$order_id'";
  $result = mysqli_query($db_conn, $sql);
  //  or die("Query to retrieve cart failed");
  if (mysqli_num_rows($result) > 0) {
    echo 'iif';
    //die("Cart not found !");
    $sql = "UPDATE or_test SET order_sent = 'ja'
    WHERE order_id='$order_id'";
    mysqli_query($db_conn, $sql);
    /*while($row = mysqli_fetch_assoc($result)){
      $_SESSION['view_order'] = unserialize($row['order_details']);
      $orderSent = $row['order_sent'];
      //$tmp = $row['user_basket'];
    }*/

  }
}
?>
