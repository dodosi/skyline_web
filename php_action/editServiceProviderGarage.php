<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	
     
	 
	 
	$brandName = $_POST['editserviceName']; 
	$categoryName = $_POST['editgarageName']; 
        $brandStatus = $_POST['editCategoriesStatus']; 
        $categoriesId = $_POST['editCategoriesId'];

	//$sql = "UPDATE categories SET categories_name = '$brandName', TinNumber = '$companuTin', po_email = '$companyEmail', po_phone = '$companyPhone', categories_active = '$brandStatus' WHERE categories_id = '$categoriesId'";
    //$sql = "UPDATE `servicestbl` SET `serviceName`='$brandName',`serviceCategory`='$categoryName',`status`='$brandStatus' WHERE servID = '$categoriesId'";
	$sql = "UPDATE `serviceprovider` SET `provider_ID`='$categoryName',`service_ID`='$brandName',`status`='$brandStatus' WHERE id = '$categoriesId'";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while updating the Service ";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST