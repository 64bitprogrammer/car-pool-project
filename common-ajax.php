<?php
session_start();
require_once('includes/db_connect.php');

// Check if email address already exists
if(isset($_GET['action']) && $_GET['action']=="checkEmailExists"){
  $email = $_GET['email'];
  if(mysqli_num_rows(mysqli_query($conn,"select user_id from shri_users where email='$email' and is_deleted='0'"))>0){
    echo "true";
  }
  else{
    echo "false";
  }
}

?>
