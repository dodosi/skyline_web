<?php 	

require_once 'db_connect.php';
$response='';

if($_POST) {	
    $request_id = addslashes($_POST['id']);
	$rate=addslashes($_POST['rate']);
	$review=addslashes($_POST['review']);
	//check phone validity
	 
		$sql="INSERT INTO `rating`(`request_id`, `rate`,`review`) VALUES ($request_id,$rate,'$review')";
		
        if($connect->query($sql) === TRUE){
			$response="ok";
		} else {
			$response="FAILED";
		}
	$connect->close();
 
}
echo $response;
?>