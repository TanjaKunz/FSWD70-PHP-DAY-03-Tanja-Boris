<?php 

$localhost = "127.0.0.1"; 
$username = "root"; 
$password = "164"; 
$dbname = "test_db"; 

// create connection 
$connect = new  mysqli($localhost, $username, $password, $dbname); 

// check connection 
if($connect->connect_error) {
    die("connection failed: " . $connect->connect_error);
} else {
    // echo "Successfully Connected";
}

?>