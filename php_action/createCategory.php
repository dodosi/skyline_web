<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$categoriesName = $_POST['categoriesName'];
    $categoriesStatus = $_POST['categoriesStatus']; 

	$sql = "INSERT INTO category (categoryName,category_status,category_active) 
	VALUES ('$categoriesName','$categoriesStatus', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the category ";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST