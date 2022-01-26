<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['brandName'];
	$wucFname = $_POST['wucFname'];
	$wucLname = $_POST['wucLname'];
	$wucEmail = $_POST['wucEmail'];
	$wucPhone = $_POST['wucPhone'];
    $brandStatus = $_POST['brandStatus']; 

	$sql = "INSERT INTO brands (brand_name,wuc_fname,wuc_lname,wuc_email,wuc_phone, brand_active, brand_status) VALUES ('$brandName','$wucFname','$wucLname','$wucEmail','$wucPhone', '$brandStatus', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST