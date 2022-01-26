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
                                <h1>Transactions Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Transactions</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> List of Transactions</strong>
			                </div>
							<div id="remove-messages"></div> 
                            <div class="card-body">  
	  		  
											  <table id="data-table" class="table table-condensed table-striped">
												<thead>
												  <tr>
													<th>No.</th>
													<th>Customer_Name</th>
													<th>Create_Date</th>
													<th>Invoice_Total_[USD]</th>
													<th>Amount_paid_[USD]</th>
													<th>Balance_[USD]</th> 
													<th>DatePaid</th> 
													<th>Status</th>
												  </tr>
												</thead>
												<tbody>
												<?php
                                                $query = "SELECT payments.*, invoice_order.* FROM payments, invoice_order  WHERE invoice_order.bookingID = payments.txn_id";												
												//$invoiceList = $invoice->getInvoiceList();
												$request = $connect->query($query);
												$i =1;
												while($row = $request->fetch_array()){ 
													$invoiceDate = date("m/d/Y h:i A ", strtotime($row["order_date"]));
													$processeddate = date("m/d/Y h:i A ", strtotime($row["processeddate"]));
													$balance = $row["order_total_after_tax"] - $row["payment_gross"];
													echo '
													  <tr>
														<td>'.$i.'</td>
														<td>'.$row["order_receiver_name"].'</td>
														<td>'.$invoiceDate.'</td>
														<td>'.$row["order_total_after_tax"].'</td>
														<td>'.$row["payment_gross"].'</td>
														<td>'.$balance.'</td>
														<td>'.$processeddate.'</td>
														<td>';
														if($balance == 0){
															echo '<label class="label label-success">Payment Cleared</label>';
														 
														}else{
															echo '<label class="label label-danger">Balance overhead </label>';
														}  
														echo '</td>  
														
													  </tr>
													';
													$i++;
												}       
												?>
												</tbody>
												<tfoot>
															<tr> 
																<th colspan="3" style="text-align:right">Total:</th>
																 
																<th> </th>
																<th></th>
																<th></th>
																<th></th>
																<th></th> 
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
				var j = 3;
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