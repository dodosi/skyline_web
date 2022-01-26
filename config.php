<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'jeanpierre009400390.ipagemysql.com');
define('DB_USERNAME', 'skylineadmin');
define('DB_PASSWORD', 'Skyline@12345678');
define('DB_NAME', 'skylinedb'); 
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>