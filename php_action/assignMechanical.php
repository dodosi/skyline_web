<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['editCategoriesId'];
	$wucFname = $_POST['email1'];
	$wucLname = $_POST['names'];
	$wucEmail = date("Y-m-d h:i:sa"); 

	$sql = "INSERT INTO bookassignment (`bookID`, `customer_email`, `mechnicalNames`, `date`, `status`) VALUES ('$brandName','$wucFname','$wucLname','$wucEmail', 0)";

	if($connect->query($sql) === TRUE) {
                $sqls = "UPDATE booking SET status = 4 WHERE id = {$brandName}";
                $connect->query($sqls); 
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Assigned ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while assigning mechanics ".$sql.$connect->error;
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST 