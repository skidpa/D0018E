<?php
  include_once 'header.php';
  include 'basket-remove.php';
?>

<table>
  <tr>
    <th>Artikel nummer</th>
    <th>Namn</th>
    <th>Lager saldo</th>
    <th>Pris/st</th>
    <th>Antal</th>
  </tr>
<?php
if(sizeof($_SESSION['user_basket']) > 0){
  include 'includes/db.php';
  foreach ($_SESSION['user_basket'] as $key => $keyvalue) {
    $sql = "SELECT * FROM product WHERE product_id='$key'";
    $result = mysqli_query($db_conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)){
        echo '<tr><td>'
        . $_SESSION['user_basket'][$key]['art_nummer'] . '</td><td>'
        . $row['product_name'] . '</td><td>'
        . $row['product_stock'] .  '</td><td>'
        . $_SESSION['user_basket'][$key]['price'] . '</td><td>'
        . '<form action="includes/basket-update.php" method="POST">
        <input type="number" placeholder="antal" name="amount" value="' . $_SESSION['user_basket'][$key]['amount'] . '">
        <input type="hidden" name="art_nummer" value="'. $_SESSION['user_basket'][$key]['art_nummer'] .'">
        <input type="submit" name="submit" value="Uppdatera">
        </form></td><td>'
        . '<a href="includes/basket-remove.php?art='. $_SESSION['user_basket'][$key]['art_nummer'] . '">Ta bort</a></td><tr>';
      }
    } else {
      echo 'databas fel :-(';
    }
  }
}
?>
</table>
<form action="includes/basket-save.php" method="POST">
  <button type="submit" name="submit">Spara kundvagn</button>
</form>
<form action="includes/basket-load.php" method="POST">
  <button type="submit" name="submit">Ladda kundvagn</button>
</form>
<form action="includes/order-send.php" method="POST">
  <button type="submit" name="submit">Skicka Order</button>
</form>
<a href="includes/basket-remove.php?basket=clear">Töm kundvagnen</a>


<?php
  include_once 'footer.php';
?>
