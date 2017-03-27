<?php
  session_start();
  require_once('includes/db_connect.php');
  $current_page ="updatePassword";
  $pageTitle = "Update Password";

  if(isset($_GET['user']) && $_GET['user']!="" && isset($_GET['token']) && $_GET['token']!=""){
    $id= base64_decode($_GET['user']);
    $token= base64_decode($_GET['token']);

    $result = mysqli_query($conn,"select * from shri_carpool_users where user_id=$id and is_deleted='0'");
    if(mysqli_num_rows($result)==1){
      $row = mysqli_fetch_assoc($result);

      if($row['recovery_token']!=$token){
        $_SESSION['UPD-PWD-MSG'] =
        "<div class='alert alert-danger alert-dismissable'>
          <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
          <strong>Error!</strong> Invalid account recovery token.
        </div>";
        header("Location:".$base_url."login.php");
      }
    }
    else{
      $_SESSION['UPD-PWD-MSG'] =
      "<div class='alert alert-danger alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> Could not locate your account.
      </div>";
      header("Location:".$base_url."login.php");
    }
  }
  else{
    header("Location:".$base_url."index.php");
  }

  if(isset($_POST['updatepwd-btn'])){
    $pwd = md5($_POST['password']);
    if(mysqli_query($conn,"update shri_carpool_users set password='$pwd',recovery_token='__recovered__' where user_id=$id")){
      // [todo] maybe send an email with confirmation
      $_SESSION['UPD-PWD-MSG'] =
      "<div class='alert alert-info alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Success!</strong> Password updated successfully !
      </div>";
      header("Location:".$base_url."login.php");
    }
    else{
      $_SESSION['UPD-PWD-MSG'] =
      "<div class='alert alert-danger alert-dismissable'>
        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
        <strong>Error!</strong> Technical problem in updating password !
      </div>";
      header("Location:".$base_url."login.php");
    }
  }
?>

<?php require_once('includes/header.php'); ?>
<!-- navbar -->
<div class="mycontainer">
  <?php require_once('includes/navbar.php'); ?>
</div>
<br>
<div class="container-fluid" style="min-height:76%;">
  <div class="row">
    <div class="col-md-4"></div>

    <div class="col-md-4">

      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <h4> Update Password </h4> <br>
          <div class="update-password-form">
            <form method="post" id="updatePasswordForm" name="updatePasswordForm" onsubmit="return validateUpdatePassword()">
              <div class="form-group">
                <label for="password" class="sr-only">Password:</label>
                <input class="form-control" placeholder="New Password" name="password" type="password" id="password" />
                <span class="text-danger" id="password-help"></span>
              </div>
              <div class="form-group">
                <label for="cpassword" class="sr-only">Password:</label>
                  <input class="form-control" placeholder="Confirm New Password" name="cpassword" type="password" id="cpassword" />
                  <span class="text-danger" id="cpassword-help"></span>
              </div>
              <br>
              <div class="form-group">
                <button type="submit" name="updatepwd-btn" id="updatepwd-btn" class="btn btn-primary">Update Password</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-1">
        </div>
      </div>

    </div>

    <div class="col-md-4"></div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>
