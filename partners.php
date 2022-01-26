<?php
require_once 'php_action/db_connect.php';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
//echo "ID : ".$_SESSION['id'];
//die("Role : ".$_SESSION['user_type']);
?>
<?php 
    // Include the database config file 
    include_once 'dbConfig.php'; 
     
    // Fetch all the country data 
    $query = "SELECT * FROM countrytbl ORDER BY countryname ASC"; 
    $result1 = $db->query($query); 
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
                                <h1>Users Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Partners</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> All Partrners</strong>
								 <button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal" title="Add a new Partner"> <i class="fa fa-plus text-primary"></i> Add Partner</button>
			                </div>
							<!--<div class="dismiss-messages">
							<div class="remove-messages"> -->
                            <div class="card-body">  
                                </table>
								 <table id="managePartnersTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
                                            <th>Fname</th> 
											<th>Lname</th>
											<th>Mobile_number</th>
											<th>Office_phone</th>
											<th>Email</th>  
											<th>State</th> 
                                                                                        <th>City</th> 
                                                                                        <th>Date</th>
											<th>Garage</th>
											<th>Role</th>
											<th>Status</th>
							                <th style="width:15%;">Options</th>
                                        </tr>
                                    </thead> 
                                </table>
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
    <!-- Right Panel --> 
<div class="modal fade" id="addCategoriesModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createPartner.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add New Garage-Partner</b></h5>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div> 
			<div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
							 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">First name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "fname" id="fname" class="form-control">
									   </div>
								 </div> 
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Last name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "lname" id="lname" class="form-control">
									   </div>
								 </div>
                                 
                                 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Mobile number:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone1" id="phone1"class="form-control">
									   </div>
								 </div>
                                 
                                 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Office phone number:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone2" id="phone2"class="form-control">
									   </div>
								 </div>	
                                 
                                 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Email:</label>
									  <div class="col-sm-8">
								         <input type="text" name="email" id="email" class="form-control">
									   </div>
								 </div>
								 
								 <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Password:</label>
									  <div class="col-sm-8">
								         <input type="password" name="password" id="password" class="form-control" autocomplete="off">
									   </div>
								 </div>
                                 
                                  <div class="form-group">
								    <label for="street" class="col-sm-4 control-label">Function:</label>
									  <div class="col-sm-8">
								         <select name="garage_role" id="garage_role" class="form-control">
											<option value="">Select the role</option> 
											<option value="1">Garage admin</option> 
											<option value="2">Garage Technician</option> 
										  </select>
									   </div>
								 </div>		 
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block"> 
							   
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Picture:</label>
									  <div class="col-sm-8">
								         <input type="file" name="picture" id="picture" class="form-control">
									   </div>
							 </div>
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Driving licence:</label>
									  <div class="col-sm-8">
								         <input type="file" name="proof" id="proof" class="form-control">
									   </div>
							 </div>
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Garage:</label>
									  <div class="col-sm-8">
								         <select type="text" class="form-control" id="garageName"name="garageName" >
											<option value="">~~SELECT~~</option>
											<?php 
											 $sql = "SELECT * FROM garagetbl WHERE active = 1";
													$result = $connect->query($sql);

													while($row = $result->fetch_array()) {
														echo "<option value='".$row[0]."'>".$row[1]."</option>";
													} // while
													
											?>
								         </select>
									   </div>
							 </div> 
							 <div class="form-group">
								<label for="state" class="col-sm-4 control-label">Country: </label> 
								   <div class="col-sm-8">
									<!-- Country dropdown -->
									<select id="country" name="country"  class="form-control">
										<option value="">Select Country</option>
										<?php 
											if($result1->num_rows > 0){ 
												while($row = $result1->fetch_assoc()){  
													echo '<option value="'.$row['id'].'">'.$row['countryname'].'</option>'; 
												} 
											}else{ 
												echo '<option value="">Country not available</option>'; 
											} 
										?>
									</select>
								 </div>
								</div> <!-- /form-group-->
								<div class="form-group">
									<label for="state" class="col-sm-4 control-label">State: </label> 
										<div class="col-sm-8">
										  <!--<input type="text" class="form-control" id="state" placeholder="State" name="state" autocomplete="off">-->
										<select id="state" name="state" class="form-control">
											<option value="">Select state</option>
										</select> 
										
								  </div>
								</div> <!-- /form-group-->	
								<div class="form-group">
									<label for="city" class="col-sm-4 control-label">City: </label> 
										<div class="col-sm-8">
										  <!--<input type="text" class="form-control" id="city" placeholder="City" name="city" autocomplete="off">-->
										  <select id="city" name="city"  class="form-control">
											<option value="">Select city</option>
										</select>
										</div>
								</div> <!-- /form-group-->
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Street:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="street"class="form-control"/>
									   </div>
							 </div>
                             <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Zipcode:</label>
									  <div class="col-sm-8">
								         <input type="text" name="zip"id="zip" class="form-control"/>
									   </div>
							 </div>
                             <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Reg. Date:</label>
									  <div class="col-sm-8">
								         <input type="date" name="regDate"id="regDate"  class="form-control"/>
									   </div>
							 </div>							  
                            </div>
                        </div>
                    </div>   
            </div>
                    	        
	      </div> <!-- /modal-body -->
	      
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
	        
	        <button type="submit" class="btn btn-primary" id="createCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-check"></i> Save Changes</button>
	      </div> <!-- /modal-footer -->	      
     	</form> <!-- /.form -->	     
    </div> <!-- /modal-content -->    
  </div> <!-- /modal-dailog -->
