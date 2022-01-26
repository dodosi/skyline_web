<?php 

//require_once 'core.php';
require_once 'db_connect.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	//$currentPassword = md5($_POST['password']);
	$currentPassword = $_POST['password'];
	
	//$newPassword = md5($_POST['npassword']);
	$newPassword = password_hash($_POST['npassword'], PASSWORD_DEFAULT);
	
	//$conformPassword = md5($_POST['cpassword']);
	$conformPassword = $_POST['cpassword'];
	
	$userId = $_POST['user_id'];

	$sql ="SELECT * FROM partnertbl WHERE id = {$userId}";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();

	//if($currentPassword == $result['password']) {
	if (password_verify($currentPassword, $result['password'])){

		//if($newPassword == $conformPassword) {
		if (password_verify($conformPassword, $newPassword)){

			$updateSql = "UPDATE partnertbl SET password = '$newPassword' WHERE id = {$userId}";
			if($connect->query($updateSql) === TRUE) {
				$valid['success'] = true;
				$valid['messages'] = "Successfully Updated";		
			} else {
				$valid['success'] = false;
				$valid['messages'] = "Error while updating the password";	
			}

		} else {
			$valid['success'] = false;
			$valid['messages'] = "New password does not match with Conform password";
		}

	} else {
		$valid['success'] = false;
		$valid['messages'] = "Current password is incorrect";
	}

	$connect->close();

	echo json_encode($valid);

}

?>