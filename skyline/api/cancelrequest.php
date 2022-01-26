<?php 	

require_once 'db_connect.php';
include 'utils.php';
$response='FAILED';

if($_POST) {	
    $id = addslashes($_POST['id']);
	$email=addslashes($_POST['email']);
	//check phone validity
	if(getBookingStatus($id)<3){
        $sql="UPDATE `booking` SET status='10' WHERE id='$id' and email='$email'";
        if($connect->query($sql) === TRUE) {
            $response='ok';
        }
    }
	$connect->close();
    echo $response;    
 
} 
?>