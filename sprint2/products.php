<?php
  include_once 'header.php';
?>
produkt sida...
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
      $sql = "SELECT * FROM product";
      $result = mysqli_query($db_conn, $sql);

      if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
              echo '<tr><td>'
              . $row['product_id'] . '</td><td>'
              . $row['product_name'] . '</td><td>'
              . $row['product_info'] . '</td><td>'
              . $row['product_stock'] . '</td><td>'
              . $row['product_price'] . ' kr</td><td>
              <a href="includes/basket-add.php?art='. $row['product_id'] .'&price=' . $row['product_price'] . '">Lägg till</a></td></tr>';
          }
      } else {
          echo '0 results';
      }

      mysqli_close($conn);
    ?>
</table>
<?php
  include_once 'footer.php';
?>
