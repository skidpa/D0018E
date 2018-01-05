<?php

function newComment($art){
  session_start();
  echo '<div class="comment-input">
    <form action="includes/new-comment.php" method="POST">
      <input type="text" placeholder="Användarnamn" value="'. $_SESSION['user_name'].'"name="user_name"><br>
      <input type="text" placeholder="Kommentar" name="comment"><br>
      <input type="hidden" name="art_nummer" value="'. $art . '">
      <button type="submit" name="submit">Ok</button>
    </form>
  </div>';

}

function listComments($art){
  //echo 'list all comments<br>';
  include 'db.php';
  session_start();

  $sql = "SELECT * FROM comments WHERE product_id='$art'";
  $result = mysqli_query($db_conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      while($row = mysqli_fetch_assoc($result)) {
          /*namn
          kommentar
          datum*/
          echo '<div class="comment"><div class="comment-head">'. $row['user_name'] .'</div>
          <div class="comment-content">'. $row['comment_text'] .'</div>';

          echo '<div class="comment-foot">'. $row['comment_date'];
          if($_SESSION['is_admin'] == 1 && $row['comment_reply'] == 'nej'){
            //echo '<a href="?adminComment&commentId='. $row['comment_id'] .'">   Svara</a></div>';
            echo '<br>Svara på denna kommentar';
            adminComment($row['comment_id'], $art);
            echo '</div>';
          }
          echo '</div></div>';
          if($row['comment_reply'] == 'ja'){
            echo '<div class="admin-comment"><div class="admin-reply-head">'. $row['comment_reply_from'] .'</div>
            <div class="admin-reply-content">'. $row['comment_reply_text'].'</div>
            <div class="admin-reply-foot">'.$row['comment_reply_date'] .'</div>';
            echo '</div>';
          } else {
            //echo '</div><br>';
          }
      }
  } else {
      echo 'Det finns inga kommentarer ännu bli först med din!';
  }

  mysqli_close($conn);
}

function adminComment($comment_id, $art){
  session_start();
  //echo 'new comment for: ' . $comment_id;

  echo '<div class="comment-input">
    <form action="includes/comment-admin.php" method="POST">
      <input type="text" placeholder="Användarnamn" value="'. $_SESSION['user_name'].'"name="user_name"><br>
      <input type="text" placeholder="Svars kommentar" name="comment"><br>
      <input type="hidden" name="comment_id" value="'. $comment_id . '">
      <input type="hidden" name="art_nummer" value="'. $art .'">
      <button type="submit" name="submit">Svara</button>
    </form>
  </div>';
}

?>
