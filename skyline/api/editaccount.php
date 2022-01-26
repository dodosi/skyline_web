<?php 	

require_once 'db_connect.php';

$response="FAILED";

if($_POST) {	
    $firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$phone = addslashes($_POST['phone']);
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$token=addslashes($_POST['token']);
	$cpassword = addslashes($_POST['cpassword']);
	$token=addslashes($_POST['token']);
	$streetNumber=addslashes($_POST['street_number']);
	$city=addslashes($_POST['city']);
	$state=addslashes($_POST['state']);
	$zipcode=addslashes($_POST['zip_code']);
	
	//check phone validity
	 
		$sql="UPDATE `customertbl` SET `fname`='$firstname', `lname`='$lastname', `phone`='$phone', `password`='$password' ,`token`='$token',`street_number`='$streetNumber',`city`='$city'
		,`state`='$state',`zip_code`='$zipcode' WHERE `email`='$email' and `password`='$cpassword'";
		if($connect->query($sql) === TRUE) {
				$response='ok';
				
		} else {
				
		}
	$connect->close();

	echo $response;
 
} // /if $_POST
?>