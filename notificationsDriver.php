<?php
// Initialize the session
session_start();
 require_once 'php_action/db_connect.php';
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
//echo "ID : ".$_SESSION['id'];
//die("Role : ".$_SESSION['user_type']);
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

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
        <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skyline-Web App</title>
    <meta name="description" content="Skyline-Web App">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/logo2.png">
    <link rel="shortcut icon" href="images/logo2.png"> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
	

	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />


	
	  <!-- bootstrap -->
	
	  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	  <!-- bootstrap theme-->
	  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	  <!-- font awesome -->
	  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

		  <!-- custom css
	<link rel="stylesheet" href="custom/css/custom.css"> -->
	
		<!-- DataTables -->
	  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">


	  <!-- file input -->
	  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">
	  
  	
	  <!-- jquery -->
	  <script src="assests/jquery/jquery.min.js"></script>
	  <!-- jquery ui  --> 
	  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
	  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

	  <!-- bootstrap js-->
	  <script src="assests/bootstrap/js/bootstrap.min.js"></script> 

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }
		
		@media screen {
    #printSection {
        display: none;
    }
}
@media print {
    body * {
        visibility:hidden;
    }
    #printSection, #printSection * {
        visibility:visible;
    }
    #printSection {
        position:absolute;
        left:0;
        top:0;
    }
}
.css-serial {
 counter-reset: serial-number;  
}
.css-serial td:first-child:before {
 counter-increment: serial-number; 
 content: counter(serial-number);  
}

    </style>
</head>

<body>
    <!-- Left Panel -->
     <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                  <ul class="nav navbar-nav">
				   
					<?php
				      include ("leftmenues.php");
					?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
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
                                <h1>Notifications Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Notifications</a></li>
                                    <li class="active">Data</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">  
								 <strong class="card-title"><i class="fa fa-edit"></i> Sending Notification</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">  
							
						    <?php 
                                $garageName = $_SESSION["garagename"];?>
								<form action="" method="post">
									<div class="form-group">
										<label for="ids">Select Email:</label>
										<select class="form-control" id="ids" name="email" required>
										<option value="">Select Email</option>
										<?php
                                        $query ="SELECT 
											customertbl.fname,customertbl.lname,customertbl.user_type, customertbl.email , 
											booking.id, booking.plate_number,booking.engine_number,booking.car_color,booking.garage, 
											pick.id,pick.request_id,pick.driver_email, pick.date 

											FROM customertbl, booking, pick

												WHERE  
												  pick.request_id = booking.id AND
												  customertbl.email = pick.driver_email AND
												  
												  customertbl.user_type = 'Driver' AND
												  
												  booking.garage ='$garageName'
												  
												  GROUP BY request_id ORDER BY pick.date DESC";
											if($result = $connect->query($query)){
                                                                                               
												while($row = $result->fetch_assoc()){
													$email = $row['email'];
                                                    $d = date('m/d/Y h:i A ', strtotime($row['date']));
                                                    ?>
													<option value="<?php echo $email; ?>"><?php echo $row['fname']." || ".$row['lname']." || ".$row['plate_number']." || ".$row['car_color']." || ".$d; ?></option>
												<?php
												}
											}else{
                                                echo "<option value=''>No driver dropped the car to your garage yet</option>";
                                            }
										?>
										</select>
									</div>
									<div class="form-group">
										<label for="title">Email Title:</label>
										<input type="text" class="form-control" placeholder="Enter Title" name="title" id="title" required>
									</div>
									<div class="form-group">
										<label for="msg">Enter Message:</label>
										<input type="text" class="form-control" placeholder="Enter Message" name="message" id="msg"  required>
									</div>
									<button type="submit" name="submitbtn" class="btn btn-primary">Submit</button>
								</form> 
							
<?php
								if(isset($_POST['submitbtn'])){
	$email = $_POST['email'];
	$title = $_POST['title'];
	$message = $_POST['message'];
	$fetchToken = $connect->prepare("SELECT token FROM customertbl WHERE email=?");
	$fetchToken->bind_param("s",$email);
	$fetchToken->execute();
	$fetchToken->store_result();
	$fetchToken->bind_result($token);
	$fetchToken->fetch();
	$fetchToken->close();
	push_notification_android($token, $title, $message);
	//$obj = json_decode($result);
	//die($obj);
	//die($obj->success);
	//if($obj->success>0){ 
	
	//echo($obj->success);
	?>
		<div class="container">
			<div class="alert alert-success alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Notification sent successfully!
			</div>
		</div>
	<?php
	//} else {
		//foreach ($obj as $method_name) 
				//{
					//echo $method_name."<br/>";
				//} 
		?>
		<!--<div class="container">
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
				Failed to send notification
			</div>
		</div> -->
	<?php
	//}
}
								?>
							
										
							
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>

         <?php
			  require("include/footer.php");
			?>

    </div><!-- /#right-panel -->
