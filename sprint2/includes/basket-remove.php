<?php
session_start();

function basketClear(){
  echo 'dump före<br>';
  var_dump($_SESSION['user_basket']);
  echo '<br> före foreach <br>';
  foreach ($_SESSION['user_basket'] as $key => $keyvalue){
    echo '<br> inne i foreach <br>';
    echo 'foreach key: ' . $key . '<br>';
    echo 'key art: ' . $_SESSION['user_basket'][$key]['art_nummer'];
    echo 'key art: ' . $keyvalue['art_nummer'];
    unset($_SESSION['user_basket'][$key]);
  }
  echo '<br><br>dump efter<br>';
  var_dump($_SESSION['user_basket']);
  //$_SESSION['user_basket']=array_values($_SESSION['user_basket']);
}


function basketRemove($art){
  echo 'dump före<br>';
  var_dump($_SESSION['user_basket']);
  echo '<br> före foreach <br>';
  foreach ($_SESSION['user_basket'] as $key => $keyvalue){
    echo '<br> inne i foreach <br>';
    echo 'foreach key: ' . $key . '<br>';
    echo 'key art: ' . $_SESSION['user_basket'][$key]['art_nummer'];
    echo 'key art: ' . $keyvalue['art_nummer'];
    if($art == $keyvalue['art_nummer']){
      echo '<br>foreach  if<br>';
      echo $key;
      echo ':';
      echo $keyvalue;
      echo '<br/>';
      unset($_SESSION['user_basket'][$key]);
      }
  }
  echo '<br><br>dump efter<br>';
  var_dump($_SESSION['user_basket']);
  //$_SESSION['user_basket']=array_values($_SESSION['user_basket']);
}

if($_GET['basket'] == 'clear'){
  basketClear();
  echo '<br><br> klar';
  header("Location: ../shoppingbasket.php?basketclear=ok");
}
elseif($_GET['art']){
  echo '<br> remove_product art '. $_GET['art'] . '<br>';
  //basketRemove($_GET['art']);
  basketRemove($_GET['art']);
  echo '<br><br> klar';
  header("Location: ../shoppingbasket.php?artremove=ok");
}
?>
