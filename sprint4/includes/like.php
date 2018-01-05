<?php

function newLike($art){
  echo 'gilla artikel: ' . $art;
  session_start();

  include 'db.php';

  //$sql = "SELECT * FROM likes";
  $sql = "INSERT INTO likes (user_id, product_id, is_liked)
  VALUES ('$_SESSION[user_id]', '$art', 'ja')";
  mysqli_query($db_conn, $sql);
  header("Location: product-view.php?art=". $art);

}

function getUserLikes($art){
  /*
  kollar bara om mitt id finns i databasen för art nummret
  */
  session_start();
  include 'db.php';
  $sql = "SELECT * FROM likes WHERE user_id='$_SESSION[user_id]' AND product_id='$art'";
  $result = mysqli_query($db_conn, $sql);


  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      //echo '<br> user_id: '. $row['user_id'] . ' gillar produkten: ' . $row['product_id'] . '  '. $row['is_liked'] . '<br>';
      echo 'Du har gillat denna vara';
    }
  } else {
    // om inga likes för produkten finns
    //echo '<a href="?like&art='. $art . '">  Gilla!</a>';
    echo '<form action="includes/new-like.php" method="POST">
      <input type="hidden" name="art_nummer" value="'. $art . '">
      <button type="submit" name="new-like">Gilla!</button>
    </form>';
  }
}

function getLikes($art){
  include 'db.php';
  $sql = "SELECT is_liked FROM likes WHERE product_id='$art'";
  $result = mysqli_query($db_conn, $sql);
  //echo mysqli_num_rows($result) . 'st gillar denna vara';

  if(mysqli_num_rows($result) > 0){
    echo mysqli_num_rows($result) . ' st gillar denna vara';
  } else {
    echo 'Ingen har gillat denna vara änn.';
  }

  /*if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
      echo $row['is_liked'];
      behövs om man ska kunna ogilla också..
      annars verkar det räcka att räkna rader.
    }
  }*/

}
?>
