<?php
  session_start();
  require_once('includes/validate_user.php');
  require_once('includes/db_connect.php');

  $pageTitle = "Dashboard";
  $current_page = "dashboard";
?>
<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('includes/navbar-user.php'); ?>
</div>

<div class="container-fluid dashboard-main">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <div class="table-responsive">
      </div>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John</td>
              <td>Doe</td>
              <td>john@example.com</td>
            </tr>
            <tr>
              <td>Mary</td>
              <td>Moe</td>
              <td>mary@example.com</td>
            </tr>
            <tr>
              <td>July</td>
              <td>Dooley</td>
              <td>july@example.com</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>John</td>
              <td>Doe</td>
              <td>john@example.com</td>
            </tr>
            <tr>
              <td>Mary</td>
              <td>Moe</td>
              <td>mary@example.com</td>
            </tr>
            <tr>
              <td>July</td>
              <td>Dooley</td>
              <td>july@example.com</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>
