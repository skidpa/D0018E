<?php
  include_once 'header.php';
?>
min sida...<br>

<?php
if(isset($_SESSION['user_id'])){
  if($_SESSION['is_admin'] == 1){
    echo $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is an admin';
    include_once 'includes/admin.php';
    adminMenu();
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
    elseif (isset($_GET['editProduct'])) {
      editProduct();
    } else {
      echo 'Välj alternativ ovan';
    }
  } else {
    echo $_SESSION['user_id'] . ' ' . $_SESSION['user_name'] . ' is _NOT_ an admin';
    include_once 'includes/user.php';
    userMenu();
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
<?php
  include_once 'footer.php';
?>
