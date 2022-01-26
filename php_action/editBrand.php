<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

  $brandName = $_POST['editBrandName'];
  $wucFname = $_POST['editWucFname'];
  $wucLname = $_POST['editWucLname'];
  $wucEmail = $_POST['editWUCEmail'];
  $wucPhone = $_POST['editWUCPhone'];
  $brandStatus = $_POST['editBrandStatus']; 
  $brandId = $_POST['brandId'];

	$sql = "UPDATE brands SET brand_name = '$brandName',wuc_fname = '$wucFname',wuc_lname = '$wucLname',wuc_email = '$wucEmail',wuc_phone = '$wucPhone', brand_active = '$brandStatus' WHERE brand_id = '$brandId'";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members";
	}
	 
	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST