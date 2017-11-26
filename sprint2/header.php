<?php
  session_start();
  include_once 'includes/menu-info.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="includes/style.css">
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="index.php">Start</a></li>
        <li><a href="products.php">Produkter</a></li>
        <?php include getMenu(); ?>
      </ul>
    </nav>
  </header>
