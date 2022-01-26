<?php
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
                                <h1>Drivers Management</h1>
								
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Drivers</a></li>
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
								
								 <strong class="card-title"><i class="fa fa-edit"></i> All Drivers</strong>
								 <!--<button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal" title="Add a new Driver"> <i class="fa fa-plus text-primary"></i> Add New Driver</button>-->
			                </div>
							<div class="remove-messages approve-messages"></div>
                            <div class="card-body">  
                                </table>
								 <table id="manageDriversTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
                                                                                       <th>Firstname</th> 
											<th>Lastname</th>
											<th>Mobile_phone</th>
											<th>Role</th>
											<th>Email</th>  
											<th>City</th> 
                                                                                         <th>Zipcode</th> 
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

    	<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createDrivers.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add New Driver</b></h5>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div>  
			
              <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="fname" class=" form-control-label">First name</label><input type="text" name = "fname" id="fname" class="form-control"></div>
                                <div class="form-group"><label for="lname" class=" form-control-label">Last name</label><input type="text" name = "lname" id="lname" class="form-control"></div>
                                <div class="form-group"><label for="mobile" class=" form-control-label">Mobile number</label><input type="text" name="phone1" id="phone1"class="form-control"></div>
                                <div class="form-group"><label for="office" class=" form-control-label">Office number</label><input type="text" name="phone2" id="phone2"class="form-control"></div>
								<div class="row form-group"> 
                                <div class="col-12">
                                  <div class="form-group"><label for="email" class=" form-control-label">Email</label><input type="text" name="email" id="email" class="form-control"></div>
                                </div>
								<div class="col-12">
                                  <div class="form-group"><label for="defaultpass" class=" form-control-label">Default Password</label><input type="text" name="password" id="password" class="form-control"></div>
                                </div>
								<div class="col-12">
                                  <div class="form-group"><label for="picture" class=" form-control-label">Personal Picture</label><input type="file" name="picture" id="picture" class="form-control"></div>
                                </div>
								
                                </div>
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
                                 <div class="form-group"><label for="Street" class=" form-control-label">Street</label><input type="text" name="street"id="street"class="form-control"></div>
                                <div class="form-group"><label for="state" class=" form-control-label">State</label><input type="text" name="state"id="state" class="form-control"></div>
                                <div class="row form-group">
                                    <div class="col-12">
                                        <div class="form-group"><label for="city" class=" form-control-label">City</label><input type="text" name="city"id="city"class="form-control"></div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group"><label for="zip-code" class=" form-control-label">Zip Code</label><input type="text" name="zip"id="zip" class="form-control"></div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="regDate" class=" form-control-label">Registration Date</label>
								<input type="date" name="regDate"id="regDate"  class="form-control"></div>
								
								<div class="form-group">
                                  <label for="proof" class="form-control-label"> Document proof</label><input type="file" name="proof" id="proof" class="form-control"></div>
                                
								<div class="form-group">
									<label for="driverStatus" class="form-control-label">Driver Status </label> 
										 
										  <select class="form-control" id="driverStatus" name="driverStatus">
											<option value="">~~SELECT~~</option>
											<option value="1">Dismissed</option>
											<option value="2">Approved</option>
										  </select>
										 
								</div> <!-- /form-group-->	
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
<!-- /add categories -->
 <!-- edit categories brand -->
<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm1" action="php_action/editDriver.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Driver Details</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block"> 
					
                                <div class="form-group"><label for="company" class=" form-control-label">First name</label><input type="text" name = "editfname" id="editfname" class="form-control" readonly></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Last name</label><input type="text" name = "editlname" id="editlname" class="form-control" readonly></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Mobile Phone</label><input type="text" name="editphone1" id="editphone1"class="form-control" readonly></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Office Phone</label><input type="text" name="editphone2" id="editphone2"class="form-control" readonly></div>
								<div class="row form-group"> 
                                    <div class="col-8">
                                        <div class="form-group"><label for="postal-code" class=" form-control-label">Email</label><input type="text" name="editemail" id="editemail" class="form-control" readonly></div>
                                    </div>
                                </div>
								<!--<div class="form-group"><label for="company" class=" form-control-label">Doc proof</label><input type="text" name = "editproof" id="editproof" class="form-control"></div>-->
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
                                 <div class="form-group"><label for="Street" class=" form-control-label">Street</label><input type="text" name="editstreet"id="editstreet"class="form-control" readonly></div>
                                <div class="form-group"><label for="state" class=" form-control-label">State</label><input type="text" name="editstreet"id="editstate" class="form-control" readonly></div>
                                <div class="row form-group">
                                    <div class="col-8">
                                        <div class="form-group"><label for="city" class=" form-control-label">City</label><input type="text" name="editcity"id="editcity"class="form-control" readonly></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group"><label for="zip-code" class=" form-control-label">Zip Code</label><input type="text" name="editzip"id="editzip" class="form-control" readonly></div>
                                    </div>
                                </div> 
								<div class="form-group">
									<label for="editStatus" class="form-control-label">Driver Status </label> 
										 
										  <select class="form-control" id="editStatus" name="editStatus" readonly>
											<option value="">~~SELECT~~</option>
											<option value="1">Dismissed</option>
											<option value="2">Approved</option>
										  </select>
										 
								</div> <!-- /form-group-->
                            </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	     	      <div class="modal-footer editCategoriesFooter1">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <button type="button" id="Print" class="btn btn-success"> <i class="fa fa-check"></i> Print report</button>
	        <!--<button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>-->
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

<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/approveDriver.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Approve / Dismiss Driver</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messagess"></div>
              <div class="row"> 

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"> 
									   <label for="editName1" class="col-sm-4 control-label">Driver Name </label> 
										<div class="col-sm-8">
										  <input type="text" class="form-control" id="editName1" placeholder="Driver Name" name="editName1" autocomplete="off"  readonly>
										</div>
								</div> <!-- /form-group-->	
								<div class="form-group">
									<label for="editStatus" class="col-sm-4  control-label">Driver Status </label> 
										 <div class="col-sm-8">
										  <select class="form-control" id="editStatus1" name="editStatus1">
											<option value="">~~SELECT~~</option>
											<option value="3">Dismissed</option>
											<option value="2">Approved</option>
										  </select>
										</div> 
								</div> <!-- /form-group-->
                            </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	     	      <div class="modal-footer editCategoriesFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
	        <!--<button type="button" id="Print" class="btn btn-success"> <i class="fa fa-check"></i> Print report</button>-->
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

<!-- categories brand -->
<!-- categories brand -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Approve the driver</h4>
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

<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Dismiss the driver</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to block this ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter1">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn1" data-loading-text="Loading..."> <i class="fa fa-check"></i> Save changes</button>
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
    
	<script src="custom/js/drivers.js"></script>

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
