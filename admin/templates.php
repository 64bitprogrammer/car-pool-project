<?php
  session_start();
  require_once('validate_admin.php');
  require_once('../includes/db_connect.php');

  $pageTitle = "Email Templates";
  $current_page = "templates";

  $result = mysqli_query($conn,"select * from shri_carpool_email_templates");
?>
<?php require_once('../includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('../includes/navbar-admin.php'); ?>
</div>



<div class="container-fluid dashboard-main">
  <div class="row">
    <div class="col-md-2">
    </div>

    <div class="col-md-8">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Subject</th>
              <th>Tags</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result)){
              ?>
              <tr>
                <td> <?php echo $row['template_id'];?> </td>
                <td> <?php echo $row['subject'];?> </td>
                <td> <?php echo $row['tags'];?> </td>
                <td> <a href="#">Edit</a> &nbsp; <a href="#"> Delete </delete> </td>
              </tr>
              <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="col-md-2 text-center">
      <button onclick="location.href='add_email_template.php'" class="btn btn-primary">Add Email Template</button>
    </div>
  </div>
</div>

<?php require_once('../includes/footer.php'); ?>
