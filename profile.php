<?php
  session_start();
  require_once('includes/validate_user.php');
  require_once('includes/db_connect.php');

  $pageTitle = "Profile";
  $current_page = "profile";
  $notificationBoxContent = "";
  $emailError = "";

  // fetch state list for select control
  $state_query = "select State_ID,State_Name from shri_carpool_states where Country_ID=105 ORDER BY State_Name";
  $state_result = mysqli_query($conn,$state_query);

  $result = mysqli_query($conn,"select * from shri_carpool_users where user_id={$_SESSION['USER_ID']} and is_deleted='0'");
  $row = mysqli_fetch_assoc($result);

  // Handle delete Account
  if(isset($_POST['delete-btn'])){
    echo "deleted";
  }

  // Handle update info form
  if(isset($_POST['update_info_btn'])){
    $res = mysqli_query($conn,"select * from shri_carpool_users where email='{$_POST['email']}' and is_deleted='0' ");
    // Check if new email is available and not equial to old one
    if(mysqli_num_rows($res)>0 && $row['email']!=$_POST['email']){
      $emailError = "Email already taken !";
    }
    else{
      //[todo] Write better code for extension handling
      if($_FILES['profile_image']['name']==''){
        $imgPath = $row['profile_image'];
      }
      else{
        // copy image to user directory
        $imgPath = "users/".$row['user_id']."/profile.jpg";
        move_uploaded_file($_FILES["profile_image"]["tmp_name"],$imgPath) or die("upload failed");
      }

      // if mobile number is changed , set verified = false for mobile
      if($_POST['mobile']==$row['mobile']){
        $updateQuery = "update shri_carpool_users set first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}',email='{$_POST['email']}',mobile={$_POST['mobile']},dob='{$_POST['datepicker']}',street='{$_POST['street']}',house='{$_POST['house']}',state='{$_POST['state']}',city='{$_POST['city']}',zipcode='{$_POST['zipcode']}',profile_image='$imgPath',gender='{$_POST['gender']}' where user_id={$_SESSION['USER_ID']} and is_deleted='0'";
      }
      else{
        $updateQuery = "update shri_carpool_users set first_name='{$_POST['first_name']}', last_name='{$_POST['last_name']}',email='{$_POST['email']}',mobile={$_POST['mobile']},dob='{$_POST['datepicker']}',street='{$_POST['street']}',house='{$_POST['house']}',state='{$_POST['state']}',city='{$_POST['city']}',zipcode='{$_POST['zipcode']}',profile_image='$imgPath',gender='{$_POST['gender']}',mobile_verified='0' where user_id={$_SESSION['USER_ID']} and is_deleted='0'";
      }
      if(mysqli_query($conn,$updateQuery)){
        $notificationBoxContent = createAlert('success','Account information updated successfully');
        // Update row data upon success
        $result = mysqli_query($conn,"select * from shri_carpool_users where user_id={$_SESSION['USER_ID']} and is_deleted='0'");
        $row = mysqli_fetch_assoc($result);
      }
      else{
        $notificationBoxContent = createAlert('error','Technical problem in updating information');
      }
    }
  }

  // Handle update password form
  if(isset($_POST['update_pwd_btn'])){
    // Verify old password matched
    if(md5($_POST['old_password'])==$row['password']){
      if($_POST['new_password']!='' && $_POST['confirm_password']!=''){
        if($_POST['new_password']==$_POST['confirm_password']){
          if(mysqli_query($conn,"update shri_carpool_users set password='".md5($_POST['new_password'])."' where user_id={$row['user_id']} and is_deleted='0'")){
            $notificationBoxContent = createAlert("success","Account password updated successfully !");
          }
          else{
            $notificationBoxContent = createAlert("danger","Technical problem in updating password !");
          }
        }
        else{
          $notificationBoxContent = createAlert("warning","Passwords do not match");
        }
      }
      else{
        $notificationBoxContent = createAlert("danger","Please enter a new password !");
      }
    }
    else{
      $notificationBoxContent = createAlert("danger","Your old password is incorrect !");
    }
  }

  // Handle verify OTP
  if(isset($_POST['verify-otp-btn'])){
    $otp_token = mysqli_fetch_assoc(mysqli_query($conn,"select otp_token from shri_carpool_users where user_id={$_SESSION['USER_ID']}"));

    if($_POST['otp']==$otp_token['otp_token']){
      if(mysqli_query($conn,"update shri_carpool_users set mobile_verified='1' where user_id={$_SESSION['USER_ID']}")){
        $notificationBoxContent = createAlert("success","Mobile Number Verified Successfully");
        $result = mysqli_query($conn,"select * from shri_carpool_users where user_id={$_SESSION['USER_ID']} and is_deleted='0'");
        $row = mysqli_fetch_assoc($result);
      }
      else{
        $notificationBoxContent = createAlert("error","Technical error in validating OTP");
      }
    }
    else{
      $notificationBoxContent = createAlert("error","Invalid OTP token");
    }
  }
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
      <div class="notification-box"><?=$notificationBoxContent?></div>
      <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Edit Profile</a></li>
    <li><a data-toggle="tab" href="#menu1">Change Password</a></li>
    <li><a data-toggle="tab" href="#menu2">Verify Details</a></li>
    <li><a data-toggle="tab" href="#menu3">Add Payment Method</a></li>
    <li><a data-toggle="tab" href="#menu4">Manage Vehicle</a></li>
    <li><a data-toggle="tab" href="#menu5">Delete Account</a></li>
  </ul>

  <div class="tab-content"> <!-- Edit profile pane -->
    <div id="home" class="tab-pane fade in active">
      <h3>Update Information</h3>

      <div class="row"> <!-- main row -->
        <div class="col-md-12">
          <!-- <hr style="border-top-color:red;"> -->
          <form class="update-password-form" method="post" enctype="multipart/form-data" onsubmit="return validateUpdateInfoForm()">
            <div class="row"> <!-- first inner row -->
              <div class="col-md-8">

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="first_name"> First Name:</label>
                      <input type="text" class="form-control" name="first_name" id="first_name" value="<?=$row['first_name']?>">
                      <span id="first_name_help" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                      <label for="datepicker"> Birthdate:</label>
                      <input type="text" value="<?=$row['dob']?>" class="form-control" id="datepicker" name="datepicker" />
                      <span id="datepicker_help" class="text-danger"></span>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="last_name">Last Name:</label>
                      <input type="text" class="form-control" name="last_name" id="last_name"  value="<?=$row['last_name']?>">
                      <span id="last_name_help" class="text-danger"></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" id="email" name="email" class="form-control"  value="<?=$row['email']?>"/>
                  <span id="email_help" class="text-danger"></span>
                </div>
              </div>
              <div class="col-md-4 text-center">
                <div class="form-group">
                  <div class="profile_pic_div">
                    <img src="<?php echo $row['profile_image']==''?'images/default.jpg':$row['profile_image']; ?>" width="135" height="160" class="profile_pic" id="profile_pic" name="profile_pic">
                  </div><Br>
                  <input type="file" id="profile_image" name="profile_image" />
                </div>
              </div>
            </div> <!-- end of first inner row -->

            <div class="row"> <!-- second inner row-->
              <div class="col-md-6">
                <div class="form-group" style="min-height:65px;">
                  <label for="male">Gender:</label>
                    <div class="col-sm-12">
                        <label class="radio-inline">
                        <input type="radio" name="gender" id="male" value="male" <?php if($row['gender']=='male')echo 'checked'?>>Male
                       :</label>&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline">
                        <input type="radio" name="gender" id="female" value="female" <?php if($row['gender']=='female')echo 'checked'?> >Female
                       :</label>&nbsp;&nbsp;&nbsp;
                        <label class="radio-inline">
                        <input type="radio" name="gender" id="other" value="other" <?php if($row['gender']=='other')echo 'checked'?> >Other
                       :</label>
                        <span class="text-danger col-xs-offset-1" id="gender_help"> </span>
                    </div>
                </div>

                <div class="form-group">
                  <label for="street">Street:</label>
                  <input class="form-control" type="text" id="street" name="street" value="<?=$row['street']?>" />
                </div>

                <div class="form-group">
                  <label for="state">State:</label>
                  <select class="form-control" id="state" name="state" >
                    <option value=""> Select State </option>
                    <?php
                      while($states = mysqli_fetch_assoc($state_result)){
                        ?>
                          <option value='<?=$states['State_ID']?>' <?php if($states['State_ID']==$row['state']) echo "selected"?>><?=$states['State_Name']?></option>
                        <?php
                      }
                    ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="zipcode">Zipcode:</label>
                  <input type="text" class="form-control"  id="zipcode" name="zipcode" value="<?=$row['zipcode']?>" />
                </div>

              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="mobile">Mobile:</label>
                  <input value="<?=$row['mobile']?>" class="form-control" id="mobile" name="mobile" type="text" />
                  <span id="mobile_help" class="text-danger"></span>
                </div>

                <div class="form-group">
                  <label for="street">House Number/Name:</label>
                  <input class="form-control" type="text" id="house" name="house" value="<?=$row['house']?>"/>
                </div>

                <div class="form-group">
                  <label for="city">City:</label>
                  <input type="Text" class="form-control" name="city" id="city" placeholder="City" value="<?=$row['city']?>"/>
                  <!-- <select class="form-control" id="city" name="city" >
                    <option value=""> Select City </option>
                  </select> -->
                </div>
              </div>

            </div> <!-- end of 2nd inner now -->
            <div class="form-group col-md-4">
              <button type="submit" name="update_info_btn" id="update_info_btn" class="form-control btn btn-primary">Update Info </button>
            </div>
          </form>
        </div> <!-- end of mid column -->
      </div> <!-- row end -->

    </div>
    <div id="menu1" class="tab-pane fade"> <!-- update password pane -->
      <h4>Update Password</h4><Br>
      <form class="update-password-form" id="update_password_form" onsubmit="return validatePasswordForm()" method="post">
        <div class="row">
          <div class="col-md-2"></div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="old_password">Current Password</label>
              <input class="form-control" type="password" id="old_password" name="old_password" placeholder="Current Password">
              <span class="text-danger" id="old_password_help"></span>
            </div>
            <div class="form-group">
              <label for="new_password">New Password</label>
              <input class="form-control" type="password" id="new_password" name="new_password" placeholder="New Password">
              <span class="text-danger" id="new_password_help"></span>
            </div>
            <div class="form-group">
              <label for="confirm_password">Confirm New Password</label>
              <input class="form-control" type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
              <span class="text-danger" id="confirm_password_help"></span>
            </div>
            <Br>
            <div class="form-group">
              <button type="submit" name="update_pwd_btn" id="update_pwd_btn" value="zakkas" class="btn btn-primary">Update Password</button>
            </div>
          </div>
          <div class="col-md-5"></div>
        </div>
      </form> <!-- pwd form end-->
    </div>
    <div id="menu2" class="tab-pane fade">
      <h4> Verify Account </h4><br>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Verify Mobile Number</div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <?php
                    if($row['mobile_verified']=='0'){
                  ?>
                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" style="border-bottom:solid 1px lightgray;" class="form-control" id="mobile" name="mobile" maxlength="10" readonly value="<?=$row['mobile']?>" />
                    <span id="send-otp-success-help" class="text-success"></span>
                    <span id="send-otp-error-help" class="text-danger"></span>
                  </div>
                  <br>
                  <div class="form-group col-md-6">
                    <button type="button" class="form-control btn btn-warning" name="send-otp-btn" id="send-otp-btn">Send OTP</button>
                  </div>
                  <?php
                    }
                    else{
                      ?>
                      <h5> <span class="glyphicon glyphicon-ok text-success"></span> Verified </h5>
                      <?php
                    }
                  ?>
                </div>
                <div class="col-md-6"></div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div id="verify-otp-block" style="display:none;">
                    <form method="post" onsubmit="return validateOTP()">
                      <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="otp" name="otp" maxlength="10" />
                        <span id="otp_help" class="text-danger"> </span>
                      </div>
                      <div class="form-group col-md-6">
                        <button type="submit" class="form-control btn btn-primary" name="verify-otp-btn" id="verify-otp-btn">Verify OTP</button>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="col-md-6"></div>
              </div>

            </div> <!-- end of panel body-->
          </div> <!-- end of otp panel -->

          <div class="panel panel-primary">
            <div class="panel-heading">Upload ID Proof</div>
            <div class="panel-body"> </div>
          </div>
        </div>
      </div>

    </div>

    <div id="menu3" class="tab-pane fade">
      <h4> Add Payment Method</h4><br>
    </div>

    <div id="menu4" class="tab-pane fade">
      <h4> Manage Vehicle </h4><br>
    </div>

    <div id="menu5" class="tab-pane fade">
      <h4> Delete Account </h4><br>
      <div class="row">
        <div class="col-md-4">
          <form method="post" onsubmit="return confirmDelete()">
            <div class="form-group">
              <label for="pwd">Confirm Password</label>
              <input type="password" name="pwd" id="pwd" required class="form-control" />
            </div>
            <div class="form-group">
              <button type="submit" name="delete-btn" class="btn btn-danger">Delete My Account</button>
            </div>
          </form>
        </div>
        <div class="col-md-8"></div>
      </div>
    </div>

  </div>
    </div>
    <div class="col-md-2"></div>
  </div> <!-- main row end -->
  <br><br><br>
</div> <!-- contanier end -->

<?php require_once('includes/footer.php'); ?>

<script>
$(document).ready(function (){
  $("#old_password").val("Admin@123");
  $("#new_password").val("Admin@123");
  $("#confirm_password").val("Admin@123");
});
// validate update pwd form
function validatePasswordForm (){
  $("#new_password_help").html("");
  $("#old_password_help").html("");
  $("#confirm_password_help").html("");

  var pass_reg=/(^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$)/;

  if($("#old_password").val()==""){
    $("#old_password_help").html("Please enter a password ");
    $("#old_password").focus();
    return false;
  }

  if(!pass_reg.test($("#old_password").val())){
    $("#old_password_help").html("Min 8 chars [1 caps, 1 num, 1 sym]");
    $("#old_password").focus();
    return false;
  }

  if($("#new_password").val() == ""){
    $("#new_password_help").html("Please enter new password ");
    $("#new_password").focus();
    return false;
  }

  if(!pass_reg.test($("#new_password").val())){
    $("#new_password_help").html("Min 8 chars [1 caps, 1 num, 1 sym]");
    $("#new_password").focus();
    return false;
  }

  if($("#confirm_password").val() == ""){
    $("#confirm_password_help").html("Please confirm new password ");
    $("#confirm_password").focus();
    return false;
  }

  if($("#new_password").val()!=$("#confirm_password").val()){
    $("#confirm_password_help").html("Passwords do not match");
    $("#confirm_password").focus();
    return false;
  }

  return true;
}

// Validate update info form
function validateUpdateInfoForm(){

  $("#first_name_help").html("");
  $("#last_name_help").html("");
  $("#email_help").html("");
  $("#mobile_help").html("");
  $("#datepicker_help").html("");


  var text_reg = /^[a-zA-Z ]*$/;
  var email_reg=/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,3})+$/;
  var date_reg = /^([0-9]{4})-([0-9]{2})-([0-9]{2})$/;
  var mobile_reg = /^([0-9]){10}/;


  if($("#first_name").val() == ""){
    $("#first_name_help").html("First name cannot be empty");
    $("#first_name").focus();
    return false;
  }

  if(!text_reg.test($("#first_name").val())){
    $("#first_name_help").html("Only alphabets allowed");
    $("#first_name").focus();
    return false;
  }

  if($("#last_name").val() == ""){
    $("#last_name_help").html("Last name cannot be empty");
    $("#last_name").focus();
    return false;
  }

  if(!text_reg.test($("#last_name").val())){
    $("#last_name_help").html("Only alphabets allowed");
    $("#last_name").focus();
    return false;
  }

  if($("#email").val() == ""){
    $("#email_help").html("Email cannot be empty");
    $("#email").focus();
    return false;
  }

  if(!email_reg.test($("#email").val())){
    $("#email_help").html("In-correct email format");
    $("#email").focus();
    return false;
  }

  if(checkMailExists($("#email").val()) && $("#email").val()!='<?=$row['email']?>'){
    $("#email_help").html("Email already exists!");
    $("#email").focus();
    return false;
  }

  if($('input[name=gender]:checked').length==0){
    $("#gender_help").html("Select your gender");
    return false;
  }

  if($("#datepicker").val() == ""){
    $("#datepicker_help").html("Please select your birth date");
    $("#datepicker").focus();
    return false;
  }

  if(!date_reg.test($("#datepicker").val())){
    $("#datepicker_help").html("In-correct date format");
    $("#datepicker").focus();
    return false;
  }

  if(calculateAge($("#datepicker").val())<18){
    $("#datepicker_help").html("You must be 18 years or older of age");
    return false;
  }

  if($("#mobile").val()==""){
    $("#mobile_help").html("Please enter a mobile number");
    $("#mobile").focus();
    return false;
  }

  if(!mobile_reg.test($("#mobile").val())){
    $("#mobile_help").html("Please enter a valid mobile number");
    $("#mobile").focus();
    return false;
  }

  return true;
}



function enableButton(){
  $('#send-otp-btn').prop('disabled', false);
}

// handle send otp
var timer = 60;
$("#send-otp-btn").click(function(){
  $("#send-otp-error-help").html("");
  $("#send-otp-success-help").html("");

  //var intervalID = window.setInterval(myCallback, 500);

  //clearInterval(intervalID);

  // ajax function to set OTP token and send it
  var status;
  var filename = "common-ajax.php?action=sendOTP&id=<?=$_SESSION['USER_ID']?>&mobile="+encodeURIComponent(<?=$row['mobile']?>);
  $.ajax({
    url: filename,
    type: 'POST',
    async: false,
    success: function (data, textStatus, xhr){
      status = data;
    },
    error: function (data, textStatus, xhr){
    }
  });
  if(status=='sent'){
    $("#send-otp-success-help").html("OTP sent successfully");
    $("#verify-otp-block").show();
    $('#send-otp-btn').prop('disabled', true);
    window.setTimeout(enableButton,60000);
  }
  else if (status == 'not_sent'){
    $("#send-otp-error-help").html("Error in sending OTP");
  }
  else{
    $("#send-otp-error-help").html("Technical issue in issuing OTP");
  }
});

// handle verify otp
function validateOTP(){
  $("#otp_help").html("");

  if($("#otp").val()==""){
    $("#otp_help").html("Please enter OTP");
    return false;
  }

  var patt = /^([0-9]){6}/;
  if(!patt.test($("#otp").val())){
    $("#otp_help").html("Invalid OTP format");
    $("#otp").focus();
    return false;
  }

  return true;
}

// Handle delete account js
function confirmDelete(){
  if(confirm("Are you sure you want to delete your account?")){
    return true;
  }
  else{
    return false;
  }
}

</script>
