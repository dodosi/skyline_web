<?php 	

$localhost = "jeanpierre009400390.ipagemysql.com";
$username = "skylineadmin";
$password = "Skyline@12345678";
$dbname = "skylinedb";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>