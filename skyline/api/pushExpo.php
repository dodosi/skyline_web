<?php
//sendPaymentRequest("","","");
sendExpoNotification("","","");
function sendExpoNotification($to,$title,$body){
	//$token='';
	$postData="{
	  \"to\": \"ExponentPushToken[xxxxxxxxxxxxxxxxxxxxxx]\",
	  \"title\":\"salama\",
	  \"body\": \"Ni sawa\"
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
    var_dump($response);
	/*
	echo curl_getinfo($ch) . '<br/>';
	echo curl_errno($ch) . '<br/>';
	echo curl_error($ch) . '<br/>';
*/
	curl_close($ch);
}
?>