<?php require_once 'php_action/db_connect.php'; ?>
<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
// dieecho "ID : ".$_SESSION['id'];
$garageID = $_SESSION['garageID'];
//$sql1 = "SELECT garagetbl.* FROM garagetbl WHERE  garageID = {$garageID}";
$sql1 ="SELECT `garageID`, `Name`, `Email`, `Websitelink`, `phone`, `garage_thumbnail`, `state`, `city`, `street`, `zip`, `latitude`, `longitude`, `working_hourID`, `working_dayID`, `status`, `active` FROM `garagetbl` WHERE garageID = {$garageID}";
//die($sql1);
$query1 = $connect->query($sql1);
$result1 = $query1->fetch_assoc();
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
	  <script>    
      function myFunction() {
           location.assign("http://localhost/skyline-v1/admin/garage");
      }
	  </script> 
	  <style>
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
        <!-- /#header -->
        <!-- Content --> 
        
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Garage Information</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Garage</a></li>
                                    <li><a href="myprofile">information</a></li>
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
								<div class="col-lg-6">
									<div class="card">
										<div class="card-header"><strong><i class="fa fa-edit"></i> General information</strong></div>
												<div class="content">
														<div class="animated fadeIn">
											           
														 <!--<form action="php_action/updateGarage.php" method="post" class="form-horizontal" id="changeUsernameForm" enctype='multipart/form-data'>
														  <form action="php_action/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm" enctype="multipart/form-data">-->
														  <form class="form-horizontal row-fluid" name="insertproduct" method="post" enctype="multipart/form-data">
														  <div class="changeUsenrameMessages"></div>
<?php
if(isset($_POST['submit']))
{ 
	$fname = $_POST['fname'];  
	$phone1 = $_POST['phone1']; 
	$email = $_POST['email'];
	$weblink = $_POST['weblink'];
	
	$state = $_POST['state'];
	$city = $_POST['city']; 
	$street = $_POST['street'];
	$zip = $_POST['zip'];

    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];	
	
	$UserId = $_POST['user_id'];
	 
	$image=$_FILES["productimage3"]["name"]; 
	
	$dir="images/";
if(!is_dir($dir)){
		mkdir("images/");
	} 
	move_uploaded_file($_FILES["productimage3"]["tmp_name"],"images/".$_FILES["productimage3"]["name"]);
   $sql1 = "UPDATE `garagetbl` SET `Name`='$fname',`Email`='$email',`Websitelink`='$weblink',`phone`='$phone1',`garage_thumbnail`='$image',`state`='$state',`city`='$city',`street`='$street',`zip`='$zip',`latitude`='$latitude',`longitude`='$longitude',`status`=1,`active`=1 WHERE `garageID`='$UserId'";
   $sql=mysqli_query($connect,$sql1);

   if($sql){
  $_SESSION['msg']="Garage information is well updated!! ";
   echo '<meta http-equiv="refresh" content="2"> '; 
}else{
  $_SESSION['msg']="Something is wrong !! ".$sql1.$connect->error;
  echo '<meta http-equiv="refresh" content="2"> ';   
}

}


