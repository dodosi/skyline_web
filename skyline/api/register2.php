<?php 	

require_once 'db_connect.php';

$response='FAILED';

if($_POST) {	
    $firstname = addslashes($_POST['firstname']);
	$lastname = addslashes($_POST['lastname']);
	$phone = addslashes($_POST['phone']);
	$email = addslashes($_POST['email']);
	$password = addslashes($_POST['password']);
	$token=addslashes($_POST['token']);
	$streetNumber=addslashes($_POST['street_number']);
	$city=addslashes($_POST['city']);
	$state=addslashes($_POST['state']);
	$zipcode=addslashes($_POST['zip_code']);
	$userType=addslashes($_POST['type']);
	$active='1';
	$status='1';
	//check phone validity
	$sql = "SELECT * FROM customertbl WHERE email = '$email'";
	$result = $connect->query($sql);
     if($result->num_rows >0) {
		$response='booked';
	 }else{
		$sql="INSERT INTO `customertbl`(`fname`, `lname`, `phone`, `email`, `user_type`, `street_number`, `city`, `state`, `zip_code`, `password`, `token`, `status`, `active`)
		VALUES ('$firstname','$lastname','$phone','$email','$userType','$streetNumber','$city','$state','$zipcode','$password','$token','$status','$active')";
		if($connect->query($sql) === TRUE) {
		$response='ok';

		} else {
		$response='FAILED';
		}
	}
	 
		
	$connect->close();

	echo $response;
 
} // /if $_POST
?>