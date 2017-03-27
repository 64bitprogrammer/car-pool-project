<?php
session_start();
require_once('../includes/db_connect.php');
// each page will need following variables defined
$pageTitle = "Admin Login";
$current_page = "login";
$emailMsg ="";
$passwordMsg ="";

// Handles admin login process
if(isset($_POST['login-btn'])){
  if($_POST['email']!="" && $_POST['password']!=""){
    $result = mysqli_query($conn,"select * from shri_carpool_administration where email='{$_POST['email']}' and is_deleted='0'");
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_assoc($result);
      if($row['password'] == md5($_POST['password'])){
        $timestamp = date('Y-m-d h:m:s');
        mysqli_query($conn,"update shri_carpool_administration set last_login_on='' and last_login_ip='' where email='{$_POST['email']}' and is_deleted='0'");
        $_SESSION['ADMIN-ID'] = $row['id'];
        header("Location:".$base_url."admin/dashboard.php");
      }
      else{
        $passwordMsg = "Incorrect password !";
      }
    }
    else{
      $emailMsg = "Incorrect username ";
    }
  }
  else{
    $passwordMsg = "Please enter a username and a password ";
  }
}
?>

<?php require_once('../includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('../includes/empty-navbar.php'); ?>
</div>

<div class="container-fluid">

  <div class="row">

    <div class="col-sm-2 my-rows"></div>

    <div class="col-sm-8 my-rows">

      <!-- row for alerts -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <?php
            if(isset($_SESSION['ADMIN-MSG'])){
              echo $_SESSION['ADMIN-MSG'];
              unset($_SESSION['ADMIN-MSG']);
            }
          ?>
        </div>
        <div class="col-md-2"></div>
      </div> <!-- end of alert div-->

        <div class="row">
          <div class="col-sm-3 my-rows">
          </div>

          <div class="col-sm-6 my-rows">
            <h3> Admin Login </h3>
            <form action="" method="post" class="login-form " id="login-form" onsubmit="return validateLoginForm()">
            <br><br><br>
            <div class="form-group">
              <label class="control-label col-sm-2 sr-only" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                <span class="text-danger" id="email-help"><?=$emailMsg?></span>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <label class="control-label col-sm-2 sr-only" for="password">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <span class="text-danger" id="password-help"><?=$passwordMsg?></span>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <div class="checkbox">
                  <label><input type="checkbox"> Remember me</label>
                </div>
              </div>
            </div>
            <br><br><br>
            <div class="form-group">
              <div class="col-sm-offset-0 col-sm-10">
                <label><a class="" id="forgot-password" data-toggle="modal" data-target="#myModal"> Forgot Password </a></label>
                <button type="submit" id="login-btn" name="login-btn" class="btn btn-primary col-sm-offset-1">Login</button>
              </div>
            </div>
            <br>
            </form>
          </div>

          <div class="col-sm-3 my-rows">
          </div>
        </div>

    </div> <!-- end of center column -->

    <div class="col-sm-2 my-rows"></div>
  </div> <!-- end of row -->

</div> <!-- end of container -->
<br><br><br>
<!-- Modal -->
<?php require_once('../includes/footer.php'); ?>
