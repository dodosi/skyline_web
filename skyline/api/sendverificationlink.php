<?php
$response="FAILED";
if($_POST) {
    include 'db_connect.php';	
    include 'utils.php';
    $email = addslashes($_POST['email']);
    //$email='ukudox@gmail.com';
    $code=rand(100000, 999999);
    $link='http://skylineautoservices.co/admin/skyline/api/verifyemail.php?code='.$code;
   // $flink='<a href="'.$link.'">here</a>';
    $verificationlink='Verify your email by clicking this link '.$link;
	 if(isEmailValid($email)){
        $sql="INSERT INTO `password_reset_tokens`(`email`, `token`) 
                                          VALUES('$email','$code')";
        //echo $sql;
        if($connect->query($sql) === TRUE){
            sendEmail($email,'Verify Your Email.',$verificationlink);
			$response="ok";
		} 
     }else{
        echo 'Invalid email';
     }
	$connect->close();
}
echo $response;
?>