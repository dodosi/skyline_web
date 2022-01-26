<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
      
	$name = $_POST['editname'];
	$email = $_POST['editemail'];
	$phone = $_POST['editphone'];
	$image = $_POST['editthumbnail'];
	$web = $_POST['editweblink'];
	$longitude = $_POST['editlongitude'];
	$latitude = $_POST['editlatitude'];
	
	$state = $_POST['editstate'];
	$city = $_POST['editcity'];
	$street = $_POST['editstreet'];
	$zip = $_POST['editzip'];
	
    $brandStatus = $_POST['editgarageStatus']; 
    $categoriesId = $_POST['editCategoriesId'];

	//$sql = "UPDATE categories SET categories_name = '$brandName', TinNumber = '$companuTin', po_email = '$companyEmail', po_phone = '$companyPhone', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";
    $sql ="UPDATE garagetbl SET Name='$name',Email='$email',Websitelink='$web',phone='$phone',garage_thumbnail='$image',state='$state',city='$city',street='$street',zip='$zip',latitude='$latitude',longitude='$longitude',status='$brandStatus' WHERE garageID = '$categoriesId'";
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