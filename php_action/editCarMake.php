<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	 
	 
	$brandName = $_POST['editCategoriesName'];
    $modelName = $_POST['editTin']; 	
    $brandStatus = $_POST['editCategoriesStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	//$sql = "UPDATE category SET categoryName = '$brandName',category_status = '$brandStatus' WHERE id = '$categoriesId'";
    $sql = "UPDATE `carmaketbl` SET `makeName`='$brandName',`modelName`='$modelName',`status`='$brandStatus' WHERE id = '$categoriesId'";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the car Make and Model ";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST