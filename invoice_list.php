<?php 
session_start();
include('includes/header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
//include'skyline/api/notification.php';
?> 
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet"> 
<style>
 div.dataTables_wrapper {
        width: 1000px;
        margin: 0 auto;
    }
</style>
 <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="images/Skyline-logo3.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="images/Skyline-logo3.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu"> 
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="images/admin.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
						    <a class="nav-link" href="#"><i class="fa fa- user"></i><?php echo htmlspecialchars($_SESSION["email"]); ?></a>
                            <a class="nav-link" href="myprofile"><i class="fa fa- user"></i>My Profile</a>
 
                            <a class="nav-link" href="settings"><i class="fa fa -cog"></i>Settings</a>

                            <a class="nav-link" href="logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
		
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Invoices Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Invoices</a></li>
                                    <li class="active">Data</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php //include('includes/menu.php');?>	
		<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">  
								 <strong class="card-title"><i class="fa fa-edit"></i> List of Invoices</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">  
	  		  
											  <table id="data-table" class="table table-condensed table-striped">
												<thead>
												  <tr>
													<th>No.</th>
													<th>Create_Date</th>
													<th>Customer_Name</th>
													<th>Invoice_Total</th>
													<th>Status</th>
													<th>Send</th>
													<th>Notify_Driver</th>
													<th>Notify_Customer</th>
													<th>Print</th>
													<th>Edit</th>
													<th>Delete</th>
												  </tr>
												</thead>
												<?php		
												$invoiceList = $invoice->getInvoiceList();
												$i=1;
												foreach($invoiceList as $invoiceDetails){
													$invoiceDate = date("m/d/Y h:i A ", strtotime($invoiceDetails["order_date"]));
													//date('m/d/Y h:i A ', strtotime($datetime));
													echo '
													  <tr>
														<td>'.$i.'</td>
														<td>'.$invoiceDate.'</td>
														<td>'.$invoiceDetails["order_receiver_name"].'</td>
														<td>'.$invoiceDetails["order_total_after_tax"].'</td>
														
														<td>';
														if($invoiceDetails['state'] == '2'){
															echo '<label class="label label-success">Approved for Payment</label>';
														}elseif($invoiceDetails['state'] == '1'){
															echo '<label class="label label-warning">Pending for approval</label>';
														}else{
															echo '<label class="label label-danger">Disapproved </label>';
														}  
														echo '</td>
														
														<td>';
														
														if($invoiceDetails['state'] == '1'){
														    echo '<a href="sendingEmail.php?invoice_id='.$invoiceDetails["order_id"].'"  title="Send Email"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
														}elseif($invoiceDetails['state'] == '2'){
															echo '<asa href=""  title="Already Sent Email"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
														}else{
															echo '<asa href=""  title="Already Sent Email"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
														}
														echo '
														</td>
														
														<td>';
														
														if($invoiceDetails['state'] == '1'){
														    echo '<asa href=""  title="Not yet notified driver"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
														}elseif($invoiceDetails['state'] == '2'){
															//echo '<a href=#"';
															//notifyDriver($invoiceDetails["order_id"]);  
															//echo '"  title="Notify Driver"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
                                                            echo '<form action="" method="post">
															         <input type="hidden" name ="ID" value ="'.$invoiceDetails["order_id"].'" title="Notify Driver"/>
			                                                         <input type="submit" name="driver" value="Notify"/>
																  
														        </form>';
															//echo '<a href="#?id='.$invoiceDetails["order_id"].'"  title="Notify Driver"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
													
                                                        }else{
															echo '<asa href=""  title="Already notified Driver"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
														}
														echo '
														</td>
														<td>';
														
														if($invoiceDetails['state'] == '1'){
															echo '<form action="" method="post">
															         <input type="hidden" name ="ID" value ="'.$invoiceDetails["order_id"].'" title="Notify Customer for proforma readiness"/>
			                                                         <input type="submit" name="customer" value="Notify"/>
																   
														             </form>';
														    //echo '<a href="notifyCust.php?invoice_id='.$invoiceDetails["order_id"].'"  title="Notify Customer for proforma readiness"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
														}elseif($invoiceDetails['state'] == '2'){
															//echo '<input type="hidden" name ="ID" value ="'.$invoiceDetails["order_id"].'" title="Notify Customer for"/><input type="submit" name="customer" value="Notify"/>';
															echo '<a href="notifyCustomer.php?invoice_id='.$invoiceDetails["order_id"].'"  title="Notify Customer"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
														}else{
															echo '<asa href=""  title="Already notified custoner"><i class="fa fa-bell-o" aria-hidden="true"></i></a>';
														}
														echo '
														</td> 
														<td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><span class="glyphicon glyphicon-print"></span></a></td>
														
														<td>';
														if($invoiceDetails['state'] == '2'){
														  echo '<asa href=""  title="Not allowed to Edit confirmed Invoice"><span class="glyphicon glyphicon-edit"></span></a>';
														}else{
														  echo '<a href="edit_invoice.php?update_id='.$invoiceDetails["order_id"].'"  title="Edit Invoice"><span class="glyphicon glyphicon-edit"></span></a></td>';
														}
														echo '
														
														<td>';
														if($invoiceDetails['state'] == '2'){
														  echo '<as href="#" class="deleteInvoice"  title="Not allowed to Delete confirmed Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>';
														}else{
														  echo '<a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span class="glyphicon glyphicon-remove"></span></a></td>';
														}
														echo '
														
														
													  </tr>
													';
													$i++;
												}
              if(isset($_POST['driver'])){
				    include('php_action/db_connect.php');
				    $id = $_POST['ID'];

					$squery = "SELECT * FROM `invoice_order` WHERE order_id =".$id; 
					//echo $squery;
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
						//sendNotification($token, $title, $message);
						push_notification_android($token, $title, $message);
						//$obj = json_decode($result);
						//die($obj);
						//die($obj->success);
						//if($obj->success>0){  
					      $bookDone = "UPDATE booking SET status = 9 WHERE id =".$to;
						  $results = $connect->query($bookDone);
						?>
							<div class="card">
								<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									Notification sent successfully to the Driver!  
									<?php
									   //print_r($obj);
									?> 
								</div>
							</div>
						<?php
						//} else { 
							?>
							<!--<div class="card">
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									Failed to send notification
									  <?php //print_r($obj);?> 
									  
								</div>
							</div>
						<?php
						//}
			 // }
		}
                  if(isset($_POST['customer'])){
				    include('php_action/db_connect.php');
				    $id = $_POST['ID'];

							$invoiceID = $_GET['invoice_id'];

							$squery = "SELECT * FROM `invoice_order` WHERE order_id =".$id;
							$results = $connect->query($squery);
							$red = $results->fetch_array();

							$bookingID = $red["bookingID"];
							$to = $red["email"]; 
								
							$queryGarageCar = "SELECT * FROM `booking` WHERE id =".$bookingID;
							$result2 = $connect->query($queryGarageCar);
							$garage = $result2->fetch_array();  
								$garageName = $garage['garage']; 
								$CarPlate = $garage['plate_number'];
					
						$email = $to;
						$title = "Notification from ".$garageName;
						$message = "Dear customer! The car of plate number: ".$CarPlate." Pro forma is ready to be approved. Thanks";
						$fetchToken = $connect->prepare("SELECT token FROM customertbl WHERE email=?");
						$fetchToken->bind_param("s",$email);
						$fetchToken->execute();
						$fetchToken->store_result();
						$fetchToken->bind_result($token);
						$fetchToken->fetch();
						$fetchToken->close();
						//sendNotification($token, $title, $message);
						push_notification_android($token, $title, $message);
						//$obj = json_decode($result);
						//die($obj);
						//die($obj->success);
						//if($obj->success>0){  
						   //$bookDone = "UPDATE booking SET status = 9 WHERE id =".$to;
							//$result = $connect->query($bookDone);
						 
								echo '<div class="card">
								<div class="alert alert-success alert-dismissible">
									<button type="button" class="close" data-dismiss="alert">&times;</button>
									Notification sent successfully to the Customer!  
									 
								</div>
							</div>';  
		}
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
<!-- .content -->
						</table>	
                         </div>
                        </div>
                    </div> 

                </div>
            </div> 
        </div>
        <div class="clearfix"></div>
		<?php 
			  require("include/footer.php");
			?> 
</div><!-- .content -->
<script> 
$(document).ready(function () {
$('#data-table').DataTable({ 
        "scrollX": true
});
$('.dataTables_length').addClass('bs-select');
});
</script> 
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<?php include('includes/footers.php');?>