?>
														  	<?php if(isset($_POST['submit'])) {?>
																<div class="alert alert-success">
																	<button type="button" class="close" data-dismiss="alert">×</button>
																		<strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
																</div>
															<?php } ?>
															<div class="row">
																<div class="col-lg-6">
																	<div class="card">
																	
																		<div class="card-header"><strong>Garage info</strong></div>
																		<div class="card-body card-block">
																		   <div class="form-group text-right">
																				<label for="logo" class=" form-control-label"> 
																				<p>
																				<img src="<?php echo "images/".$result1['garage_thumbnail']; ?>" alt="Logo" class="img-thumbnail"></p>
																				</label>
																				 
																			</div>
																			<div class="form-group text-right">
																				<input type="file" name="productimage3"  value="<?php echo "images/".$result1['garage_thumbnail']; ?>" class="form-control"/>
																				 
																				
																			</div> 
																			<div class="form-group"><label for="garage" class=" form-control-label">Garage name</label><input type="text" name = "fname" placeholder="Enter garage name" class="form-control" value="<?php echo $result1['Name'];?>" ></div>
																			 <div class="form-group"><label for="street" class=" form-control-label">Phone number</label><input type="text" name="phone1" placeholder="Enter phone" class="form-control" value="<?php echo $result1['phone'];?>"></div>
																			 <div class="form-group"><label for="email" class=" form-control-label">Email</label><input type="text" name="email" placeholder="Enter email" class="form-control" value="<?php echo $result1['Email'];?>"></div>
																			 <div class="form-group"><label for="weblink" class=" form-control-label">Website</label><input type="text" name="weblink" placeholder="Enter weblink" class="form-control" value="<?php echo $result1['Websitelink']; ?>"></div>
																			 
																	
																		</div>
																	</div>
																</div> 

																<div class="col-lg-6">
																	<div class="card">
																		<div class="card-header"><strong>Addresses</strong></div>
																		<div class="card-body card-block">
																			<div class="form-group"><label for="state" class=" form-control-label">State</label><input type="text" name="state" placeholder="Enter street name" class="form-control" value="<?php echo $result1['state'] ?>"></div>
																		    <div class="row form-group">
																			<div class="col-8">
																					<div class="form-group"><label for="city" class=" form-control-label">City</label><input type="text" name="city"placeholder="Enter your city" class="form-control" value="<?php echo $result1['city'] ?>"></div>
																				</div>
																				<div class="col-12">
																					<div class="form-group"><label for="street" class=" form-control-label">Street</label><input type="text" name="street" placeholder="Enter your city" class="form-control" value="<?php echo $result1['street'] ?>"></div>
																				</div>  
																				<div class="col-12">
																					<div class="form-group"><label for="zip-code" class=" form-control-label">Zip Code</label><input type="text" name="zip" placeholder="Postal Code" class="form-control" value="<?php echo $result1['zip'] ?>"></div>
																				</div>
																				<div class="col-12">
																					<div class="form-group">   <input type="text" name="latitude" placeholder="latitude" class="form-control" value="<?php echo $result1['latitude'] ?>"></div>
																				</div>
																				<div class="col-12">
																					<div class="form-group">   <input type="text" name="longitude"placeholder="longitude" class="form-control" value="<?php echo $result1['longitude'] ?>"></div>
																				</div>
																			</div>
																			 
																			</div> 
																		</div>
																</div>
															
															    <div class="form-group">
					                                                <div class="col-sm-offset-2 col-sm-10">
																		<input type="hidden" name="user_id" id="user_id" value="<?php echo $result1['garageID'] ?>" /> 
																	  <!--<button type="submit" class="btn btn-lg btn-info btn-block"> <i class="fa fa-info-circle"></i>&nbsp; Update Garage info</button>-->
																	  <button type="submit" class="btn btn-success" data-loading-text="Loading..." type="submit" name="submit" onclick="myFunction()"> <i class="glyphicon glyphicon-ok-sign"></i>&nbsp; Update Garage info</button>
																	</div>
					                                             </div>  
																	 
														 
														</form> 
								       </div>
                                    </div>
                                   </div>
                                </div> 									
								<div class="card">  
											<div class="card-header">
											   <strong><i class="fa fa-edit"></i> Garage Car Makes and Models</strong>
											   <button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal" title="Add a new Car make and model"> <i class="fa fa-plus text-primary"></i> Add Car Makes and Models</button>
											</div> 
											<div class="card-body card-block">
												
											   <table class="table table-hover" id="manageCarMakesTable">
												  <thead>
													 <tr><th class="serial">#</th><td>CarMake</td><td>CarModel</td><td>Status</td><td>Action</td></tr> 
													  
												  </thead>
												</table>
											</div>  
								</div> 
							</div> 

                    <div class="col-lg-6">
							<div class="card">  
								<div class="card-header">
								   <strong><i class="fa fa-edit"></i> Working Days/Hours</strong>
								   <button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtnDS" data-target="#addCategoriesModal1" title="Add a new working Day"> <i class="fa fa-plus text-primary"></i> Add Working Day</button>
								</div>
					           <form action="php_action/updateDays" method="">
								<div class="card-body card-block">
								
								   <table class="table table-hover" id ="manageCategoriesTable">
								      <thead>
									    <tr>
									     <!--<th scope="col">#</th>-->
									     <th scope="col">Day</th>
										 <th scope="col">HourFrom</th>
										 <th scope="col">HourTo</th>
										 <th scope="col">Status</th>
										 <th scope="col">Action</th>
										</tr>
									  </thead>
									</table>
								</div> 
						     </form>
							</div>
						    <div class="card">  
								<div class="card-header">
								   <strong><i class="fa fa-edit"></i> Day Off </strong>
								   <button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtnD" data-target="#addCategoriesModal2" title="Add a new Day Off"> <i class="fa fa-plus text-primary"></i> Add DayOff</button>
								</div> 
								<div class="card-body card-block"> 
								   <table class="table table-hover" id="manageDayOffTable">
									  <thead>
									     <tr><td>DayOff range</td><td>Satatus</td><td>Action</td></tr> 
										  
									  </thead>
									</table>
								</div>  
							</div> 
                    </div>  

            </div>


        </div><!-- .animated -->
    </div><!-- .content -->         
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
          <?php
			  require("include/footer.php");
			?>
        <!-- /.site-footer -->
    </div>    <!-- CAR MAKES and MODELS -->
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createcarMake.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add New Car Make and Model</b></h5>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div> 
			
            <div class="form-group">
	        	<label for="categoriesName" class="col-sm-4 control-label">Car Make Name: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="categoriesName" placeholder="Car Make Name" name="categoriesName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="carModelName" class="col-sm-4 control-label">Car Model Name: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="carModelName" placeholder="Car Model Name" name="carModelName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 			
	        <div class="form-group">
	        	<label for="categoriesStatus" class="col-sm-4 control-label">Car Status </label> 
				    <div class="col-sm-8">
				      <select class="form-control" id="categoriesStatus" name="categoriesStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Available</option>
				      	<option value="0">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->	         	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-check"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- /add categories -->

