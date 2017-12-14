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
  <div class="main-textarea">
    <center>
<div class="register-input">
  <form action="includes/register.php" method="POST">
    <input type="text" placeholder="Användarnamn" name="user_name"><br>
    <input type="password" placeholder="Lösenord" name="user_password"><br>
    <input type="text" placeholder="Address" name="user_address"><br>
    <input type="text" placeholder="email" name="user_email"><br>
    <button type="submit" name="submit">Ok</button>
  </form>
</div>
</center>
</div>
</div>
</section>


<?php
  include_once 'footer.php';
?>
