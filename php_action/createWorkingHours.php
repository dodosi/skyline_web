<?php 	
session_start();
$garageID = $_SESSION["garageID"];

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$categoriesName = $_POST['dayName'];
	$dayFrom = $_POST['dayFrom'];
	$dayTo = $_POST['dayTo'];
	$garageID = $garageID;
    $categoriesStatus = $_POST['categoriesStatus1']; 
 
    $sql = "INSERT INTO `workingdays`(`day`, `hourFrom`, `hourTo`, `garageID`, `status`) 
	VALUES ('$categoriesName','$dayFrom','$dayTo','$garageID','$categoriesStatus')";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the Day and Hours ";	
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST