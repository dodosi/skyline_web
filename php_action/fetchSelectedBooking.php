<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

//$sql = "SELECT categories_id, categories_name, wss_ID, region_ID, categories_active, categories_status FROM water_point_tbl WHERE categories_id = '$categoriesId'";
$sql = "SELECT `booking`.id, `servicestbl`.serviceName, booking.garage, 
`booking`.make, `booking`.model, `booking`.plate_number, `booking`.engine_number, 
`booking`.car_color, `booking`.description, `booking`.pick_up_date, `booking`.pick_up_time, 
`booking`.latitude, `booking`.longitude, `booking`.email, `booking`.comment, 
`booking`.status FROM `booking`, servicestbl WHERE booking.id = '$categoriesId' AND 
booking.service = servicestbl.servID";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);