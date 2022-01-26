<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
    $brandStatus = $_POST['editcustomerStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	//$sql = "UPDATE categories SET categories_name = '$brandName', TinNumber = '$companuTin', po_email = '$companyEmail', po_phone = '$companyPhone', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";
    $sql = "UPDATE customertbl SET status = '$brandStatus' WHERE id = {$categoriesId}";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Customer successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the customer";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST
 