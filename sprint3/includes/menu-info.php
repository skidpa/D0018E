<?php

function getMenu(){
  include 'basket-info.php';
  if(isset($_SESSION['user_id'])){
    echo '<li><a href="shoppingbasket.php">Kundvagn</a></li>
    <li><a href="account.php">Konto</a></li>
    <div class="login-as"><i>inloggad som: ' . $_SESSION['user_name'] . '</i>
    </div><div class="menu-button"><form class="menu-input" action="includes/logout.php" method="POST">
    <button type="submit" name="submit">Logga ut</button>
    </form></div>';
  } else {
    echo '<div class="menu-button"><form class="menu-input"action="includes/login.php" method="POST">
    <input type="text" placeholder="Användarnamn" name="user_name">
    <input type="password" placeholder="Lösenord" name="user_password">
    <button type="submit" name="submit">Logga in</button>
    </form>
    <form action="register-view.php" method="POST">
    <button type="submit" name="submit">Registrera</button>
    </form>
    </div>';
  }
}
