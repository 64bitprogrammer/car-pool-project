<?php
session_start();
require_once('includes/db_connect.php');

$pageTitle = "Email Verification";
$alert_type = "";
$notificationBoxContent = "";

if(isset($_GET['email']) && isset($_GET['token'])){
  $email = $_GET['email'];
  $token = base64_decode($_GET['token']);

  $result = mysqli_query($conn,"select user_id from shri_users where email='$email'");

  if(mysqli_num_rows($result)>=1){
    $row = mysqli_fetch_assoc($result);
    $res = mysqli_query($conn,"select email_token from shri_user_authentication where user_id={$row['user_id']} ");
    if(mysqli_num_rows($res)>=1){
      $row1 = mysqli_fetch_assoc($res);
      if($row1['email_token'] == $token){
        $alert_type ="success";
        $notificationMsg = "Email account &nbsp;&nbsp;<code>$email</code>&nbsp;&nbsp; successfully verified !";
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
    $notificationMsg = "Account with the address &nbsp;&nbsp; <code> $email </code> &nbsp;&nbsp; is not created. Please register your email first.";
  }

  if($alert_type=="success"){
    $notificationBoxContent =
    "<div class='alert alert-success alert-dismissable'>
      <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Success!</strong> $notificationMsg
    </div>";
  }
  else if($alert_type !=""){
    $notificationBoxContent =
    "<div class='alert alert-danger alert-dismissable'>
      <a href=''#'' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
      <strong>Error!</strong> $notificationMsg
    </div>";
  }

} // End of post

if(isset($_POST['verify-btn'])){
  $email = $_POST['verify_email'];
  //$notificationBoxContent ="";
  

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
      <div class="notification-box">
        <?=$notificationBoxContent?>
        <div class="row">
          <div class="col-md-4"></div>
          <div class="col-md-4">
            <h3> Verify Email Address </h3><br><br>
            <form method="post" action="verify.php" onsubmit="return validateVerificationFields()" name="verify-form">
              <div class="form-group">
                <label class="control-label col-sm-2 sr-only" for="verify_email">Email:</label>
                <input class="form-control" type="email" id="verify_email" name="verify_email" placeholder="Enter email address to verify ">
                <span id="verify_email-help" class="text-danger"><span>
              </div><br>
              <div class="form-group">
                <div class="col-md-10 col-md-offset-1">
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

</div>

<?php require_once('includes/footer.php'); ?>
