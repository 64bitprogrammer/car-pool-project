<?php
  session_start();
  require_once('validate_admin.php');
  require_once('../includes/db_connect.php');

  $pageTitle = "Users";
  $current_page = "users_list";
?>
<?php require_once('../includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('../includes/navbar-admin.php'); ?>
</div>

<div class="container-fluid dashboard-main">

</div>

<?php require_once('../includes/footer.php'); ?>
