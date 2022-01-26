<?php 

//require_once 'core.php';
require_once 'db_connect.php';

if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());

	//$currentPassword = md5($_POST['password']);
	$fname = $_POST['fname']; 
	$lname = $_POST['lname']; 
	$phone1 = $_POST['phone1']; 
	$phone2 = $_POST['phone2'];
	
	$city = $_POST['city']; 
	$street = $_POST['street'];
	$state = $_POST['state'];
	$zip = $_POST['zip'];
	$image = $_POST['company_pic'];
	
	$regdate = $_POST['regDate'];
	
	$UserId = $_POST['user_id'];
	
    //echo $sql = "UPDATE partnertbl SET brand_name = '$brandName', brand_active = '$brandStatus' WHERE brand_id = '$brandId'";
    $sql = "UPDATE `partnertbl` SET `fname`='$fname',`lname`='$lname',`phone1`='$phone1',`phone2`='$phone2',`street`='$street',`city`='$city',`state`='$state',`zip`='$zip',`company_pic`='$image',`regDate`='$regdate' WHERE id= '$UserId'";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ".$sql;	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the partner".mysqli_error($connect);
	}
	 
	$connect->close();

	echo json_encode($valid);

}

?>