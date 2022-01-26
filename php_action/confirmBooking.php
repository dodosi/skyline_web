<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['editCategoriesId'];

if($categoriesId) {
 $s =  "SELECT * FROM booking WHERE id = {$categoriesId}"; 
 $rs = $connect->query($s);
 $row = $rs->fetch_array();
 $garageName = $row['garage'];
 $CarPlate = $row['plate_number'];
 $customer = $row['email'];
 $sql = "UPDATE booking SET status = 2 WHERE id = {$categoriesId}";

 if($connect->query($sql) === TRUE) {
    $email = $customer;
	$title = "Notification from ".$garageName;
	$message = "Dear customer! Your request of : ".$CarPlate." car is accepted. See u soon. Thanks";
	$fetchToken = $connect->prepare("SELECT token FROM customertbl WHERE email=?");
	$fetchToken->bind_param("s",$email);
	$fetchToken->execute();
	$fetchToken->store_result();
	$fetchToken->bind_result($token);
	$fetchToken->fetch();
	$fetchToken->close();
	push_notification_android($token, $title, $message);
	//sendNotification($token, $title, $message);
	
 	$valid['success'] = true;
	$valid['messages'] = "Successfully booking confirmed ";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while confirming the booking ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST

 
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