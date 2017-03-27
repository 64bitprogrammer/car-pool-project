<?php
session_start();
require_once('lib/phpMailer/sendMail.php');
require_once('includes/db_connect.php');

$pageTitle = "Email Verification";
$alert_type = "";
$current_page ="verify";
$notificationBoxContent = "";

// Executed when user lands from verification page
if(isset($_GET['email']) && isset($_GET['token'])){
  $email = $_GET['email'];
  $token = base64_decode($_GET['token']);

  $result = mysqli_query($conn,"select user_id,email_verified,email_token from shri_carpool_users where email='$email' and is_deleted='0'");

  if(mysqli_num_rows($result)>=1){
    $row = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>=1){
      if($row['email_token'] == $token){

        if($row['email_verified']=='0'){
          if(mysqli_query($conn,"update shri_carpool_users set email_verified='1' where user_id={$row['user_id']} and is_deleted='0'")){
            $alert_type ="success";
            $notificationMsg = "Email account &nbsp;&nbsp;<code>$email</code>&nbsp;&nbsp; successfully verified !";
          }
          else{
            $alert_type ="error";
            $notificationMsg = "Error while updating the verification status".mysqli_error($conn);
          }
        }
        else{
          $alert_type ="success";
          $notificationMsg = "Email account &nbsp;&nbsp;<code>$email</code>&nbsp;&nbsp; already verified !";
        }
      }
      else{
        $alert_type ="error";
        $notificationMsg = "Invalid verification token !";
      }
    }
    else{
      $alert_type ="error";
      $notificationMsg = "No verification mail sent, Click <a href='".$base_url."verify.php' target='_blank'>here</a> to verify your email address.";
    }
  }
  else{
    $alert_type ="error";
    $notificationMsg = "Account with the address &nbsp;&nbsp; <code> $email </code> &nbsp;&nbsp; is not registered. Please register your email first.";
  }

  if($alert_type=="success"){
    $_SESSION['VERIFY-MSG'] =
    "<div class='alert alert-info alert-dismissable'>
      <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Success!</strong> $notificationMsg
    </div>";
  }
  else if($alert_type !=""){
    $_SESSION['VERIFY-MSG'] =
    "<div class='alert alert-danger alert-dismissable'>
      <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Error!</strong> $notificationMsg
    </div>";
  }
  header("Location:".$base_url."login.php");
} // End of post

// Send verification mail to the user
if(isset($_POST['verify-btn'])){
  $email = $_POST['verify_email'];

  $result = mysqli_query($conn,"select * from shri_carpool_users where email='$email' and is_deleted='0'");
  $row = mysqli_fetch_assoc($result);
  if($row['email_verified']=='0'){
    $status = sendVerificationMail($email,$conn);
    if($status=="sent"){
      $notificationBoxContent =
      "<div class='alert alert-info alert-dismissable'>
        <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> Verification mail sent successfully to &nbsp;<code>$email</code>
      </div>";
    }
    else{
      $notificationBoxContent =
      "<div class='alert alert-error alert-dismissable'>
        <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> Technical problem in sending verification mail. Try again later.
      </div>";
    }
  }
  else{
    $notificationBoxContent =
    "<div class='alert alert-warning alert-dismissable'>
      <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Note!</strong> Your email address has already been verified !
    </div>";
  }
}
?>

<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('includes/navbar.php'); ?>
</div>

<div class="container-fluid" style="min-height:76%;">

  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="notification-box">
            <?=$notificationBoxContent?>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <h3> Verify Email Address </h3><br>
            <form method="post" action="verify.php" onsubmit="return validateVerificationFields()" name="verify-form">
              <div class="form-group">
                <label class="control-label col-sm-2 sr-only" for="verify_email">Email:</label>
                <div class="col-md-11">
                  <input class="form-control" type="email" id="verify_email" name="verify_email" placeholder="Enter email address to verify ">
                  <span id="verify_email-help" class="text-danger"><span>
                </div>
              </div>
              <br><Br><Br>
              <div class="form-group">
                  <div class="col-md-10">
                      <div class="g-recaptcha" data-sitekey="6LdxHRgUAAAAANbpPOmN15x46x6Yj6VRmInr21Gl"></div>
                      <span class="text-danger" id="captcha-help"> </span>
                  </div>
              </div>
              <br><br><br><br>
              <div class="form-group">
                <div class="col-md-11 ">
                  <button type="submit" class="form-control btn btn-primary" id="verify-btn" name="verify-btn" value="zingat">Send Verification Mail</button>
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-4"></div>
        </div>
    </div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>