<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm1" action="php_action/editCategory" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Booking Details</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages1"></div>
              <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Customer Information</strong></div>
                            <div class="card-body card-block"> 
								<div class="form-group">
								    <label for="street" class="col-sm-4 control-label">First name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "fname" id="editfname" class="form-control"readonly>
									   </div>
								 </div> 
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Last name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "lname" id="editlname" class="form-control"readonly>
									   </div>
								 </div> 
								  
								  <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Phone:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone1" id="editphone1"class="form-control"readonly>
									   </div>
								 </div>  
								  <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">State:</label>
									  <div class="col-sm-8">
								         <input type="text" name="editstate" id="editstate"class="form-control"readonly>
									   </div>
								 </div>
								  <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">City:</label>
									  <div class="col-sm-8">
								         <input type="text" name="editcity" id="editcity"class="form-control"readonly>
									   </div>
								 </div>
								  <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Zipcode:</label>
									  <div class="col-sm-8">
								         <input type="text" name="editzipcode" id="editzip"class="form-control"readonly>
									   </div>
								 </div>
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Client Email:</label>
									  <div class="col-sm-8">
								         <input type="text" name="email" id="editemail" class="form-control" readonly>
									   </div>
								 </div>  
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Car and Driver information</strong></div>
                            <div class="card-body card-block"> 
								<div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Service:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="editservice"class="form-control"readonly>
									   </div>
								 </div> 
								<div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Car Model:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="editmodel"class="form-control"readonly>
									   </div>
								 </div>
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Car Make:</label>
									  <div class="col-sm-8">
								         <input type="text" name="state"id="editmaked" class="form-control"readonly>
									   </div>
								 </div>
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Platnumber:</label>
									  <div class="col-sm-8">
								         <input type="text" name="city"id="editplate"class="form-control"readonly>
									   </div>
								 </div> 
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Car color:</label>
									  <div class="col-sm-8">
								         <input type="text" name="zip"id="editcolor" class="form-control"readonly>
									   </div>
								 </div>
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Description:</label>
									  <div class="col-sm-8">
								         <input type="text" name="zip"id="editdescription" class="form-control"readonly>
									   </div>
								 </div>
                                 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Picked Date:</label>
									  <div class="col-sm-8">
								         <input type="text" name="regDate" id="editpick"  class="form-control"readonly>
									   </div>
								 </div> 			  
                            </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	      <div class="modal-footer"> 
	        
            <!-- <button type="button" id="Print" class="btn btn-primary">Print</button> --> 
			<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
	        <button type="button" id="Print" class="btn btn-success"> <i class="fa fa-check"></i> Print report</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- /categories brand -->

<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/assignMechanical.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Assign Mechanical to a service</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
                                <div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">First name</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="fname" id="editfname1" class="form-control" readonly> 
                                    </div>
                                </div> 
								<div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Last name</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="lname" id="editlname1" class="form-control" readonly> 
                                    </div>
                                </div>
                                 <div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Phone number</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="phone" id="editphone" class="form-control" readonly> 
                                    </div>
                                </div>
								 <div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Service:</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="phone" id="editservicess" class="form-control" readonly> 
                                    </div>
                                </div>
								<div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Email</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="email1" id="editemail1" class="form-control" readonly> 
                                    </div>
                                </div>
								<div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Mechanical Names</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="names" id="editnames" class="form-control"> 
                                    </div>
                                </div> 	
                               </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	      <div class="modal-footer editCategoriesFooter"> 
	        
            <!-- <button type="button" id="Print" class="btn btn-primary">Print</button> --> 
			<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
			<button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	        <!--<button type="submit" id="editCategoriesBtn"class="btn btn-success"> <i class="fa fa-check"></i> Save changes</button>-->
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div> 

<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModalD" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm2" action="php_action/rejectBooking.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Reject the request with comments</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="comments-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Do you want to reject this request? </strong></div>
							
                            <div class="card-body card-block">   
								<div class="row form-group"> 
									<label for="postal-code" class="col-sm-4 form-control-label">Comments:</label>
                                    <div class="col-sm-8"> 
										<textarea name="comments" id="comments" cols="10" rows="2" class="form-control">
                                        </textarea>										
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	      <div class="modal-footer editCategoriesFooterD"> 
	        
            <!-- <button type="button" id="Print" class="btn btn-primary">Print</button> --> 
			<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
			<button type="submit" class="btn btn-success" id="editCategoriesBtn2" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	        <!--<button type="submit" id="editCategoriesBtn"class="btn btn-success"> <i class="fa fa-check"></i> Save changes</button>-->
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div> 
 
<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModalE" tabindex="-1" role="dialog">
<div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm3" action="php_action/confirmBooking.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Confirmation of the Request</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="confirm-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-12">
                        <div>
                            <div><strong>Do you want to confirm this request? </strong></div>
						
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	      <div class="modal-footer editCategoriesFooterE"> 
	        
            <!-- <button type="button" id="Print" class="btn btn-primary">Print</button> --> 
			<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
			<button type="submit" class="btn btn-success" id="editCategoriesBtn3" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Yes</button>
	        <!--<button type="submit" id="editCategoriesBtn"class="btn btn-success"> <i class="fa fa-check"></i> Save changes</button>-->
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div> 

    <!-- Right Panel -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModalC">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Confirmation of the Request</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to confirm the request ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtnC" data-loading-text="Loading..."> <i class="fa fa-check"></i>  Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>
    
	<script src="custom/js/bookingPartner.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
	  
document.getElementById("Print").onclick = function () {
printElement(document.getElementById("printThis"));
};

function printElement(elem) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    $printSection.innerHTML = "";
    $printSection.appendChild(domClone);
    window.print();
}
  </script>


</body>
</html>
