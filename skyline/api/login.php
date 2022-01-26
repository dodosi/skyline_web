<?php

require_once 'db_connect.php';
$response="FAILED";
if($_POST) {		
$email = $_POST['email'];
$password = $_POST['password'];

	$sql = "SELECT * FROM customertbl WHERE email = '$email'";
	$result = $connect->query($sql);

	if($result->num_rows>0) {
		//$password = md5($password);
		// exists
		$mainSql = "SELECT * FROM `customertbl` WHERE `email` = '$email' AND `password` = '$password' and `user_type`='CUSTOMER' and `status`='1'";
		$mainResult = $connect->query($mainSql);

		if($mainResult->num_rows == 1) {
			$response="ok";
			
		} else{
			
			$response = "Incorrect Email/password combination";
		
		} // /else
	} else {		
		$response= "Email does not exists";	
		//header('location:index.php');			
	} // /else
} // /if $_POST
$connect->close();
echo $response;
?>