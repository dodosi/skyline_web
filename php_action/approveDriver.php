<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['editCategoriesId'];
$editStatus1 = $_POST['editStatus1'];

if($categoriesId) { 

 $sql = "UPDATE customertbl SET status = $editStatus1  WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Driver successfully updated ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while approving driver ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST