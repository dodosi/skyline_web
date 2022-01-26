<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 $sql = "UPDATE customertbl SET status = 1 WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Customer successfully activated";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while activating customer";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST