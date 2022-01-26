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
                                <h1>Driver rates Management</h1>
								
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Drivers</a></li>
                                    <li class="active">Rates</li>
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
								
								 <strong class="card-title"><i class="fa fa-edit"></i> All Drivers and rates</strong>
								 <!--<button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal" title="Add a new Driver"> <i class="fa fa-plus text-primary"></i> Add New Driver</button>-->
			                </div>
							<div class="remove-messages approve-messages"></div>
							
                            <div class="card-body">  
                                </table>
								 <table id="manageDriversTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
                                            <th>Fname</th> 
											<th>Lname</th>
											<th>Mobile_phone</th> 
											<th>Email</th>   
                                            <th>Rates</th> 
											<th>Status</th> 
							                <th style="width:15%;">Options</th>
                                        </tr>
                                    </thead> 
									<?php
											$sql ="SELECT customertbl.id, `customertbl`.fname, customertbl.lname, customertbl.phone, customertbl.email,
											customertbl.state, `rating`.`request_id`, AVG(rating.rate) as rating, rating.review
											FROM `customertbl`
												, `pick`
												, `booking`
												, `rating`
												
												WHERE customertbl.user_type ='Driver' AND pick.request_id = booking.id AND rating.request_id = booking.id"; // 
											 
															
															
											 $result = $connect->query($sql);

											$output = array('data' => array());
											//print "HERE YOU GO";
											if($result->num_rows > 0) { 

											 // $row = $result->fetch_array();
											 $activeCategories = ""; 


											}// if num_rows
							
							                 ?>
									<tbody>
									    <?php
										
											 while($row = $result->fetch_array()) {
												 ?>
												<tr> 
                                                    <td><?php echo $_SESSION['fname'] = $row['fname'];?></td>
													<td><?php echo $_SESSION['lname'] = $row['lname'];?></td> 
													<td><?php echo $_SESSION['phone'] = $row['phone'];?></td>
													<td><?php echo $_SESSION['email'] = $row['email'];?></td> 
													<td><?php 
													if($row['rating'] > 2.5) {
													         // activate member
													        $activeCategories = "<label class='label label-success'>Well done</label>";
														} else {
															// deactivate member
															$activeCategories = "<label class='label label-danger'>Need improvement</label>";
														}
													echo $activeCategories;?>
													
													</td> 
													<td><?php echo $row[6];?></td>
                                                    <td>
													   <div class="btn-group">
														  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															Action <span class="caret"></span>
														  </button>
														   <ul class="dropdown-menu">
															<li><a type="button" href="driversrates?id=<?php echo $row['request_id'];?>" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li>
															 		
														  </ul> 
														</div>
													</td> 													
												 
                                        </tr>
										<?php
											 }
										?>
                                    </tbody> 
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

<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm1"  method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Driver rating history details</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"><strong>Driver Information</strong></div>
                            <div class="card-body card-block"> 
					
                                <div class="form-group"><label for="company" class=" form-control-label">First name</label><input type="text" name = "editfname" value="<?php echo $_SESSION['fname'];?>" class="form-control" readonly></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Last name</label><input type="text" name = "editlname" value="<?php echo $_SESSION['lname'];?>" class="form-control" readonly></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Phone</label><input type="text" name = "editlname" value="<?php echo $_SESSION['phone'];?>" class="form-control" readonly></div>  
								<div class="form-group"><label for="vat" class=" form-control-label">Email</label><input type="text" name = "editlname" value="<?php echo $_SESSION['email'];?>" class="form-control" readonly></div>
								 
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header"><strong>Rating History</strong></div>
							<hr>
                            <div class="card-body card-block">
							    <table class="table table-striped table-bordered">
								   <thead>
								       <tr> 
                                            <th class="serial">ID</th> 
											<th>Requested_Garage</th>
											<th>Rate_(/5)</th> 
											<th>Comments</th>   
                                            <th>Date</th>   
                                        </tr>
								   </thead>
								   	<?php
									        $driverEmail = $_SESSION['email'];
											$sql ="SELECT rating.request_id, rating.rate, rating.date as dtd, rating.review, pick.*, booking.garage FROM `rating`, pick, booking WHERE rating.request_id = pick.request_id AND pick.driver_email ='$driverEmail' GROUP BY pick.request_id ORDER BY rating.date DESC"; // 
											 			
											$result = $connect->query($sql); 
											$output = array('data' => array());
											//print "HERE YOU GO";
											if($result->num_rows > 0) {  
											 // $row = $result->fetch_array();
											 $activeCategories = "";  
											}// if num_rows
							
							                 ?>
									<tbody>
									    <?php
										     $i =1;
											 while($row = $result->fetch_array()) {
												 ?>
												<tr> 
                                                    <td><?php echo $i;?></td>
													<td><?php echo $row['garage'];?></td> 
													<td><?php echo $row['rate'];?></td>
													<td><?php echo $row['review'];?></td> 
													<td><?php echo $d = date('m/d/Y h:i A ', strtotime($row['dtd']));?></td>    												
												 
                                                </tr>
												<?php
												     $i++;
													 }
												?>
                                    </tbody> 
								</table>
                                <!--<div class="form-group"><label for="Street" class=" form-control-label">Street</label><input type="text" name="editstreet"id="editstreet"class="form-control" readonly></div>
                                <div class="form-group"><label for="state" class=" form-control-label">State</label><input type="text" name="editstreet"id="editstate" class="form-control" readonly></div>
                                -->
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
    
	<script src="custom/js/driversrates.js"></script>

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
