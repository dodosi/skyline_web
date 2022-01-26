<?php
sendPaymentRequest();
 function sendPaymentRequest(){
	$message = "{
     \"to\": \"ExponentPushToken[k6H4V-AuUJQero4TB1ATh1]\",
     \"sound\":\"default\",
     \"title\":\"Original Titles\",
     \"body\":\"And here is the body!\"
  }";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "https://exp.host/--/api/v2/push/send");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, TRUE);
	curl_setopt($ch, CURLOPT_POST, TRUE);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $message);

	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	  "Content-Type: application/json",
	  "Accept-encoding: gzip, deflate",
	  "Accept: application/json"
	));

	$response = curl_exec($ch);
	echo $response;
	curl_close($ch);
	echo 'DOne';
	
}
?>