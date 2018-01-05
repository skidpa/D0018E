<?php
  include_once 'header.php';
?>
<section class="main-container">
  <div class="main-content">
<div class="account-menu">
  <center>

    <?php
    if(isset($_SESSION['user_id'])){
      if($_SESSION['is_admin'] == 1){
        //echo $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is an admin';
        include_once 'includes/admin.php';
        adminMenu();
      } else {
        //echo $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is _NOT_ an admin';
        include_once 'includes/user.php';
        userMenu();
      }
    } else {
      header("Location: index.php");
    }
    ?>
  </center>
</div>
</div>
<div class="main-content">
  <div class="error-notification">
    <center>
      <?php
      if(isset($_GET['emptyfields'])) {
        echo '<h3>Alla fält är inte ifyllda</h3>';
      }
      if(isset($_GET['prodcutfield'])) {
        echo '<h3>Alla fält är inte ifyllda</h3>';
      }
      if(isset($_GET['addedproduct'])) {
        echo '<h3 style="color:green;">Produkt tillagd</h3>';
      }
      if(isset($_GET['productupdate'])) {
        echo '<h3 style="color:green;">Produkt uppdaterad</h3>';
      }
      if(isset($_GET['product_name'])) {
        echo '<h3>Produktnamnet upptaget</h3>';
      }
      if(isset($_GET['accontupdate'])) {
        echo '<h3 style="color:green;">Uppgifter uppdaterade</h3>';
      }
      ?>
    </center>
  </div>
</div>
<div class="main-content">
<div class="main-textarea">
  <center>
  <?php
  if(isset($_SESSION['user_id'])){
    if($_SESSION['is_admin'] == 1){
      if (isset($_GET['adminSettings'])) {
        adminSettings();
      }
      elseif (isset($_GET['adminOrders'])) {
        adminOrders();
      }
      elseif(isset($_GET['viewOder'])){
        adminViewOrder($_GET['id']);
      }
      elseif(isset($_GET['sendOder'])){
        echo $_GET['id'];
        adminSendOrder($_GET['id']);
      }
      elseif (isset($_GET['adminOrdersShipped'])) {
        adminOrdersShipped();
      }
      elseif (isset($_GET['addProduct'])) {
        addProduct();
      }
      elseif (isset($_GET['delOrder'])) {
        delOrder($_GET['id']);
      }
      elseif (isset($_GET['listProduct'])) {
        listProduct();
      }
      elseif (isset($_GET['editProduct'])) {
        editProduct($_GET['art']);
      } else {
        echo 'Välj alternativ ovan';
      }
    } else {
      if (isset($_GET['userSettings'])) {
        userSettings($_SESSION['user_id']);
      }
      elseif (isset($_GET['userOrders'])) {
        userOrders($_SESSION['user_id']);
      }
      elseif(isset($_GET['viewOder'])){
        viewOrder($_GET['id'], $_GET['sent']);
      }
      elseif (isset($_GET['userOrdersShipped'])) {
        userOrdersShipped($_SESSION['user_id']);
      } else {
        echo 'Välj alternativ ovan';
      }
    }
  } else {
    header("Location: index.php");
  }
  ?>
</center>
</div>
</div>
</section>
<?php
  include_once 'footer.php';
?>
