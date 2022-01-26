<?php require_once 'php_action/db_connect.php'; ?>
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
$user_id = $_SESSION['id'];
$sql = "SELECT * FROM partnertbl WHERE id = {$user_id}";
$query = $connect->query($sql);
$result = $query->fetch_assoc();
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
                            <div class="page-title"><h1>System user Settings</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">User</a></li>
                                    <li><a href="#">Settings</a></li>
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
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block"> 
				<form action="php_action/changeUsername.php" method="post" class="form-horizontal" id="changeUsernameForm">
					<fieldset>
						<legend>Change Username</legend>

						<div class="changeUsenrameMessages"></div>			

						<div class="form-group">
					    <label for="username" class="col-sm-2 control-label">Username</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="username" name="username" placeholder="Usename" value="<?php echo $result['email']; ?>"/>
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['id'] ?>" /> 
					      <button type="submit" class="btn btn-success" data-loading-text="Loading..." id="changeUsernameBtn"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					    </div>
					  </div>
					</fieldset>
				</form>

				<form action="php_action/changePassword.php" method="post" class="form-horizontal" id="changePasswordForm">
					<fieldset>
						<legend>Change Password</legend>

						<div class="changePasswordMessages"></div>

						<div class="form-group">
					    <label for="password" class="col-sm-2 control-label">Current Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="Current Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="npassword" class="col-sm-2 control-label">New password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="npassword" name="npassword" placeholder="New Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <label for="cpassword" class="col-sm-2 control-label">Confirm Password</label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password">
					    </div>
					  </div>

					  <div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					    	<input type="hidden" name="user_id" id="user_id" value="<?php echo $result['id'] ?>" /> 
					      <button type="submit" class="btn btn-primary"> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes </button>
					      
					    </div>
					  </div>


					</fieldset>
				</form>

			</div> <!-- /panel-body -->	 
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
    </div>
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
    
<script src="custom/js/setting.js"></script>

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
