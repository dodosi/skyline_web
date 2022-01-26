<?php 	
session_start();
//$garageID = $_SESSION["garageID"];
$garageName = $_SESSION["garagename"];
require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

$sql = "SELECT DISTINCT booking.id,`booking`.email, booking.garage, servicestbl.serviceName, booking.make, booking.model, booking.plate_number, booking.engine_number, booking.car_color, booking.description, booking.status, customertbl.fname, customertbl.lname,customertbl.phone,booking.state, booking.city, booking.street, booking.zipcode, booking.pick_up_date, booking.pick_up_time FROM `booking`, `garagetbl`, `customertbl`, servicestbl WHERE garagetbl.Name = booking.garage AND customertbl.email = booking.email AND  booking.service = servicestbl.servID AND garagetbl.Name = '$garageName' AND booking.id = '$categoriesId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);