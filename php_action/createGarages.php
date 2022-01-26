<?php 	

require_once 'db_connect.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	 
	 
	 
	$garageName = $_POST['garageName'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$weblink = $_POST['weblink']; 
			
	$thumbnail = $_FILES['picture']['name'];
	
	$target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
	
	// Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
	
	if( in_array($imageFileType,$extensions_arr) ){
       move_uploaded_file($_FILES['picture']['tmp_name'],$target_dir.$thumbnail);
	} else{
		$valid['success'] = false;
	 	$valid['messages'] = "Not moved to the directory ";
	}
			
	//$state = $_POST['state'];
	$sql = "SELECT statename from statetbl WHERE id =".$_POST['state'];
	$result = $connect->query($sql);
	if($result->num_rows > 0){  
    while($row = $result->fetch_assoc()){  
      $state = $row['statename'];
      } 
     } 
	 
	$city = $_POST['city'];
	$street = $_POST['street'];
	$zip = $_POST['zip'];
	$latitude = $_POST['latitude'];
	$longitude = $_POST['longitude'];
	$status = $_POST['garageStatus'];

 
	$sql = "INSERT INTO garagetbl(Name, Email, Websitelink, phone, garage_thumbnail, state, city, street, zip, latitude, longitude, working_hourID, working_dayID, status, active) 
	VALUES ('$garageName','$email','$weblink','$phone','$thumbnail','$state','$city','$street','$zip','$latitude','$longitude','','','$status', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the garage ";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST