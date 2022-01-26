<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['editCategoriesId'];
$comment = $_POST['comments'];
if($categoriesId) { 

 $sql = "UPDATE booking SET status = 10, comment='$comment' WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Booking successfully rejected ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while rejecting the booking ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST