<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone1 = $_POST['phone1'];
	$phone2 = $_POST['phone2'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$pass = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
	
	$street = $_POST['street'];
	$state = $_POST['state'];
	 
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$picture = $_POST['picture'];
	$proof = $_POST['proof'];
	$regDate = $_POST['regDate'];
	
	$garage_role = $_POST['garage_role'];
	$garageName = $_POST['garageName'];
	 
    
	$sql = "INSERT INTO partnertbl(fname, lname, phone1, phone2, email, password, street, city, state, zip, company_pic, doc_proof, regDate, user_type, garageID, active) 
	VALUES ('$fname','$lname','$phone1','$phone2','$email','$pass','$street','$city','$state','$zip','$picture','$proof','$regDate',4,0,1)";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ".$sql;	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members ".$sql;
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST