<?php
  session_start();
  require_once('includes/validate_user.php');
  require_once('includes/db_connect.php');

  $pageTitle = "Profile";
  $current_page = "profile";
?>
<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('includes/navbar-user.php'); ?>
</div>

<div class="container-fluid dashboard-main">

</div>

<?php require_once('includes/footer.php'); ?>
