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
<?php 
    // Include the database config file 
    include_once 'dbConfig.php'; 
     
    // Fetch all the country data 
    $query = "SELECT * FROM countrytbl ORDER BY countryname ASC"; 
    $result = $db->query($query); 
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
		
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Garages Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="allgarages">Garages</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> Manage Partrner garages</strong>
			                     <button class="btn btn-default button1 float-right" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal" title="Add a new Garage"> <i class="fa fa-plus text-primary"></i> Add garage</button>
                            </div>
							<div class="remove-messagesss"></div>
                            <div class="card-body">
                                <table id="manageGaragesTable" class="table table-striped table-bordered">
                                    <thead>
                                        <tr> 
											<!--<th>Logo</th> -->
                                            <th>Name</th> 
											<th>Email</th>
											<th>Website</th>
											<th>Phone</th>
											<th>State</th>
											<th>City</th>
											<th>Street</th>
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

    	<form class="form-horizontal" id="submitCategoriesForm" action="php_action/createGarages.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h5 class="modal-title"><i class="fa fa-plus"></i> <b>Add New Garage</b></h5>
	      </div>
	      <div class="modal-body">

	      	<div id="add-categories-messages"></div> 
	<div class="row">
      <div class="col-lg-6">
        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
			<div class="form-group">
	        	<label for="picture" class="col-sm-4 control-label">Garage Logo: </label> 
				    <div class="col-sm-8">
				      <input type="file" class="form-control" id="companyPic"  name="picture"/>
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="garageName" class="col-sm-4 control-label">Name: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="garageName" placeholder="Garage Name" name="garageName" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="email" class="col-sm-4 control-label">Email: </label> 
				    <div class="col-sm-8">
				      <input type="email" class="form-control" id="email" placeholder="Email address" name="email" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
	        	<label for="phone" class="col-sm-4 control-label">Phone: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			
            <div class="form-group">
	        	<label for="weblink" class="col-sm-4 control-label">Website link: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="weblink" placeholder="Web link" name="weblink" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			
			 </div>
          </div> 
       </div>
       <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
			<div class="form-group">
			<label for="state" class="col-sm-4 control-label">Country: </label> 
			   <div class="col-sm-8">
				<!-- Country dropdown -->
				<select id="country" name="country"  class="form-control">
					<option value="">Select Country</option>
					<?php 
					if($result->num_rows > 0){ 
						while($row = $result->fetch_assoc()){  
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
	        	<label for="street" class="col-sm-4 control-label">Street: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="street" placeholder="Street" name="street" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="zip" class="col-sm-4 control-label">Zip code: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="zip" placeholder="Zip code" name="zip" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="longitude" class="col-sm-4 control-label">Longitude: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="longitude" placeholder="Longitude" name="longitude" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
	        	<label for="latitude" class="col-sm-4 control-label">Latitude: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="latitude" placeholder="Latitude" name="latitude" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 			
	        <div class="form-group">
	        	<label for="garageStatus" class="col-sm-4 control-label">Status </label> 
				    <div class="col-sm-8">
				      <select class="form-control" id="garageStatus" name="garageStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Available</option>
				      	<option value="2">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->
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
</div> 
<!-- /add categories -->


<!-- edit categories brand -->
<div class="modal fade" id="editCategoriesModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
    	
    	<form class="form-horizontal" id="editCategoriesForm" action="php_action/editGarage.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Garage</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="edit-categories-messages"></div>

	      	<div class="modal-loading div-hide" style="width:20px; margin:auto;padding-top:20px; padding-bottom:20px;">
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
						<span class="sr-only">Loading...</span>
					</div>

		      <div class="edit-categories-result">
		      		<div class="row">
      <div class="col-lg-6">
        <div class="card">
                            <div class="card-header"><strong>Information</strong></div>
                            <div class="card-body card-block">
			<!--<div class="form-group text-right">
				<label for="logo" class=" form-control-label"> 
					<p><img src="" id="companyPic" alt="Logo" class="img-thumbnail"></p>
						</label>
			</div>
			<div class="form-group">
				<label for="editname" class="col-sm-4 control-label">Logo: </label> 
				    <div class="col-sm-8">																 
			       <input type="file" name="companyPic" id="companyPic" value="" class="form-control"/>
				  </div>																
			</div>-->
			
			
            <div class="form-group">
	        	<label for="editname" class="col-sm-4 control-label">Name: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editname" placeholder="Garage Name" name="editname" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
            <div class="form-group">
	        	<label for="editemail" class="col-sm-4 control-label">Email: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editemail" placeholder="Email address" name="editemail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
	        	<label for="editphone" class="col-sm-4 control-label">Phone: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editphone" placeholder="Phone number" name="editphone" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
			<div class="form-group">
	        	<label for="editthumbnail" class="col-sm-4 control-label">Garage Logo: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editthumbnail" placeholder="Logo" name="editthumbnail" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="editweblink" class="col-sm-4 control-label">Website link: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editweblink" placeholder="Web link" name="editweblink" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			
			 </div>
          </div> 
       </div>
       <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header"><strong>Addresses</strong></div>
                            <div class="card-body card-block">
            <div class="form-group">
	        	<label for="editstate" class="col-sm-4 control-label">State: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editstate" placeholder="State" name="editstate" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="editcity" class="col-sm-4 control-label">City: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editcity" placeholder="City" name="editcity" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="editstreet" class="col-sm-4 control-label">Street: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editstreet" placeholder="Street" name="editstreet" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->	
            <div class="form-group">
	        	<label for="editzip" class="col-sm-4 control-label">Zip code: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editzip" placeholder="Zip code" name="editzip" autocomplete="off">
				    </div>
	        </div> <!-- /form-group-->
            <div class="form-group">
	        	<label for="editlongitude" class="col-sm-4 control-label">Longitude: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editlongitude" placeholder="Longitude" name="editlongitude" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 
			<div class="form-group">
	        	<label for="editlatitude" class="col-sm-4 control-label">Latitude: </label> 
				    <div class="col-sm-8">
				      <input type="text" class="form-control" id="editlatitude" placeholder="Latitude" name="editlatitude" autocomplete="off">
				    </div>
	        </div> <!-- /form-group--> 			
	        <div class="form-group">
	        	<label for="editgarageStatus" class="col-sm-4 control-label">Status </label> 
				    <div class="col-sm-8">
				      <select class="form-control" id="editgarageStatus" name="editgarageStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="1">Available</option>
				      	<option value="2">Not Available</option>
				      </select>
				    </div>
	        </div> <!-- /form-group-->
          </div>
         </div>
        </div>  			
	      </div> <!-- /modal-body -->
		      </div> 
               </div> 			  
		      <!-- /edit brand result -->
	      
	      <div class="modal-footer editCategoriesFooter">
	        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
	        
	        <button type="submit" class="btn btn-success" id="editCategoriesBtn" data-loading-text="Loading..." autocomplete="off"> <i class="fa fa-check"></i> Save Changes</button>
	      </div> 
     	</form> 

	      </div> <!-- /modal-body -->
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
        <h4 class="modal-title"><i class="fa fa-trash"></i> Disable Garage</h4>
      </div>
	  <div class="remove-messages"></div>
      <div class="modal-body">
        <p>Do you really want to disable ?</p>
      </div>
      <div class="modal-footer removeCategoriesFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="fa fa-remove"></i> Close</button>
        <button type="button" class="btn btn-primary" id="removeCategoriesBtn" data-loading-text="Loading..."> <i class="fa fa-check"></i> Save changes</button>
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
    
	<script src="custom/js/garage.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
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
