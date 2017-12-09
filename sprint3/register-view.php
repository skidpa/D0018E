<?php
  include_once 'header.php';
?>
registrera...


<div class="register-input">
  <form action="includes/register.php" method="POST">
    <input type="text" placeholder="Användarnamn" name="user_name"><br>
    <input type="password" placeholder="Lösenord" name="user_password"><br>
    <input type="text" placeholder="Address" name="user_address"><br>
    <input type="text" placeholder="email" name="user_email"><br>
    <button type="submit" name="submit">Ok</button>
  </form>
</div>


<?php
  include_once 'footer.php';
?>
