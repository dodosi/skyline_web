<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['editCategoriesId'];
$editStatus1 = $_POST['editStatus1'];

if($categoriesId) { 

 $sql = "UPDATE partnertbl SET active = $editStatus1 WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Partner successfully status updated ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while approving partner ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST