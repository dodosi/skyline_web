<?php 	
session_start();
$garageID = $_SESSION["garageID"];

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$serviceName = $_POST['dayOffFrom'];
	$modelName = $_POST['dayOffTo'];
	$categoriesName = $_SESSION["garageID"];
    $categoriesStatus = $_POST['categoriesStatusD']; 

	$sql = "INSERT INTO `dayoff`(`fromDate`, `toDate`, `garageID`, `status`) 
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