<?php
session_start();
include('includes/db_connect.php');

if(isset($_SESSION) && isset($_REQUEST['logout']) && $_REQUEST['logout']=='true'){
    unset($_SESSION['USER_ID']);
    session_destroy();
    header("location:".$base_url."index.php");
}
else{
  header("location:".$base_url."index.php");
}
?>
