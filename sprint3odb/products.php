<?php
  include_once 'header.php';
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
    <div clas="main-textarea">
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
    </div>
    <div class="main-textarea">
      <center>
        <table>
          <tr>
            <th>Artikel nummer</th>
            <th>Namn</th>
            <th>info</th>
            <th>Lager saldo</th>
            <th>Pris</th>
            </tr>
            <?php
              include 'includes/db.php';
              $sql = "SELECT * FROM product WHERE product_live='ja'";
              $result = mysqli_query($db_conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                  while($row = mysqli_fetch_assoc($result)) {
                      echo '<tr><td>'
                      . $row['product_id'] . '</td><td>'
                      /*. $row['product_name'] . '</td><td>'*/
                      . '<a href="product-view.php?art=' . $row['product_id'] . '">' . $row['product_name'] . '</a></td><td>'
                      . $row['product_desc'] . '</td><td>'
                      . $row['product_stock'] . '</td><td>'
                      . $row['product_price'] . ' kr</td><td>';
                      if(isset($_SESSION['user_id'])){
                        //echo '<a href="includes/basket-add.php?art='. $row['product_id'] .'&price=' . $row['product_price'] . '">Lägg till</a></td></tr>';
                        echo '<form action="includes/basket.php" method="POST">
                        <input type="hidden" name="art_nummer" value="'.$row['product_id'].'">
                        <input type="hidden" name="product_price" value="'.$row['product_price'].'">
                        <input type="hidden" name="product_amount" value="1">
                        <button type="submit" name="basket-add">Lägg till</button>
                        </form>'
                        . '</td></tr>';
                    } else {
                      echo '</td></tr>';
                    }
                  }
              } else {
                  echo '0 results';
              }

              mysqli_close($db_conn);
            ?>
        </table>
      </center>
    </div>
  </div>
</section>
<?php
  include_once 'footer.php';
?>
