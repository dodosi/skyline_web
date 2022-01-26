<?php 	

require_once 'db_connect.php';

$categoriesId = $_POST['categoriesId'];

//$sql = "SELECT categories_id, categories_name, wss_ID, region_ID, categories_active, categories_status FROM water_point_tbl WHERE categories_id = '$categoriesId'";
$sql = "SELECT partnertbl.id, partnertbl.fname, partnertbl.lname, partnertbl.phone1, partnertbl.phone2, partnertbl.email, partnertbl.password, partnertbl.street, partnertbl.city, partnertbl.state, partnertbl.zip, partnertbl.company_pic, partnertbl.doc_proof, partnertbl.regDate, partnertbl.user_type, garagetbl.Name, partnertbl.active FROM partnertbl, garagetbl WHERE partnertbl.garageID = garagetbl.garageID AND partnertbl.id = '$categoriesId'";
$result = $connect->query($sql);

if($result->num_rows > 0) { 
 $row = $result->fetch_array();
} // if num_rows

$connect->close();

echo json_encode($row);