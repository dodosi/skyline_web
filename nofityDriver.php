<?php
		session_start();
		include('includes/headers.php');
		require_once "php_action/db_connect.php"; 
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
		include "Invoice.php";
		$invoice = new Invoice();
		$invoice->checkLoggedIn();
         
		$invoiceID = $_GET['invoice_id'];

		$squery = "SELECT * FROM `invoice_order` WHERE order_id =".$_GET['invoice_id'];
	    //echo $squery."<br>";
		$results = $connect->query($squery);
		$red = $results->fetch_array();

 
		$to = $red["bookingID"];
		  
		$squery1 = "SELECT * FROM `pick` WHERE request_id =".$to;
		$result = $connect->query($squery1);
		$red1 = $result->fetch_array();  
	        $driver = $red1['driver_email']; 
			
		$queryGarageCar = "SELECT * FROM `booking` WHERE id =".$to;
		$result2 = $connect->query($queryGarageCar);
		$garage = $result2->fetch_array();  
	        $garageName = $garage['garage']; 
			$CarPlate = $garage['plate_number'];
			
			?>
			
<?php
if(isset($_GET['invoice_id'])){
	$email = $driver;
	$title = "Notification from ".$garageName;
	$message = "Dear driver! The car of plate number: ".$CarPlate." is ready for drop off. Thanks";
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
	   $bookDone = "UPDATE booking SET status = 9 WHERE id =".$to;
		$result = $connect->query($bookDone);
	?>
		<div class="container">
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Notification sent successfully to the Driver!  
				<?php
				   
				?>
				<a href="https://www.skylineautoservices.co/admin/invoice_list"  title="Go Back"><i class="fa fa-paper-plane" aria-hidden="true"> GO BACK</i></a>
			</div>
		</div>
	<?php
	} else {
		foreach ($obj as $method_name) 
				{
					//echo $method_name."<br/>";
				} 
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
 
function push_notification_android($device_id, $title, $message){
    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';
 
    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
	$api_key = 'AAAAe58yxEI:APA91bHZn9V9DumfYAbzJuAdkLZ6cs3kiVyW9lyVdt2aF-S5DaZ6sX4UMv2Xopqh1t9cuNmsdTcS3MYx99a3azslzmVYqT5cbJGbbe09Y7n27X7WUu8JX9IMaHVO3-qybYYvnibcw_8d'; //Replace with yours
	
	$target = $device_id;
	
	$fields = array();
	$fields['priority'] = "high";
	$fields['notification'] = [ "title" => $title, 
				    "body" => $message, 
				    'data' => ['message' => $message],
				    "sound" => "default"];
	if (is_array($target)){
	    $fields['registration_ids'] = $target;
	} else{
	    $fields['to'] = $target;
	}
 
    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    return $result;
}
?>