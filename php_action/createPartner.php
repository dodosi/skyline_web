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
	
	//$state = $_POST['state'];
	
	
	//$picture = $_POST['picture'];
	//$proof = $_POST['proof'];
	
	
	$picture = $_FILES['picture']['name'];
	
	$target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["picture"]["name"]);
	
	// Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
	
	if( in_array($imageFileType,$extensions_arr) ){
       move_uploaded_file($_FILES['picture']['tmp_name'],$target_dir.$picture);
	} 
	
	//$proof = $_POST['proof'];
	$proof = $_FILES['proof']['name'];
	
	$target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["proof"]["name"]);
	
	// Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
	
	if( in_array($imageFileType,$extensions_arr) ){
       move_uploaded_file($_FILES['proof']['tmp_name'],$target_dir.$proof);
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
	
	$regDate = $_POST['regDate'];
	
	$garage_role = $_POST['garage_role'];
	$garageName = $_POST['garageName'];
	 
    
	$sql = "INSERT INTO partnertbl(fname, lname, phone1, phone2, email, password, street, city, state, zip, company_pic, doc_proof, regDate, user_type, garageID, active) 
	VALUES ('$fname','$lname','$phone1','$phone2','$email','$pass','$street','$city','$state','$zip','$picture','$proof','$regDate','$garage_role','$garageName',0)";
	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Successfully Added ";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error while adding the members ";
	}

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST