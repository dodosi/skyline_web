<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['categoriesId'];

if($categoriesId) { 

 //$sql = "UPDATE carmaketbl SET status = 2 WHERE id = {$categoriesId}";
 $sql = "DELETE FROM `workingdays` WHERE id = {$categoriesId}";
 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Working day and hours is successfully Removed ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while removing working day and hours ";	
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST