<?php
  include_once 'header.php';
  include 'includes/like.php';
  include 'includes/comment.php';
?>
    <?php
      include 'includes/db.php';
      $sql = "SELECT * FROM product WHERE product_id = '$_GET[art]'";
      $result = mysqli_query($db_conn, $sql);
      $product_id ='';
      $product_name = '';
      $product_info = '';
      $product_price = '';
      $product_stock = '';
      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              $product_id = $row['product_id'];
              $product_name = $row['product_name'];
              $product_stock = $row['product_stock'];
              $product_price = $row['product_price'];
              $product_info = $row['product_info'];
              $product_desc = $row['product_desc'];
          }
      } else {
          echo '0 results';
      }



      mysqli_close($conn);
    ?>
    <table>
      <tr>
        <th>Artikel nummer</th>
        <th>Namn</th>
        <th>Lager saldo</th>
        <th>Pris</th>
      </tr>
      <?php echo '<tr><td>'
      . $product_id . '</td><td>'
      . $product_name . '</td><td>'
      . $product_stock . '</td><td>'
      . $product_price . ' kr</td><td>';
      if(isset($_SESSION['user_id'])){
      //echo '<a href="includes/basket-add.php?art='. $product_id .'&price=' . $product_price . '">Lägg till</a></td></tr>';
      echo '<form action="includes/basket.php" method="POST">
      <input type="hidden" name="art_nummer" value="'.$product_id.'">
      <input type="hidden" name="product_price" value="'.$product_price.'">
      <input type="hidden" name="product_amount" value="1">
      <button type="submit" name="basket-add">Lägg till</button>
      </form>'
      . '</td></tr>';
    } else {
      echo '</td></tr>';
    }
      ?>

</table>


<div>
  <?php echo '<br>' . getLikes($product_id);

        if(isset($_SESSION['user_id'])){
          getUserLikes($product_id);

        //echo '<a href="?like&art='. $product_id . '">  Gilla!</a>';
      }
  ?>
  <?php /*
  <form action="includes/like.php" method="POST">
    <button type="submit" name="submit">Gilla!</button>
  </form>*/
  ?>
</div>
<div>
  <br><b>Produkt information</b><br>
  <?php echo $product_info ?>
</div>
<div>
  <?php
    echo '<h3>Kommentarer</h2>';
    listComments($product_id);
    if(isset($_SESSION['user_id'])){
      echo '<br>Skriv en kommentar<br>';
      newComment($product_id);
    }
  ?>
  <?php /*
  <form action="includes/comment.php" method="POST">
    <button type="submit" name="submit">Skriv kommentar</button>
  </form> */
  ?>
</div>
<?php
if (isset($_GET['like'])) {
  //echo 'like artikel: ' . $_GET['art'];
  //include 'includes/like.php';
  newLike($_GET['art']);
}
elseif (isset($_GET['newcomment'])) {
  newComment($_GET['art']);
}
elseif (isset($_GET['adminComment'])) {
  adminComment($_GET['commentId']);
}
 ?>
<?php
  include_once 'footer.php';
?>
