<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	 
	 
	$brandName = $_POST['editCategoriesName']; 
    $brandStatus = $_POST['editCategoriesStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	$sql = "UPDATE category SET categoryName = '$brandName',category_status = '$brandStatus' WHERE id = '$categoriesId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories ";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST