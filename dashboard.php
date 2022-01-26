<?php
require_once 'php_action/db_connect.php';
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}


//die($_SESSION["id"]);
//echo "ID : ".$_SESSION['id'];
//die("Role : ".$_SESSION['user_type']);
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
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
 
     
     
   <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
	
	   <!-- bootstrap -->
	
	  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://pn-ciamis.go.id/asset/DataTables/extensions/Buttons/css/buttons.dataTables.css">
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
       div.dataTables_wrapper {
        width: 1000px;
        margin: 0 auto;
    }
</style>
</head>

<body>
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
        <div class="content">
            <!-- Animated -->
			<?php
			 if($role == 0){
			?>
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                     <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-user text-primary border-primary"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">N<sup>o</sup> Customer</div>
										<?php
									    $sql = "SELECT count(id) as num FROM customertbl WHERE user_type='customer'";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no customer so far!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['num'].'</div>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="fa fa-car text-warning border-warning" aria-hidden="true"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">N<sup>o</sup> Drivers</div>
                                        <?php
									    $sql = "SELECT count(id) as num FROM customertbl WHERE user_type='Driver'";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no driver so far!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['num'].'</div>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="fa fa-wrench text-warning border-warning" aria-hidden="true"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">N<sup>o</sup> Garages</div>
                                        <?php
									    $sql = "SELECT count(garageID) as nu FROM garagetbl WHERE 1";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no garage so far!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['nu'].'</div>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Paid invoice</div>
                                        <?php
									    $sql = "SELECT count(payment_id) as nu FROM payments WHERE 1";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no payment done!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['nu'].'</div>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="ti-money text-danger border-danger"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Pending-Invoices</div>
                                        <?php
									    $sql = "SELECT count(t1.order_id) as nu, t1.* FROM invoice_order AS t1
												LEFT JOIN payments AS t2 ON 
													t1.bookingID=t2.txn_id 
												WHERE t1.state=2 AND t2.txn_id IS NULL";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no payment done!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['nu'].'</div>';
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="fa fa-money text-success border-success"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">Revenues</div>
                                        <?php
									    $sql = "SELECT SUM(invoice_order.order_total_after_tax) as total, invoice_order.*, 
										payments.* FROM invoice_order, payments WHERE payments.txn_id =invoice_order.bookingID";
										$result = $connect->query($sql);
                                        if(!$result){
											echo "There is no payment done!";
										}
										while($row = $result->fetch_array()) {  
                                           echo '<div class="stat-digit">'.$row['total'].'$</div>';
										}
										?>
										
										
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div> 
			
		<div class="portlet-body">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"> 
								
								 <strong class="card-title"><i class="fa fa-edit"></i> Recent Bookings</strong>
							  
			                </div>
                            <div class="card-body">  
                                   <table id="manageDriversTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <!-- <th class="serial">#</th>
                                                   <th class="avatar">Avatar</th>--> 
						    <th>Customer</th>
                                                    <th>Service</th>
                                                    <th>Garage</th>
                                                    <th>Make_Model</th> 
						     <th>CarColor</th>
						     <th>Pickdate</th>
						     <th>PickTime</th>
                                                      <th>Bookingdate</th>
						      <th>BookingTime</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
									
                                            
                                        </table> 
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
           <?php
		}
		else{
			
		?>
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Garage Home Page</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Garage</a></li>
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
					    <?php
							$select = "SELECT * FROM garagetbl WHERE garageID =".$_SESSION["garageID"];
							
							$result = $connect->query($select);
							$rws = $result->fetch_array();
                                                        $_SESSION["garagename"] = $rws['Name'];
							?>
                        <div class="card">
                            <div class="card-header"> 
								 <i class="fa fa-home"></i><strong class="card-title"></strong><?php echo "  Hello admin - Welcome to <b>".htmlspecialchars($_SESSION["garagename"]);?></b> Garage!
			                     
                            </div>
                            <div class="card-body">
							
							<div class="col-md-12"> 
                            <div class="card-body">
                                <div class="stat-widget-one">
                                    <div class="stat-icon dib"><i class="fa fa-home text-warning border-warning" aria-hidden="true"></i></div>
                                    <div class="stat-content dib">
                                        <div class="stat-text">
                                            <p style="font-color:blue; font-size:12px, text-align:right;">   This is a platform where you can use to manage your duties.</b></p>
											 
											</strong>
											<ul class="list-group list-group-flush">
												  <li class="list-group-item">Management of bookings</li>
												  <li class="list-group-item">Management of notifications</li>
												  <li class="list-group-item">Management of services</li>
												  <li class="list-group-item">Management of garage information</li>
												  <li class="list-group-item">Management of Pro forma</li> 
                                                  <li class="list-group-item">Management of invoices</li> 												  
												</ul>
                                        </div>
                                    </div> 
                            </div>
                        </div>
                    </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->
		
	<!--</div>-->
		
	<?php
		}
	?> 
    </div><!-- .content -->  

        <div class="clearfix"></div>

         <?php
			  require("include/footer.php");
			?>  
</body>
</html>
    <!--</div> /#right-panel -->

    
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>
	
			<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
			
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src = "https://code.highcharts.com/modules/data.js"></script>   
   <script src = "https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script> 
	
	
	
    <script src="custom/js/dashboard.js"></script>
    

