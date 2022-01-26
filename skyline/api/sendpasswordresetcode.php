<?php
$response="FAILED";
if($_POST) {
    include 'db_connect.php';	
    include 'utils.php';
    $email = addslashes($_POST['email']);
    $code=rand(100000, 999999);
    $message="Dear Esteemed customer, use this code: ".$code.' to reset password';
	 if(isEmailValid($email)){
        $sql="INSERT INTO `password_reset_tokens`(`email`, `token`) 
                  VALUES('$email','$code')";
		if($connect->query($sql) === TRUE){
            sendEmail($email,'PASSWORD RESET CODE',$message);
			$response="ok";
		} 
     }else{
         echo 'Invalid email '.$email;
     }
		
	$connect->close();
}
echo $response;
?>