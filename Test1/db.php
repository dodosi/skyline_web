<?php
session_start();
$dbHost = 'jeanpierre009400390.ipagemysql.com';
$dbName = 'test1456_db1';
$dbUsername = 'skylineadmin';
$dbPassword = 'Skyline@12345678';
$dbc= mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName); 
// Check connection
if($dbc === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} 
?>