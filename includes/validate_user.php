<?php
  // No session_start() here since it will be included in some other page
  if(!isset($_SESSION['USER_ID'])){
    header("location:login.php");
  }
?>
