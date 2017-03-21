<?php
    date_default_timezone_set('Asia/Kolkata');

    $db_host = "localhost";
    $username = "root";
    $password = "";
    $dbname = "carpool";

    $conn = mysqli_connect($db_host,$username,$password,$dbname) or die("<h1> Error: Failed to create connection </h1> !");
?>
