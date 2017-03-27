<?php
if(!isset($_SESSION['ADMIN-ID'])){
  header("Location:".$base_url."admin/index.php");
}
?>
