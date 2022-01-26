<?php 	
session_start();
$garageID = $_SESSION["garageID"];

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$serviceName = $_POST['categoriesName'];
	$modelName = $_POST['carModelName'];
	$categoriesName = $_SESSION["garageID"];
    $categoriesStatus = $_POST['categoriesStatus']; 

	 
	
	//$sql = "INSERT INTO `carMake`(`provider_ID`, `service_ID`,`status`) 
	//VALUES ('$categoriesName','$serviceName','$categoriesStatus')";
    $sql = "INSERT INTO `carmaketbl`(`makeName`, `modelName`, `garageID`, `status`) 
	VALUES ('$serviceName','$modelName','$categoriesName','$categoriesStatus')";
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