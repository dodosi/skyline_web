<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

//$sql = "SELECT categories_id, categories_name, wss_ID, region_ID, categories_active, categories_status FROM water_point_tbl WHERE categories_id = '$categoriesId'";
$sql = "SELECT `id`, `pickcost`, `ranged`, `date` FROM `pickuprangetbl`  WHERE id = '$categoriesId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);