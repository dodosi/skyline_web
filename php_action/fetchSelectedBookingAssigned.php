<?php 	
session_start();
require_once 'db_connect.php';
$garageName = $_SESSION["garagename"];
$categoriesId = $_POST['categoriesId'];
 

$sql = "SELECT bookassignment.id,bookassignment.bookID,`booking`.email, booking.garage, 
servicestbl.serviceName, booking.make, booking.model, booking.plate_number, 
booking.engine_number, booking.car_color, booking.description, bookassignment.status, 
customertbl.fname, customertbl.lname,customertbl.phone,customertbl.state, customertbl.city, 
customertbl.street_number, customertbl.zip_code, booking.pick_up_date, 
booking.pick_up_time 
FROM `booking`, `garagetbl`, `customertbl`, servicestbl, bookassignment 
WHERE 
garagetbl.Name = booking.garage AND 
customertbl.email = booking.email AND 
booking.service = servicestbl.servID AND 
booking.id = bookassignment.bookID AND 
garagetbl.Name = '$garageName' AND 
booking.id = '$categoriesId' GROUP BY bookassignment.id";

$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);