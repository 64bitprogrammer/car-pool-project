<?php
session_start();
require_once('lib/phpMailer/sendMail.php');
require_once('includes/db_connect.php');
// each page will need following variables defined
$pageTitle = "Login";
$current_page = "login";
$emailMsg ="";
$passwordMsg ="";

// Handles login process
if(isset($_POST['login-btn'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  $loginQuery = "select user_id,password,email_verified from shri_carpool_users where email='$email' and is_deleted='0'";
  $result = mysqli_query($conn,$loginQuery);
  if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_assoc($result);
    if($row['password'] == md5($password)){
      if($row['email_verified']=='1'){
        $timestamp = date('Y-m-d h:m:s');
        mysqli_query($conn,"update shri_carpool_users set last_login_on='$timestamp', last_login_ip='{$_SERVER['REMOTE_ADDR']}' where user_id={$row['user_id']} and is_deleted='0'");
        $_SESSION['USER_ID'] = $row['user_id'];
        header("Location:".$base_url."dashboard.php");
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

// Handles forgot password process
if(isset($_POST['forgot-btn'])){
  $email = $_POST['forgot-email'];

  $result = mysqli_query($conn,"select *,TIMESTAMPDIFF(MINUTE,reset_sent_stamp,now()) as time_diff from shri_carpool_users where email='$email' and is_deleted='0'");
  if(mysqli_num_rows($result)==1){
    $row = mysqli_fetch_assoc($result);
    if($row['reset_sent_stamp']==0 || intval($row['time_diff'])>60){
      $status = sendRecoveryMail($row['user_id'],$conn);
      if($status =="sent"){
        mysqli_query($conn,"update shri_carpool_users set reset_sent_stamp=now(),reset_expiry=now() + interval 1 hour where email='$email' and is_deleted='0'");
        $_SESSION['RECOVERY-MSG'] =
        "<div class='alert alert-info alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Success!</strong> Account recovery link sent successfully. Please check email.
        </div>";
      }
      else{
        $_SESSION['RECOVERY-MSG'] =
        "<div class='alert alert-warning alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Error!</strong> Could not send recovery mail. Error:[$status]
        </div>";
      }
    }
    else{
      $_SESSION['RECOVERY-MSG'] =
      "<div class='alert alert-warning alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> An reset link was sent recently. Try again later.
      </div>";
    }
  }
  else{
    // Error finding account
    $_SESSION['RECOVERY-MSG'] =
    "<div class='alert alert-danger alert-dismissable'>
      <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Error!</strong> Could not locate your account.
    </div>";
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

      <!-- row for alerts -->
      <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <?php

            if(isset($_SESSION['SIGNUP-MSG'])){
              echo $_SESSION['SIGNUP-MSG'];
              unset($_SESSION['SIGNUP-MSG']);
            }
            if(isset($_SESSION['RECOVERY-MSG'])){
              echo $_SESSION['RECOVERY-MSG'];
              unset($_SESSION['RECOVERY-MSG']);
            }
            if(isset($_SESSION['UPD-PWD-MSG'])){
              echo $_SESSION['UPD-PWD-MSG'];
              unset($_SESSION['UPD-PWD-MSG']);
            }
            if(isset($_SESSION['VERIFY-MSG'])){
              echo $_SESSION['VERIFY-MSG'];
              unset($_SESSION['VERIFY-MSG']);
            }
          ?>
        </div>
        <div class="col-md-2"></div>
      </div> <!-- end of alert div-->

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
<?php require_once('includes/footer.php'); ?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Recover Password</h4>
      </div>
      <div class="modal-body">
        <form method="post" id="forgot-form" onsubmit="return validateForgotForm()">
          <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
              <div class="form-group input-group-sm">
                <lable class="sr-only" for="forgot-email">Registered Email Address</lable>
                <input type="email" name="forgot-email" id="forgot-email" class="form-control" placeholder="Enter registered email address" />
                <span class="text-danger" id="forgot-email-help"></span>
              </div>
              <br>
              <div class="form-group">
                <div class="g-recaptcha" data-sitekey="6LdxHRgUAAAAANbpPOmN15x46x6Yj6VRmInr21Gl"></div>
                <span class="text-danger" id="captcha-help"> </span>
              </div>
            </div>

            <div class="col-md-5"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
        <button type="submit" name="forgot-btn" id="forgot-btn" class="btn btn-primary">Reset Password</button>
        </form>
      </div>
    </div>

  </div>
</div>
