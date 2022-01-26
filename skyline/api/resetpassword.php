<?php
$response="FAILED";
if($_POST) {
    include 'db_connect.php';	
    $email = addslashes($_POST['email']);
    $password=addslashes($_POST['password']);
    $token=addslashes($_POST['code']);
	$sql = "SELECT * FROM `password_reset_tokens` WHERE `email` = '$email' and `token`='$token'";
	$result = $connect->query($sql);
    if($result->num_rows>0) {
        $sql="UPDATE `customertbl` SET `password`='$password' WHERE `email`='$email'";
		if($connect->query($sql) === TRUE){
            $sql="DELETE FROM `password_reset_tokens` WHERE `email`='$email'";
            $connect->query($sql);
            $response="ok";
		} 
    }
       
     $connect->close();
}
echo $response;
?>