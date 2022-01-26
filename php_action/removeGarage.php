<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 $sql = "UPDATE garagetbl SET active = 0 WHERE garageID = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully disactivated ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while disactivating the garage ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST