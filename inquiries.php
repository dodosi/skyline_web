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
					$role = $_SESSION['user_type']; 
					if($role == 0){
					$_SESSION['userid'] = 1;
                    echo '
					<li>
                        <a href="dashboard"><i class="menu-icon fa fa-tachometer"></i>Dashboard </a>
                    </li> 
                    <li class="menu-title">Users Management</li><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Customer</a>
                        <ul class="sub-menu children dropdown-menu">                            
						    <li><i class="fa fa-users"></i><a href="customers">View customers</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Partner-Garages</a>
                        <ul class="sub-menu children dropdown-menu"> 
                            <li><i class="fa fa-cogs"></i><a href="allgarages">View Garages</a></li>
							<li><i class="fa fa-user-o"></i><a href="partners">View Partners</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-circle-o"></i>Driver</a>
                         <ul class="sub-menu children dropdown-menu">
						    <li><i class="fa fa-user-circle-o"></i><a href="drivers">View Drivers</a></li> 
                                                    <li><i class="fa fa-user-circle-o"></i><a href="driversrates">Driver Rates</a></li> 
                        </ul>
                    </li>
					
					
					<li class="menu-title">PRODUCTS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-fort-awesome"></i>Categories</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-fort-awesome"></i><a href="category">View Categories</a></li> 
                        </ul>
                    </li> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Services</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-bar-chart"></i><a href="services"> View Services</a></li>
							<li><i class="menu-icon fa fa-map-o"></i><a href="servicesprovision"> View Services-Providers</a></li>
                        </ul>
                    </li>  
					

                    <li class="menu-title">ACTIONS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Bookings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookings">View Bookings</a></li> 
                        </ul>
                    </li> 
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money"></i>Pickup Fee</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-money"></i><a href="pickups">Pickup Fee</a></li>
                        </ul>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-comments"></i>Enquiries</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-comments"></i><a href="enquiries">Enquiries</a></li>
                        </ul>
                    </li>
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					<li class="menu-title">&nbsp;</li><!-- /.menu-title -->
					'; 
					}else{ 
					//echo $_SESSION['userid'];
						echo '
					<li>
                        <a href="dashboard"><i class="menu-icon fa fa-tachometer"></i>Dashboard </a>
                    </li>
					
					<li class="menu-title">ACTIONS</li><!-- /.menu-title -->

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Bookings</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookingPartner">View Bookings</a></li>
                            
                            <li><i class="menu-icon fa fa-cart-plus"></i><a href="bookingAssigned">Booking assigned</a></li>
                        </ul>
                    </li> 
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bell-o"></i>Notifications</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-bell-o"></i><a href="notificationsCustomer">Notify all customers</a></li>
                            <!--<li><i class="menu-icon fa fa-bell-o"></i><a href="notifications">Notify all drivers</a></li>-->
                            <li><i class="menu-icon fa fa-bell-o"></i><a href="notificationsDriver">Notify all drivers</a></li>  							
                        </ul>
                    </li>
					
					<li class="menu-title">MANAGEMENT</li><!-- /.menu-title -->
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Garage</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-car"></i><a href="garage">Garage Details</a></li>
                            <li><i class="menu-icon fa fa-bar-chart"></i><a href="servicesprovisionGarage"> View Services</a></li>
                        </ul>
                    </li>
					<li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-credit-card"></i>Invoices</a>
                        <ul class="sub-menu children dropdown-menu">
                                                        <!--<li><i class="menu-icon fa fa-credit-card"></i><a href="invoices">View Invoices</a></li>-->
                            <li><i class="menu-icon fa fa-credit-card"></i><a href="invoice_list">View Invoices</a></li>
							<li><i class="menu-icon fa fa-credit-card"></i><a href="confirmedDoneBooking">Create Invoices</a></li>
		                    <!--<li><i class="menu-icon fa fa-credit-card"></i><a href="create_invoice.php">Create Invoice</a></li>-->
                        </ul>
                    </li>
					'; 
					} 
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
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>

                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">5</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 5 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>1 Requested for pickup.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>2 Requested for approval.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>4 Had been here for 3months.</p>
                                </a>
                            </div>
                        </div>
                    </div>

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
                                <h1>Inquiries Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Enquiries</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> All Inquiries from Customers</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">  
                                </table>
								 <table id="manageCustomersTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
										    <th>#</th>
                                            <th>Name</th> 
											<th>Email</th>
											<th>Phone</th>  
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

     <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2020 Skyline
                    </div> 
                    <div class="col-sm-6 text-right">
                        Designed by <a href="#">Starmanager</a>
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- /#right-panel -->
<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal1" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content" id="printThis">
    	
    	<form class="form-horizontal" id="editCategoriesForm1" action="php_action/editCategory" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Customer Details</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>
              <div class="row">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
                                <div class="form-group"><label for="company" class=" form-control-label">First name</label><input type="text" name = "fname" id="editfname" class="form-control"readonly></div>
                                <div class="form-group"><label for="vat" class=" form-control-label">Last name</label><input type="text" name = "lname" id="editlname" class="form-control"readonly></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Mobile number</label><input type="text" name="phone1" id="editphone1"class="form-control"readonly></div>
                                <div class="form-group"><label for="street" class=" form-control-label">Office number</label><input type="text" name="phone2" id="editphone2"class="form-control"readonly></div>
								<div class="row form-group"> 
                                    <div class="col-8">
                                        <div class="form-group"><label for="postal-code" class=" form-control-label">Email</label><input type="text" name="email" id="editemail" class="form-control" readonly></div>
                                    </div>
                                </div>
                               </div>
                        </div>
                    </div> 

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
                                 <div class="form-group"><label for="Street" class=" form-control-label">Street</label><input type="text" name="street"id="editstreet"class="form-control"readonly></div>
                                <div class="form-group"><label for="state" class=" form-control-label">State</label><input type="text" name="state"id="editstate" class="form-control"readonly></div>
                                <div class="row form-group">
                                    <div class="col-8">
                                        <div class="form-group"><label for="city" class=" form-control-label">City</label><input type="text" name="city"id="editcity"class="form-control"readonly></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group"><label for="zip-code" class=" form-control-label">Zip Code</label><input type="text" name="zip"id="editzip" class="form-control"readonly></div>
                                    </div>
                                </div>
                                <div class="form-group"><label for="regDate" class=" form-control-label">Registration Date</label>
								<input type="date" name="regDate"id="editregDate"  class="form-control"readonly></div>
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
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/editCustomer.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Block / Unblock Customer</h4>
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
									<label for="postal-code" class="col-sm-4 form-control-label">Email</label>
                                    <div class="col-sm-8"> 
										<input type="text" name="email" id="editemail1" class="form-control" readonly> 
                                    </div>
                                </div>
								<div class="row form-group">
									<label for="customerStatus" class="col-sm-4 control-label">Customer Status </label> 
										<div class="col-sm-8">
										  <select class="form-control" id="customerStatus1" name="editcustomerStatus">
											<option value="">~~SELECT~~</option>
											<option value="1">Unblock</option>
											<option value="0">Block</option>
										  </select>
										</div>
								</div> <!-- /form-group-->	
                               </div>
                        </div>
                    </div>   
            </div>
 	        
		      <!-- /edit brand result -->

	      </div> <!-- /modal-body -->  
	      <div class="modal-footer"> 
	        
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
        <h4 class="modal-title"><i class="fa fa-trash"></i> Unblock the customer</h4>
      </div>
      <div class="modal-body">
        <p>Do you really want to unblock this ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="fa fa-check"></i> Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- Right Panel -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCategoriesModal1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-trash"></i> Block the customer</h4>
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
    
	<script src="custom/js/inquiries.js"></script>

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
