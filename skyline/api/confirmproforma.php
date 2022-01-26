<?php 	

require_once 'db_connect.php';
include 'utils.php';
$response='';

if($_POST) {	
    $id= addslashes($_POST['id']);
    $status= addslashes($_POST['response']);
	if(getBookingStatus($id)<7){
	$sql="UPDATE `booking` SET `status`='$status' WHERE id='$id'";
	$sql2="UPDATE `invoice_order` SET `state`='2' WHERE `bookingID`='$id' ";
		if($connect->query($sql) === TRUE && $connect->query($sql2)===TRUE) {
                $response="ok";
        }else{
				$response="FAILED ";
		}
		$connect->close();
    }else{
		$response="FAILED ";
	}
}
echo $response;
?>