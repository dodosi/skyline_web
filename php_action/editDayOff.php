<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	 
	 
	$editdayOffFrom = $_POST['editdayOffFrom'];
    $editdayOffTo = $_POST['editdayOffTo']; 	
    $editDayOffStatus = $_POST['editDayOffStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	//$sql = "UPDATE `workingdays` SET `day`='$brandName',`hourFrom`='$editdayFrom',`hourTo`='$editdayTo',`status`='$editDayStatus' WHERE  id = '$categoriesId'";
	$sql = "UPDATE `dayoff` SET `fromDate`='$editdayOffFrom',`toDate`='$editdayOffTo',`status`='$editDayOffStatus' WHERE   id = '$categoriesId'";
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