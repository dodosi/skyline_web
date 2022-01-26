<?php

require_once 'db_connect.php';
$response="FAILED";
if($_POST) {		
$email = $_POST['email'];
$password = $_POST['password'];

	$sql = "SELECT * FROM customertbl WHERE email = '$email' and `user_type`='DRIVER' and `status`='2'";
	$result = $connect->query($sql);

	if($result->num_rows>0) {
		//$password = md5($password);
		// exists
		$mainSql = "SELECT * FROM customertbl WHERE email = '$email' AND password = '$password'";
		$mainResult = $connect->query($mainSql);

		if($mainResult->num_rows == 1) {
			$response="ok";
			
		} else{
			
			$errors = "Incorrect Email/password combination";
			echo $errors;
		} // /else
	} else {		
		echo "Email does not exists";	
		//header('location:index.php');			
	} // /else
} // /if $_POST
echo $response;
?>