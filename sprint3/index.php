<?php
  include_once 'header.php';
?>
<section class="main-container">
  <div class="main-content">
    <div clas="main-textarea">
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
    <div class="main-textarea">
      <center>
        admin/admin<br>
        test/test<br>
        test2/test2<br>
      </center>
    </div>
  </div>
</section>
<?php
  include_once 'footer.php';
?>
