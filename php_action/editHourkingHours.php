<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	 
	 
	$brandName = $_POST['editdayName'];
    $editdayFrom = $_POST['editdayFrom'];
    $editdayTo = $_POST['editdayTo']; 	
    $editDayStatus = $_POST['editDayStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	$sql = "UPDATE `workingdays` SET `day`='$brandName',`hourFrom`='$editdayFrom',`hourTo`='$editdayTo',`status`='$editDayStatus' WHERE  id = '$categoriesId'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the working days and hours ";	
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST