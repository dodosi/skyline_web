<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$serviceName = $_POST['serviceName'];
	$categoriesName = $_POST['garageName'];
    $categoriesStatus = $_POST['categoriesStatus']; 

	 
	
	$sql = "INSERT INTO `serviceprovider`(`provider_ID`, `service_ID`,`status`) 
	VALUES ('$categoriesName','$serviceName','$categoriesStatus')";

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