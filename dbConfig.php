<?php 
// Database configuration 
$dbHost     = "jeanpierre009400390.ipagemysql.com"; 
$dbUsername = "skylineadmin"; 
$dbPassword = "Skyline@12345678"; 
$dbName     = "skylinedb"; 
 
// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}