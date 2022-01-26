<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$serviceName = $_POST['serviceName'];
	$categoriesName = $_POST['categoryName'];
    $categoriesStatus = $_POST['categoriesStatus']; 

	 
	
	$sql = "INSERT INTO `servicestbl`(`serviceName`, `serviceCategory`, `garageID`, `status`, `active`) 
	VALUES ('$serviceName','$categoriesName','','$categoriesStatus',1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ";
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the service ";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST