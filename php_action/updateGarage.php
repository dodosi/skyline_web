<?php 

//require_once 'core.php';
require_once 'db_connect.php';



if($_POST) {

	$valid['success'] = array('success' => false, 'messages' => array());
	
    // File upload path
 
		
		
	//$currentPassword = md5($_POST['password']);
	$fname = $_POST['fname'];  
	$phone1 = $_POST['phone1']; 
	$email = $_POST['email'];
	$weblink = $_POST['weblink'];
	
	$image = $_FILES['companyPic']['name']; //$_POST['companyPic'];//$_POST['file']; //basename($_FILES["file"]["name"]);
	
	$target_dir = "./images/";
    $target_file = $target_dir . basename($_FILES["companyPic"]["name"]);
	
	// Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
	
	if( in_array($imageFileType,$extensions_arr) ){
       move_uploaded_file($_FILES['companyPic']['tmp_name'],$target_dir.$image);
	}else{
	   echo "Not done";
	}
	
	$state = $_POST['state'];
	$city = $_POST['city']; 
	$street = $_POST['street'];
	$zip = $_POST['zip'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];	
	
	$UserId = $_POST['user_id'];
	
    $sql = "UPDATE `garagetbl` SET `Name`='$fname',`Email`='$email',`Websitelink`='$weblink',`phone`='$phone1',`garage_thumbnail`='$image',`state`='$state',`city`='$city',`street`='$street',`zip`='$zip',`latitude`='$latitude',`longitude`='$longitude',`status`=1,`active`=1 WHERE `garageID`='$UserId'";
 
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Updated ".$sql;	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the garage ".$sql.$connect->error;
	}
	 
	$connect->close();

	echo json_encode($valid);

}

?>