<?php 

//require_once 'core.php';
require_once 'db_connect.php';

echo "Hello <br/>";

	$valid['success'] = array('success' => false, 'messages' => array());
	$pass="inema06";
	$pass1 = password_hash($pass, PASSWORD_DEFAULT);
	echo $pass1;
	echo "<br/>";
    echo "current Not hashed password: ".$password = trim($pass);
	echo "<br/>";
	//$currentPassword = md5($_POST['password']);
	echo "current password: ".$currentPassword =$password;
	echo "<br/>";
	
	$newpass = "kaka123";
	//$newPassword = md5($_POST['npassword']);
	echo "New hashed password: ".$newPassword = password_hash($newpass, PASSWORD_DEFAULT);
	echo "<br/>";
	//$conformPassword = md5($_POST['cpassword']);
	$cpassword = "kaka123";
	echo "Confirmed hashed password: ".$conformPassword = $cpassword;
	echo "<br/>";
	$userId = 5;

	echo $sql ="SELECT * FROM partnertbl WHERE id = {$userId}";
	echo "<br/>";
	$query = $connect->query($sql);
	$result = $query->fetch_assoc();
    echo "current password: ".$result['password'];
	echo "<br/>";
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

?>