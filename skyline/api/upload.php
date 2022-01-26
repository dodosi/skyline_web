<?php
$response="INITITIALISATTION";
require_once 'db_connect.php';
if(isset($_REQUEST['submit'])){
   $response="FAILED 0";
    $fileName=basename($_FILES['files']['name']);
    $ext = end(explode('.', basename($_FILES['files']['name'])));
    $name=uniqid(rand()).'.'.$ext;
    $path='uploads/'.$name;
    $email=$_REQUEST['email'];
    $type=$_REQUEST['type'];

	if(move_uploaded_file($_FILES['files']['tmp_name'],$path)){
        $sql="INSERT INTO `documents`(`name`, `doc_type`,`email`) 
                              VALUES ('$path','$type','$email')";

        if($connect->query($sql) === TRUE){
            $response="ok";
        } else {
            $response="FAILED 1";
        }
	}
	else{
		$response="FAILED 2". $email;
    }
  echo $response; 
}
?>