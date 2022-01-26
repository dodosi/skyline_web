<?php 	

require_once 'db_connect.php';
$response='';

if($_POST) {	
    $names = addslashes($_POST['names']);
	$phone=addslashes($_POST['phone']);
    $email=addslashes($_POST['email']);
    $message=addslashes($_POST['message']);
	//check phone validity
	 
		$sql="INSERT INTO `contactus`( `names`, `email`, `phone`, `message`)  VALUES ('$names','$email','$phone','$message')";
		
        if($connect->query($sql) === TRUE){
			$response="ok";
		} else {
			$response="FAILED";
		}
	$connect->close();
 
}
echo $response;
?>