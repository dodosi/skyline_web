<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 $sql = "UPDATE category SET category_active = 0 WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully disactivated ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while disactivating the category ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST