<?php
		session_start();
		include('includes/headers.php');
		require_once "php_action/db_connect.php"; 
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}


//die($_SESSION["id"]);
//echo "ID : ".$_SESSION['id'];
//die("Role : ".$_SESSION['user_type']); 
		include "Invoice.php";
		$invoice = new Invoice();
		$invoice->checkLoggedIn();
         
		$invoiceID = $_GET['invoice_id'];

		$squery = "SELECT * FROM `invoice_order` WHERE order_id =".$_GET['invoice_id'];
		$results = $connect->query($squery);
		$red = $results->fetch_array();

        $bookingID = $red["bookingID"];
		$to = $red["email"];
		  
		/* $squery1 = "SELECT * FROM `pick` WHERE request_id =".$to;
		$result = $connect->query($squery1);
		$red1 = $result->fetch_array();  
	        $driver = $red1['driver_email'];  */
			
		$queryGarageCar = "SELECT * FROM `booking` WHERE id =".$bookingID;
		$result2 = $connect->query($queryGarageCar);
		$garage = $result2->fetch_array();  
	        $garageName = $garage['garage']; 
			$CarPlate = $garage['plate_number'];
			
			?>
			
<?php
if(isset($_GET['invoice_id'])){
	$email = $to;
	$title = "Notification from ".$garageName;
	$message = "Dear customer! The car of plate number: ".$CarPlate." pro forma is ready. Thanks";
	$fetchToken = $connect->prepare("SELECT token FROM customertbl WHERE email=?");
	$fetchToken->bind_param("s",$email);
	$fetchToken->execute();
	$fetchToken->store_result();
	$fetchToken->bind_result($token);
	$fetchToken->fetch();
	$fetchToken->close();
	$result = push_notification_android($token, $title, $message);
	$obj = json_decode($result);
	//die($obj);
	//die($obj->success);
	if($obj->success>0){  
	   //$bookDone = "UPDATE booking SET status = 9 WHERE id =".$to;
		//$result = $connect->query($bookDone);
	?> 
			<div class="container">
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Notification sent successfully to the Customer!  
				<?php
				   
				?>
				<a href="https://www.skylineautoservices.co/admin/invoice_list"  title="Go Back"><i class="fa fa-paper-plane" aria-hidden="true"> GO BACK</i></a>
			</div>
		</div>
	<?php
	} else {
     ?>
	 		<div class="container">
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Failed to send notification
		          <?php //print_r($obj);?>
				  <a href="https://www.skylineautoservices.co/admin/invoice_list"  title="Go Back"><i class="fa fa-paper-plane" aria-hidden="true"> GO BACK</i></a>
				  
			</div>
		</div>
    <?php	 
	}
} 
								?>
								
<?php
function push_notification_android($token,$title,$message){
	if (strpos($token, 'ExponentPushToken')!==false) {
		sendExpoNotification($token,$title,$message);
	}else{
		define('API_ACCESS_KEY','AAAAe58yxEI:APA91bHZn9V9DumfYAbzJuAdkLZ6cs3kiVyW9lyVdt2aF-S5DaZ6sX4UMv2Xopqh1t9cuNmsdTcS3MYx99a3azslzmVYqT5cbJGbbe09Y7n27X7WUu8JX9IMaHVO3-qybYYvnibcw_8d');
		$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
	  //$token='eKSsNbdqTgWQcG_TLfXrDh:APA91bHeJ7jOvUCtA4lqT4Kzj1Lq0ipoWXpxBMPaEve0OAoT8IqqAUs-MbkJk5Zh9jNsQx0TpvCJXlTECvUl7RHTZJHOY7b9qPj9dyTF2ydCtjgrZ4aHC06mRGz0n3dGQrmiWJb-oUWu';
	   $notification = [
			   'title' =>$title,
			   'body' => $message,
			   'icon' =>'myIcon', 
			   'sound' => 'mySound'
		   ];
		   $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];
   
		   $fcmNotification = [
			   //'registration_ids' => $tokenList, //multple token array
			   'to'        => $token, //single token
			   'notification' => $notification,
			   'data' => $extraNotificationData
		   ];
   
		   $headers = [
			   'Authorization: key=' . API_ACCESS_KEY,
			   'Content-Type: application/json'
		   ];
           $ch = curl_init();
		   curl_setopt($ch, CURLOPT_URL,$fcmUrl);
		   curl_setopt($ch, CURLOPT_POST, true);
		   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		   curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		   $result = curl_exec($ch);
		   curl_close($ch);
		}
		   //echo $result;

}
function getTokenByRequestId($requestId){
	$token='';
	include 'db_connect.php';
	$sql = "SELECT `token` FROM `booking`,`customertbl`  WHERE `booking`.`id`='$requestId' and `booking`.`email`=`customertbl`.`email` ";
	//echo $sql;
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
		$token=$row['token'];
	}
    $connect->close();
	return $token;
}
function getTokenByEmail($email){
	$token='';
	require_once 'db_connect.php';
	$sql = "SELECT `token` FROM `customertbl`  WHERE `email`='$email' ";
	//echo $sql;
	$result = $connect->query($sql);
	while($row = $result->fetch_array()) {
		$token=$row['token'];
	}
    $connect->close();
	return $token;
}
function sendExpoNotification($to,$title,$body){
	$postData="{
	  \"to\": \"".$to."\",
	  \"title\":\"".$title."\",
	  \"body\":\"".$body."\"
	}";
	$ch = curl_init();
	//curl_setopt($ch, CURLOPT_URL, " https://expo-test-notification.herokuapp.com/api/push");
	curl_setopt($ch, CURLOPT_URL, "https://exp.host/--/api/v2/push/send");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "Content-Type: application/json",
	  "Accept: */*",
	  "Accept-Encoding: gzip, deflate, br",
	  "Connection:keep-alive",
	  "content-type: application/json"
	 
	));

	$response = curl_exec($ch);
    //var_dump($response);
	//var_dump($postData);
	/*
	echo curl_getinfo($ch) . '<br/>';
	echo curl_errno($ch) . '<br/>';
	echo curl_error($ch) . '<br/>';
*/
	curl_close($ch);
}
?>