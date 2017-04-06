<?php

session_start();
// Inaccessible without session set
if(!isset($_SESSION['USER_ID']) || $_SESSION['USER_ID']==""){
  die();
}



?>
