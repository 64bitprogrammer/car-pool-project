<?php
session_start();
include('../includes/db_connect.php');

if(isset($_SESSION) && isset($_SESSION['ADMIN-ID'])){
    unset($_SESSION['ADMIN-ID']);
    session_destroy();
    header("location:".$base_url."admin/index.php");
}
else{
  header("location:".$base_url."index.php");
}
?>
