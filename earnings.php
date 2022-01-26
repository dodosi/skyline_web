<?php 
session_start();
include('includes/header.php');
require_once 'php_action/db_connect.php'; 
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index");
    exit;
}
?>  

       <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.semanticui.min.css" media="all">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.semanticui.min.css" media="all">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" media="all">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css" media="all">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css" media="all">
<link href="css/style.css" rel="stylesheet"> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
<style>
 div.dataTables_wrapper {
        width: 1000px;
        margin: 0 auto;
    }
</style>
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
                                <h1>Driver's Earnings Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Earnings</a></li>
                                    <li class="active">Data</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php //include('includes/menu.php');?>	
		<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">  
								 <strong class="card-title"><i class="fa fa-edit"></i> List of Drivers Earnings</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">  
	  		  
											  <table id="data-table" class="table table-condensed table-striped">
												<thead>
												  <tr>
													<th>No.</th>
													<th>Driver_fname</th>  
													<th>Driver_lname</th> 
													<th>Email</th>
													<th>TotalEarings_[USD]</th> 
													<th>Action</th>
												  </tr>
												</thead>
												<tbody>
												<?php
                                                $query = "SELECT `movements`.`id` as id, `customertbl`.`email`, 
												customertbl.fname, customertbl.lname, `movements`.`request_id`, 
												`movements`.`type`, `movements`.`start_time`, `movements`.`end_time`,
												`customertbl`.`user_type`,SUM(TIMESTAMPDIFF(MINUTE,`start_time`,`end_time`) * (`pickcost`)) as earnings
												FROM `movements`,`pickuprangetbl`,`customertbl` 
												WHERE `customertbl`.`user_type`='DRIVER' AND customertbl.email = movements.email  GROUP BY `email`";												
												//$invoiceList = $invoice->getInvoiceList();
												$request = $connect->query($query);
												$i =1;
												while($row = $request->fetch_array()){  
												
													if($row['earnings'] > 0){
													echo '
													  <tr>
														<td>'.$i.'</td> ';
														?>
													    <td><span id="firstname<?php echo $row['id']; ?>"><?php echo $row['fname']; ?></span></td>
														<td><span id="lastname<?php echo $row['id']; ?>"><?php echo $row['lname']; ?></span></td>
														<td><span id="emailname<?php echo $row['id']; ?>"><?php echo $row['email']; ?></span></td>
														<td><span id="earningname<?php echo $row['id']; ?>"><?php echo $row['earnings'].' $$'; ?></span></td>
														<?php
														echo '
														<td><button type="button" data-dismiss="modal" class="btn btn-success edit"  data-toggle="modal" value="'.$row['request_id'].'"><span class="glyphicon glyphicon-edit"></span> Details</button></td>  
													  
													  </tr>
													'; 
													$i++;
													}
												}       
												?> 
												</tbody>
												<tfoot>
															<tr> 
																<th colspan="3" style="text-align:right">Total:</th>
																 <th> </th>
																<th> </th>   
															</tr>
														</tfoot>
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
</div><!-- .content -->
 
 <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title" id="myModalLabel">Details of driver earnings</h4></center>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
				<?php
				//echo $id = get_ID();
				?>
				<div class="container-fluid">
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Firstname:</span>
						<input type="text" style="width:350px;" class="form-control" id="efirstname">
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Lastname:</span>
						<input type="text" style="width:350px;" class="form-control" id="elastname">
					</div>
					<div class="form-group input-group">
						<span class="input-group-addon" style="width:150px;">Address:</span>
						<input type="text" style="width:350px;" class="form-control" id="eaddress">
					</div>					
				</div>
				</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
                    <button type="button" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span> </i> Update</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script> 
$(document).ready(function() {
	// DataTable initialisation
	var table = $('#data-table').DataTable(
		{
			"scrollX": true,
			"fixedHeader": true,
			"lengthChange": false,
            "buttons": ['pageLength', 'excel', 'colvis'],
			"paging": true,
			"autoWidth": true,
			"footerCallback": function ( row, data, start, end, display ) {
				var api = this.api();
				nb_cols = api.columns().nodes().length;
				var j = 5;
				while(j < nb_cols){
					var pageTotal = api
                .column( j, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return Number(a) + Number(b);
                }, 0 );
          // Update footer
          $( api.column( j ).footer() ).html(pageTotal);
					j++;
				} 
			}
		}
		
	); 
	table.buttons().container()
                        .appendTo($('div.eight.column:eq(0)', table.table().container()));
});
 $(document).ready(function(){
	$(document).on('click', '.edit', function(){
		var id=$(this).val();
		var first=$('#fname'+id).text();
		var last=$('#lname'+id).text();
		var address=$('#address'+id).text();
         alert(id);
		$('#edit').modal('show');
		$('#efirstname').val(first);
		$('#elastname').val(last);
		$('#eaddress').val(address);
	});
});
</script> 

 <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js " type="text/javascript"></script>
 <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
		        <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/1.10.23/js/dataTables.semanticui.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.semanticui.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js" type="text/javascript"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js" type="text/javascript"></script>
<?php include('includes/footers.php');?>