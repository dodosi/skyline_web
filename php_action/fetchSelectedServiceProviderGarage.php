<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

//$sql = "SELECT id, categoryName, category_active, category_status FROM category WHERE id = '$categoriesId'";
$sql = "SELECT `id`, `provider_ID`, `service_ID`,`status` FROM `serviceprovider` WHERE `id` = '$categoriesId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);