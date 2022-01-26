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
.css-serial {
 counter-reset: serial-number;  
}
.css-serial td:first-child:before {
 counter-increment: serial-number; 
 content: counter(serial-number);  
}
 div.dataTables_wrapper {
        width: 1000px;
        margin: 0 auto;
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
					 include("leftmenues.php");
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
                                <h1>Completed booking Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Completed Booking</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> All Requests ready for Pro forma</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">
													 
								 <table id="manageCustomersTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
                                                    <!--<th class="avatar">Avatar</th>--> 
                                                   
													<th>Fname</th>
                                                    <th>Lname</th> 													
													<th>Email</th>
                                                    <th>Service</th> 
													<th>Make</th>
													<th>Model</th>
													<th>Platenumber</th>
													<th>Description</th>   
													<th>Mechanica</th>
													<th>AssignedOn</th>  
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
								    <label for="street" class="col-sm-4 control-label">OfficePhone:</label>
									  <div class="col-sm-8">
								         <input type="text" name="phone2" id="editphone2"class="form-control"readonly>
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
								         <input type="text" name="editzipcode" id="editzipcode"class="form-control"readonly>
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
								    <label for="street" class="col-sm-4 control-label">Driver Email:</label>
									  <div class="col-sm-8">
								         <input type="text" name="street"id="editdriverEmail"class="form-control"readonly>
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

<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Confirm the work done</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to confirm the work done?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="fa fa-check"></i> Confirm changes</button>
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
    
	<script src="custom/js/bookingForInvoices.js"></script>

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