<?php
    date_default_timezone_set('Asia/Kolkata');

    if($_SERVER['SERVER_NAME']=="localhost"){

      $db_host = "localhost";

      $username = "root";

      $password = "";

      $dbname = "carpool";

      define("SITE_PATH","http://localhost/carpool/");

    }
    else{

      $db_host = "";

      $username = "";

      $password = "";

      $dbname = "";

      define("SITE_PATH","http://www.carpool.com/");

    }

    $base_url = SITE_PATH;

    require_once('functions.php');

    $conn = mysqli_connect($db_host,$username,$password,$dbname) or die("<h1> Error: Failed to create connection </h1> !");
?>