</div> 
<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/editPartner.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Partner Details</h4>
	      </div>
	      <div class="modal-body">
           
	      	<div id="edit-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
							<div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Garage:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="editName" size="100" class="form-control"readonly>
									   </div>
							 </div> 
                            
                            <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">First name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "fname" id="editfname" class="form-control"readonly>
									   </div>
							 </div>
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Last name:</label>
									  <div class="col-sm-8">
								         <input type="text" name = "lname" id="editlname" class="form-control"readonly>
									   </div>
							 </div>
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Mobile:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone1" id="editphone1"class="form-control"readonly>
									   </div>
							 </div>
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Office:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone2" id="editphone2"class="form-control"readonly>
									   </div>
							 </div>
							 
							 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Email:</label>
									  <div class="col-sm-8">
								         <input type="text" name="email" id="editemail" class="form-control" readonly>
									   </div>
							 </div> 
                           </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
							     <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Street:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="editstreet"class="form-control"readonly>
									   </div>
							     </div>
								 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">State:</label>
									  <div class="col-sm-8">
								         <input type="text" name="state"id="editstate" class="form-control"readonly>
									   </div>
							     </div>
								 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">City:</label>
									  <div class="col-sm-8">
								         <input type="text" name="city"id="editcity"class="form-control"readonly>
									   </div>
							     </div> 
								 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Zip:</label>
									  <div class="col-sm-8">
								         <input type="text" name="zip"id="editzip" class="form-control"readonly>
									   </div>
							     </div> 
								 <div class="form-group">
								    <label for="picture" class="col-sm-4 control-label">Reg.Date:</label>
									  <div class="col-sm-8">
								         <input type="date" name="regDate"id="editregDate"  class="form-control"readonly>
									   </div>
							     </div> 
                                 
                                <div class="row form-group"> 
                                </div> 
                            </div>
                        </div>
                    </div>  
			</form>
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

<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm1" action="php_action/approvePartner.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Approve / Dismiss Partner</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messagesss"></div>
              <div class="row"> 

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"> 
									   <label for="editName1" class="col-sm-4 control-label">Partner Names </label> 
										<div class="col-sm-8">
										  <input type="text" class="form-control" id="editName1" placeholder="Driver Name" name="editName1" autocomplete="off"  readonly>
										</div>
								</div> <!-- /form-group-->	
                                <div class="form-group">
								  <label for="regDate" class="col-sm-4 control-label">Registration Date</label>
								   <div class="col-sm-8">
								     <input type="date" name="editregDate1"id="editregDate1"  class="form-control" readonly>
									 </div>
								</div>
								<div class="form-group">
									<label for="editStatus" class="col-sm-4  control-label">Partner Status </label> 
										 <div class="col-sm-8">
										  <select class="form-control" id="editStatus1" name="editStatus1">
											<option value="">~~SELECT~~</option>
											<option value="1">Approve</option>
											<option value="0">Dismiss</option>
										  </select>
										</div> 
								</div> <!-- /form-group-->
                            </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	     	      <div class="modal-footer editCategoriesFooter1">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <!--<button type="button" id="Print" class="btn btn-success"> <i class="fa fa-check"></i> Print report</button>-->
	        <button type="submit" class="btn btn-success" id="editCategoriesBtn1" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>

<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Approve the Partner</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to approve this ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="fa fa-check"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Dismiss -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModalP">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Dismiss the Partner</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to dismiss this ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter1">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtnP" data-loading-text="Loading..."> <i class="fa fa-check"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- Right Panel -->

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
    
	<script src="custom/js/partners.js"></script>

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

<script>
$(document).ready(function(){
    $('#country').on('change', function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>
</body>
</html>
