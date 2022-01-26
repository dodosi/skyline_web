<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

//$sql = "SELECT categories_id, staff_fname, staff_lname, staff_username, staff_email, staff_phone, staff_region, categories_active, categories_status FROM staff_tbl WHERE categories_id = $categoriesId";
$sql = "SELECT garageID, Name, Email, Websitelink, phone, garage_thumbnail, state, city, street, zip, latitude, longitude, working_hourID, working_dayID, status, active FROM garagetbl WHERE garageID = $categoriesId";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);