<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/editCarMake.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Car Make and Model</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-categories-result">
		      	<div class="form-group">
		        	<label for="editCategoriesName" class="col-sm-4 control-label">Car Make Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editCategoriesName" placeholder="Car Make Name" name="editCategoriesName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->
                 	<div class="form-group">
		        	<label for="editTin" class="col-sm-4 control-label">Car Model Name: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editTin" placeholder="Car Model Name" name="editTin" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->				
		        <div class="form-group">
		        	<label for="editCategoriesStatus" class="col-sm-4 control-label">Car Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editCategoriesStatus" name="editCategoriesStatus">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Available</option>
					      	<option value="0">Not Available</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->	 
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCategoriesFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Remove Car Make</h4>
      </div> 
	  <div class="remove-messages"></div>
	  
      <div class="modal-body">
        <p>Do you really want to disactivate ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->








    <!-- DAY and HOURS -->
<div class="modal fade" id="addCategoriesModal1" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCategoriesFormDS" action="php_action/createWorkingHours.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add Day and Hours</b></h5>
	      </div>
	      <div class="modal-body">

	      <div id="add-categories-messagesSS"></div>
			
            <div class="form-group">
	        	<label for="dayName" class="col-sm-4 control-label">Day: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="dayName" placeholder="Day Name" name="dayName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="dayFrom" class="col-sm-4 control-label">From: </label> 
				    <div class="col-sm-8">
				      <input type="time" class="form-control" id="dayFrom" placeholder="day From" name="dayFrom" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 	
            <div class="form-group">
	        	<label for="dayTo" class="col-sm-4 control-label">To: </label> 
				    <div class="col-sm-8">
				      <input type="time" class="form-control" id="dayTo" placeholder="Category Name" name="dayTo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="categoriesStatus1" class="col-sm-4 control-label">Day Status </label> 
				    <div class="col-sm-8">
				      <select class="form-control" id="categoriesStatus1" name="categoriesStatus1">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Available</option>
				      	<option value="0">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->			
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCategoriesBtn1" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-check"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 

