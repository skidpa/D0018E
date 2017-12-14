<?php
  include_once 'header.php';
  include 'basket-remove.php';
  //include_once 'includes/basket.php';
?>

<section class="main-container">
  <div class="main-content">
  <div class="error-notification">
    <center>
      <?php
      if(isset($_GET['error1'])) {
        echo '<h3> fel andvändarnamn eller lösenord</h3>';
      }
      if(isset($_GET['empty'])) {
        echo '<h3>Alla fält är inte ifyllda</h3>';
      }
      if(isset($_GET['usertaken'])) {
        echo '<h3>användarnamnet upptaget</h3>';
      }
      ?>
    </center>
  </div>
</div>
  <div class="main-content">
    <div class="main-textarea">
      <center>
<?php
  //echo 'wtf';
  include 'includes/db.php';
  //echo 'wtf2';
  include_once 'includes/price-update.php';
  //echo "wtf3";
  /*$sql = "SELECT basket_tmp.*, product.product_price FROM basket_tmp
  LEFT JOIN product ON basket_tmp.product_id=product.product_id WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      //getCheapPrice($row['product_id'], $row['product_price']);
      //echo 'basket pris: ' . $row['basket_product_price'] . '  produkt pris: ' . $row['product_price'] . '<br>';
      if($row['product_price'] < $row['basket_product_price']){
        echo 'billigare för id ' . $row['product_id']. ' basket pris: ' . $row['basket_product_price'] . '  produkt pris: ' . $row['product_price'] . '<br>';
        /*$sqlUpdate = "UPDATE basket_tmp SET baskt_product_price='$row[product_price]'
        WHERE user_id='$_SESSION[user_id]' AND product_id='$row[product_id]'";
        mysqli_query($db_conn, $sqlUpdate);
        echo 'userid ' . $_SESSION['user_id'] . '<br>';
        $sql = "UPDATE basket_tmp SET basket_product_price=10
        WHERE user_id=3 AND product_id=3";
        //mysqli_query($db_conn, $sql);
      }

    }
  }*/
  getCheapPrice();
  //echo 'wtf4';
  $sql = "SELECT basket_tmp.*, product.product_name, product.product_stock, product.product_price FROM basket_tmp
  LEFT JOIN product ON basket_tmp.product_id=product.product_id WHERE user_id = '$_SESSION[user_id]'";
  $result = mysqli_query($db_conn, $sql);
  //echo 'wtf5';
  $basket_empty = mysqli_num_rows($result);
  //echo 'wtf6';
  if($basket_empty > 0){
    $order_total = '';
    echo '<table>
      <tr>
        <th>Artikel nummer</th>
        <th>Namn</th>
        <th>Lager saldo</th>
        <th>Pris/st</th>
        <th>Antal</th>
        <th></th>
      </tr>';
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
        echo '<tr><td>'
            . $row['product_id'] . '</td><td>'
            . $row['product_name'] . '</td><td>'
            . $row['product_stock'] . '</td><td>'
            . $row['basket_product_price'] . '</td><td>'
            //. $row['product_amount'] . '</td><td>'
            . '<form action="includes/basket.php" method="POST">
            <input type="number" placeholder="antal" name="product_amount" value="' . $row['product_amount'] . '">
            <input type="hidden" name="art_nummer" value="'. $row['product_id'] .'">
            <input type="submit" name="basket-update" value="Uppdatera">
            </form></td><td>'
            . '<form action="includes/basket.php" method="POST">
            <input type="hidden" name="art_nummer" value="'. $row['product_id'] .'">
            <input type="submit" name="basket-remove" value="Ta bort">
            </form></td></tr>';

            $order_count = ((int)$row['basket_product_price']*(int)$row['product_amount']);
            $order_total += $order_count;
      }
      echo '<tr><td>'
      .'Totalt pris: '. $order_total . '</td></tr>';
      echo '</table>';
    }
    //echo ' </table>';
    //echo 'totalt pris: ' . $order_total;
    echo '<form action="includes/basket.php" method="POST">
      <button type="submit" name="basket-clear">Töm kundvagn</button>
    </form>
    <form action="includes/order-send.php" method="POST">
      <button type="submit" name="submit">Skicka Order</button>
    </form>';
  } else {
    echo '<br>Din kundvagn är tom';
  }
?>
</table>
</center>
</div>
</div>
</section>
<?php
  include_once 'footer.php';
?>
