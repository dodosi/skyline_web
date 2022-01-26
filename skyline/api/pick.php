<?php 	

include 'db_connect.php';
include 'notification.php';

$response="FAILED";

if($_POST) {	
    $request_id = addslashes($_POST['id']);
	$driver_email=addslashes($_POST['email']);
	// $request_id = '6';
    // $driver_email='kakaka@gmail.com';
	$sql = "SELECT id,request_id FROM `pick` WHERE `request_id`='$request_id'";
	$result = $connect->query($sql);
	if($result->num_rows == 0) { 
	    $sql1="INSERT INTO `pick`(`request_id`, `driver_email`) 
						  VALUES ('$request_id','$driver_email')";
		//echo  $sql1;
		$sql2="UPDATE `booking` SET status='3' WHERE id='$request_id'";
		if($connect->query($sql1) === TRUE) {
            if($connect->query($sql2) === TRUE){
				$token=getTokenByRequestId($request_id);
				sendNotification($token,'Pick Status','Dear esteemed customer, I am coming to pick up your car');
                $response="ok";
            }else{
				$response="FAILED ";
			}
		} else {
			$response="ERROR PROCESSING REQUEST ";
		}
    }else{
		$response="Picked";
	}
	$connect->close();

	echo $response;
 
} // /if $_POST


?>