<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesFormDS" action="php_action/editHourkingHours.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Working Day and Hours</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messagesDS"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-categories-resultDS">
		      	<div class="form-group">
		        	<label for="editDayName" class="col-sm-4 control-label">Day: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <input type="text" class="form-control" id="editdayName" placeholder="Day Name" name="editdayName" autocomplete="off">
					    </div>
		        </div> <!-- /form-group-->
 			     <div class="form-group">
	        	<label for="editdayFrom" class="col-sm-4 control-label">From: </label>
				    <div class="col-sm-8">
				      <input type="time" class="form-control" id="editdayFrom" placeholder="day From" name="editdayFrom" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 	
            <div class="form-group">
	        	<label for="editdayTo" class="col-sm-4 control-label">To: </label>
				    <div class="col-sm-8">
				      <input type="time" class="form-control" id="editdayTo" placeholder="Category Name" name="editdayTo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
		        <div class="form-group">
		        	<label for="editDayStatus" class="col-sm-4 control-label">Day Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editDayStatus" name="editDayStatus">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Available</option>
					      	<option value="0">Not Available</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->	 
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCategoriesFooterDS">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtnDS" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Disactivate Day and hours</h4>
      </div>
	  <div class="remove-messagesDS"></div>
      <div class="modal-body">
        <p>Do you really want to disactivate ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtnDS" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->





    <!-- DAY and HOURS -->
<div class="modal fade" id="addCategoriesModal2" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCategoriesFormD" action="php_action/createDayOff.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add DayOff</b></h5>
	      </div>
	      <div class="modal-body">

	      <div id="add-categories-messagesD"></div> 
		  
            <div class="form-group">
	        	<label for="dayFrom" class="col-sm-4 control-label">DayOff From: </label> 
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="dayOffFrom" placeholder="dayOff From" name="dayOffFrom" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 	
            <div class="form-group">
	        	<label for="dayOffTo" class="col-sm-4 control-label">DayOff To: </label> 
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="dayOffTo" placeholder="dayOff To" name="dayOffTo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="categoriesStatusD" class="col-sm-4 control-label">DayOff Status </label> 
				    <div class="col-sm-8">
				      <select class="form-control" id="categoriesStatusD" name="categoriesStatusD">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Confirmed</option>
				      	<option value="0">Not confirmed</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->			
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCategoriesBtnD" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-check"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 

<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal2" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesFormD" action="php_action/editDayOff.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit DayOff</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messagesD"></div>

	      	<div class="modal-loading div-hide" style="width:50px; margin:auto;padding-top:50px; padding-bottom:50px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-categories-resultD"> 
 			     <div class="form-group">
	        	<label for="editdayOffFrom" class="col-sm-4 control-label">From: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="editdayOffFrom" placeholder="day From" name="editdayOffFrom" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 	
            <div class="form-group">
	        	<label for="editdayOffTo" class="col-sm-4 control-label">To: </label>
				    <div class="col-sm-8">
				      <input type="date" class="form-control" id="editdayOffTo" placeholder="Category Name" name="editdayOffTo" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
		        <div class="form-group">
		        	<label for="editDayOffStatus" class="col-sm-4 control-label">DayOff Status: </label>
		        	<label class="col-sm-1 control-label">: </label>
					    <div class="col-sm-7">
					      <select class="form-control" id="editDayOffStatus" name="editDayOffStatus">
					      	<option value="">~~SELECT~~</option>
					      	<option value="1">Confirmed</option>
					      	<option value="0">Not confirmed</option>
					      </select>
					    </div>
		        </div> <!-- /form-group-->	 
		      </div>         	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer editCategoriesFooterD">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtnD" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
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

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal2">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Disactivate DayOff</h4>
      </div>
	  <div class="remove-messagesD"></div>
      <div class="modal-body">
        <p>Do you really want to disactivate ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooterD">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtnD" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /categories brand -->

 
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
	
	<!--<script src="custom/js/updateGarage.js"></script>-->
	<script src="custom/js/workingHours.js"></script>
	<script src="custom/js/dayOff.js"></script>
 	<script src="custom/js/carMakes.js"></script>
 
</body>
</html>
