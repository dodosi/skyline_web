<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	$fname = $_POST['editfname']; 
	$lname = $_POST['editlname'];
	$phone1 = $_POST['editphone1'];
	$phone2 = $_POST['editphone2'];
    $email = $_POST['editemail']; 
    $street = $_POST['editstreet']; 
    $city = $_POST['editcity']; 
	$state = $_POST['editstate']; 
	$zip = $_POST['editzip']; 
	$regDate = $_POST['editregDate'];  
					 
    $brandStatus = $_POST['editStatus'];  
    $categoriesId = $_POST['editCategoriesId'];

	$sql ="UPDATE partnertbl SET fname='$fname',lname='$lname',phone1='$phone1',phone2='$phone2',email='$email',street='$street',city='$city',state='$state',zip='$zip',regDate='$regDate',active='$brandStatus' WHERE id ='$categoriesId'";	
	//$sql ="UPDATE partnertbl SET fname='$fname',lname='$lname'WHERE id ='$categoriesId'";
	
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the categories ";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST