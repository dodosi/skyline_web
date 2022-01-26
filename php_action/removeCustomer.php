<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 $sql = "UPDATE customertbl SET status = 0 WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Customer successfully blocked";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while blocking customer";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST