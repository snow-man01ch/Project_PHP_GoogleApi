<?php
session_start();

// change the information according to your database
$db_connection = mysqli_connect("localhost","root","","google_login");

$clientID = '' ;
$clientSecret = '' ;
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}
