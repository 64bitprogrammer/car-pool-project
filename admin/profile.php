<?php
  session_start();
  require_once('validate_admin.php');
  require_once('../includes/db_connect.php');

  $pageTitle = "Profile";
  $current_page = "profile";
?>
<?php require_once('../includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('../includes/navbar-admin.php'); ?>
</div>

<div class="container-fluid dashboard-main">
  <div class="row"> <!-- tab panel row-->
    <div class="col-md-3"></div>

    <div class="col-md-6">
      <br><br>
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
        <li><a data-toggle="tab" href="#menu1">Update Password</a></li>
        <li><a data-toggle="tab" href="#menu2">Add Admin</a></li>
        <li><a data-toggle="tab" href="#menu3"></a></li>
      </ul>

      <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
          <h3>HOME</h3>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
          <h3>Menu 1</h3>
          <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
        <div id="menu2" class="tab-pane fade">
          <h3>Menu 2</h3>
          <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div id="menu3" class="tab-pane fade">
          <h3>Menu 3</h3>
          <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
        </div>
      </div>
    </div>
    <div class="col-md-3"></div>
  </div> <!-- end of main row -->
</div>

<?php require_once('../includes/footer.php'); ?>
