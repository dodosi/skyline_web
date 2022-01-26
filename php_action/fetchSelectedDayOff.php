<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

 
$sql = "SELECT `id`, `fromDate`, `toDate`, `garageID`, `status` FROM `dayoff` WHERE  id = '$categoriesId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);