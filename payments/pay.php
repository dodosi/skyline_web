<?php 	
require_once 'db_connect.php';
$response='';

if($_GET) {
	$paymentId = addslashes($_GET['id']);
	$txid=addslashes($_GET['trx']);
    $amount=addslashes($_GET['amount']);
    $status=addslashes($_GET['status']);
	//check phone validity
	 
		$sql="INSERT INTO `payments`(`payment_id`, `item_number`, `txn_id`, `payment_gross`, `currency_code`, `payment_status`) 
		                     VALUES ('$paymentId',   'NONE',       '$txid','$amount',          'USD',              '$status')";
		
        if($connect->query($sql) === TRUE){
			$response="ok";
		} else {
			$response="FAILED";
		}
	$connect->close();
 
}
echo $response;
?>