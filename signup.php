<?php
// each page will need following variables defined
session_start();
require_once('includes/db_connect.php');
require_once('lib/phpMailer/sendMail.php');
$pageTitle = "Sign-Up";
$current_page = "signup";
$validationMsg = "";
?>

<?php
// Handle form submit in this block

if(isset($_POST['signup-btn'])){

  function validateFields(){
    // [todo] fix here, just testing
    return true;

    global $conn;
    if( mysqli_num_rows( mysqli_query($conn,"select * from shri_users where email='{$_POST['email']}' and is_deleted='0'") )>0 ){
      global $validationMsg;
      $validationMsg = "Email Already Exists !";
      return false;
    }else{
      global $validationMsg;
      $validationMsg = "";
      return true;
    }
  }

  if(validateFields()){
    $timestamp = date('Y-m-d h:m:s');
    $password_hash = md5($_POST['password']);
    $insert_query = "insert into shri_users (first_name,last_name,email,password,gender,dob,mobile,sign_up_ip,registered_on) values ('{$_POST['first_name']}','{$_POST['last_name']}','{$_POST['email']}','$password_hash','{$_POST['gender']}','{$_POST['datepicker']}',{$_POST['mobile']},'{$_SERVER['REMOTE_ADDR']}','$timestamp');";
    $result = mysqli_query($conn,$insert_query);
    if($result){
      $recepient = $_POST['email'];
      $status = sendVerificationMail($recepient,$conn);
      echo ":$status:";
      // [todo] redirect to another page with success msg
    }
    else{
      // [todo] redirect to another page with error msg
      echo "<h1> Error: ". $conn->error ." </h1>";
    }
  }
  else{

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
            <h3> Sign-Up </h3>
            <br>
            <div class="row signup-form my-rows">
                <div class="col-sm-2 my-rows"></div>
                <!-- empty left column -->
                <div class="col-sm-8 my-rows">
                    <div class="row my-rows">
                        <!-- Innermost row for form -->
                        <form method="POST" id="signup-form" onsubmit="return validateSignUpForm()">
                        <div class="col-sm-10 my-rows">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2 sr-only" for="first_name">First Name:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                            <span class="text-danger" id="first-name-help"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2 sr-only" for="last_name">Last Name:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                            <span class="text-danger" id="last-name-help"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="email">Email:</label>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                    <span class="text-danger" id="email-help"><?=$validationMsg?></span>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-group">
                                <div class="col-sm-12">&nbsp;
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" id="male" value="male">Male
                                    </label>&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" id="female" value="female">Female
                                    </label>&nbsp;&nbsp;&nbsp;
                                    <label class="radio-inline">
                                    <input type="radio" name="gender" id="other" value="other">Other
                                    </label>
                                    <span class="text-danger col-xs-offset-1" id="gender-help"> </span>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="datepicker" id="datepicker" placeholder="Birthday YYYY-MM-DD">
                                    <span class="text-danger" id="datepicker-help"></span>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="mobile">Mobile:</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number">
                                    <span class="text-danger" id="mobile-help"> </span>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="password">Password:</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                    <span class="text-danger" id="password-help"> </span>
                                </div>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label class="control-label col-sm-2 sr-only" for="confirm_password">Confirm Password:</label>
                                <div class="col-sm-12">
                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                </div>
                            </div>
                            <br><br><br>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="g-recaptcha" data-sitekey="6LdxHRgUAAAAANbpPOmN15x46x6Yj6VRmInr21Gl"></div>
                                    <span class="text-danger" id="captcha-help"> </span>
                                </div>
                            </div>
                            <br><br><br><br>
                            <div class="form-group">
                                <div class="col-sm-offset-0 col-sm-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" id="terms"> I agree to terms and conditions.</label>
                                    </div>
                                    <span class="text-danger" id="terms-help"> </span>
                                </div>
                            </div>
                            <Br><br><br>
                            <div class="form-group">
                                <div class="col-sm-6">
                                    <input type="submit" class="form-control btn btn-primary" name="signup-btn" id="signup-btn" value="Sign-Up" placeholder="Enter email">
                                </div>
                            </div>
                            <br><br><br>
                        </div>
                    </div>
                    <!-- end of form row -->
                </div>
                <div class="col-sm-2 my-rows"></div>
            </div>
            <!-- end of sub parent row -->
        </div>
        <!-- end of center (parent) column -->
        <div class="col-sm-2 my-rows"></div>
    </div>
    <!-- end of row -->
</div>
<!-- end of container -->
<br><br><br>
    <?php require_once('includes/footer.php'); ?>
