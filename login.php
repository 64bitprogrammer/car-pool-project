<?php
session_start();
require_once('includes/db_connect.php');
// each page will need following variables defined
$pageTitle = "Login";
$current_page = "login";
$emailMsg ="";
$passwordMsg ="";
?>

<?php
  if(isset($_POST['login-btn'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginQuery = "select user_id,password,email_verified from shri_users where email='$email' and is_deleted='0'";
    if($result = mysqli_query($conn,$loginQuery)){
      $row = mysqli_fetch_assoc($result);
      if($row['password'] == md5($password)){
        if($row['email_verified']=='1'){
          $_SESSION['USER_ID'] = $row['user_id'];
          header("location:dashboard.php");
        }
        else{
          $passwordMsg = "Your email has not been verified yet, Click <a href='".$base_url."verify.php' target='_blank'>here</a> to verify your email address.";
        }
      }
      else{
        $passwordMsg = "Incorrect password ";
      }
    }
    else{
      $passwordMsg = "Incorrect email or password ";
    }
  }
?>

<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('includes/navbar.php'); ?>
</div>

<div class="container-fluid">

  <div class="row">

    <div class="col-sm-2 my-rows"></div>

    <div class="col-sm-8 my-rows">
        <div class="row">
          <div class="col-sm-3 my-rows">
          </div>

          <div class="col-sm-6 my-rows">
            <h3> Login </h3>
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
                <label><a class="" id="forgot-password"> Forgot Password </a></label>
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

<?php require_once('includes/footer.php'); ?>
