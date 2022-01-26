<?php 

require_once 'db_connect.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	$username = $_POST['username'];
	$userId = $_POST['user_id'];

	$sql = "UPDATE partnertbl SET email = '$username' WHERE id = {$userId}";
	//print($sql);
	if($connect->query($sql) === TRUE) {
		$valid['success'] = true;
		$valid['messages'] = "Successfully Update";	
	} else {
		$valid['success'] = false;
		$valid['messages'] = "Error while updating partner info";
	}

	$connect->close();

	echo json_encode($valid);

}

?>