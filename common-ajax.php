<?php
session_start();
require_once('includes/db_connect.php');

// Check if email address already exists
if(isset($_GET['action']) && $_GET['action']=="checkEmailExists"){
  $email = $_GET['email'];
  if(mysqli_num_rows(mysqli_query($conn,"select user_id from shri_carpool_users where email='$email' and is_deleted='0'"))>0){
    echo "true";
  }
  else{
    echo "false";
  }
}

if(isset($_GET['action']) && $_GET['action']=="sendOTP"){
  $mobile = $_GET['mobile'];
  // [todo] make this random instead of 123456
  //$otp = rand(100000,999999);
  $otp = 123456;
  $id = $_GET['id'];

  if(mysqli_query($conn,"update shri_carpool_users set otp_token=$otp where user_id=$id and is_deleted='0'")){
    if(sendMsg($mobile,"Your verification code for carpool is : $otp")){
      echo "sent";
      $myfile = fopen("otp.txt", "w") or die("Unable to open file!");
      fwrite($myfile, $otp);
    }
    else{
      echo "not_sent";
    }
  }
  else{
    echo "error";
    $myfile = fopen("db.txt", "w") or die("Unable to open file!");
    fwrite($myfile, ":".$conn->error.":");
  }
}

?>
