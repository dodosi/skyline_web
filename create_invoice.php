<?php 
session_start();
require_once 'php_action/db_connect.php';
include('includes/header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");
	//die("Here we go");	
}
?> 
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
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
                                <h1>Invoices Management</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#">Management</a></li>
                                    <li><a href="#">Invoices</a></li>
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
								 <strong class="card-title"><i class="fa fa-edit"></i> Pro forma creation</strong>
			                </div>
							<div id="remove-messages"></div>  
                            <div class="card-body">   
										<form action="" id="invoice-form" method="post" class="invoice-form" role="form" novalidate=""> 
											<div class="load-animate animated fadeInUp"> 
												<input id="currency" type="hidden" value="$">
												<div class="row">
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
													    <?php 
                                                                           $select = "SELECT * FROM garagetbl WHERE garageID= ".$_SESSION['garageID'];
														//$result =mysqli_query($select, $connect); 
														$result = $connect->query($select);
														$rws = $result->fetch_array();
														
														if($_SESSION['user_type'] == 1){ 
														
															echo '<img src="images/'.$rws[5].'" width="120" height="50"> <br/><br/>';
														}else{
														    echo '<img src="images/car-garage.jpg" width="100" height="60"> <br/><br/>';	
														}
 
															echo "<b>".$rws[1]."</b><br/>";
															echo "<b>".$rws[2]."</b><br/>";
															echo "<b>".$rws[3]."</b><br/>";
															echo "<b>".$rws[4]."</b><br/><hr/>";  
														echo "Prared by echo ".$_SESSION['fname'].' '.$_SESSION['lname']; 
														echo "<br/>";
														$sql = "SELECT DISTINCT `bookassignment`.id, booking.id, servicestbl.serviceName, booking.make, 
														booking.model, booking.description, bookassignment.customer_email, bookassignment.mechnicalnames, 
														bookassignment.date, bookassignment.status, booking.plate_number, booking.engine_number, booking.car_color, 
														booking.state, booking.city, booking.street, booking.zipcode, customertbl.fname, customertbl.lname FROM `booking` , 
														`bookassignment`, customertbl, servicestbl WHERE booking.id = bookassignment.bookID AND bookassignment.status = 1 AND 
														booking.service=servicestbl.servID AND booking.email =customertbl.email AND bookassignment.id = $_GET[ID]";
																
														$rs = $connect->query($sql);
														$row1 = $rs->fetch_array();
														$_SESSION['customeremail']=$row1[6];
														
														$sql1 = "SELECT `movements`.`id` as id, `movements`.`email`, `movements`.`request_id`, `movements`.`type`, `movements`.`start_time`, `movements`.`end_time`,SUM(TIMESTAMPDIFF(MINUTE,`start_time`,`end_time`)) as duration ,`pickcost` FROM `movements`,`pickuprangetbl` WHERE `request_id`=$row1[1]"; //$row1[1]
														$rsw = $connect->query($sql1);
														if($rsw != 1){
															echo "He was not picked!";
														}
														$row12 = $rsw->fetch_array();
														$pickup = $row12[6] * $row12[7];
								
														   ?>													
													</div>      		
													<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 pull-right">
														<h3>To,</h3>
														<div class="form-group">
															<input type="text" class="form-control" name="companyName" value="<?php echo $row1[17].' '.$row1[18]?>" id="companyName" placeholder="Company Name" autocomplete="off">
														</div>
														<div class="form-group">
															<textarea class="form-control" rows="3" name="address"><?php echo $_SESSION['customeremail']."/".$row1['street']."-".$row1['city']."-".$row1['state']."-".$row1['zipcode'];?></textarea>
														</div>
														
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
														<table class="table table-bordered table-hover" id="invoiceItem">	
															<tr>
																<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
																<th width="15%">Item No</th>
																<th width="38%">Description</th>
																<th width="15%">Quantity</th>
																<th width="15%">Unity Price</th>								
																<th width="15%">Total</th>
															</tr>
                                                            <tr>
																<td><input class="itemRow" type="checkbox"></td>
																<td><input type="text" name="productCode[]" id="productCode_1" class="form-control" autocomplete="off"></td>
																<td><input type="text" name="productName[]" id="productName_1" value="<?php echo "Pick up and Droop off price";?>" class="form-control" autocomplete="off" readonly></td>			
																<td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" value =2 autocomplete="off" readonly></td>
																<td><input type="number" name="price[]" id="price_1" value="<?php echo $pickup;?>" class="form-control price" autocomplete="off" readonly></td>
																<td><input type="number" name="total[]" id="total_1" class="form-control total" autocomplete="off" readonly></td>
															</tr>								
															<tr>
																<td><input class="itemRow" type="checkbox"></td>
																<td><input type="text" name="productCode[]" id="productCode_2" class="form-control" autocomplete="off"></td>
																<td><input type="text" name="productName[]" id="productName_2" value="<?php echo $row1[2];?>" class="form-control" autocomplete="off"></td>			
																<td><input type="number" name="quantity[]" id="quantity_2" class="form-control quantity" autocomplete="off"></td>
																<td><input type="number" name="price[]" id="price_2" class="form-control price" autocomplete="off"></td>
																<td><input type="number" name="total[]" id="total_2" class="form-control total" autocomplete="off"></td>
															</tr>														
														</table>
													</div>
												</div>
												<div class="row">
													<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
														<button class="btn btn-danger delete" id="removeRows" type="button">- Delete</button>
														<button class="btn btn-success" id="addRows" type="button">+ Add More</button>
													</div>
												</div>
												<div class="row">	
													<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
														<h3>Notes: </h3>
														<div class="form-group">
															<textarea class="form-control txt" rows="5" name="notes" id="notes" placeholder="Your Notes"></textarea>
														</div>
														<br>
														<div class="form-group">
														    <input type="hidden" value="<?php echo $row1[6]; ?>" class="form-control" name="email">
														    <input type="hidden" value="<?php echo $row1[1]; ?>" class="form-control" name="Bookstatus">
															<input type="hidden" value="<?php echo $rws[0]; ?>" class="form-control" name="userId">
															<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="btn btn-success submit_btn invoice-save-btm">						
														</div>
														
													</div>
													<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
														<span class="form-inline">
															<div class="form-group">
																<label>Subtotal: &nbsp;</label>
																<div class="input-group">
																	<div class="input-group-addon currency">$</div>
																	<input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
																</div>
															</div> 
															<div class="form-group">
																<label>Tax Rate: &nbsp;</label>
																<div class="input-group">
																	<input value="" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
																	<div class="input-group-addon">%</div>
																</div>
															</div>
															<div class="form-group">
																<label>Tax Amount: &nbsp;</label>
																<div class="input-group">
																	<div class="input-group-addon currency">$</div>
																	<input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount"  readonly>
																</div>
															</div>							
															<div class="form-group">
																<label>Total: &nbsp;</label>
																<div class="input-group">
																	<div class="input-group-addon currency">$</div>
																	<input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total"  readonly>
																</div>
															</div>
															<div class="form-group">
																<label>Amount Paid: &nbsp;</label>
																<div class="input-group">
																	<div class="input-group-addon currency">$</div>
																	<input value="" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
																</div>
															</div>
															<div class="form-group">
																<label>Amount Due: &nbsp;</label>
																<div class="input-group">
																	<div class="input-group-addon currency">$</div>
																	<input value="" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due"  readonly>
																</div>
															</div>
														</span>
													</div>
												</div>
												<div class="clearfix"></div>		      	
											</div>
										</form>			
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


<?php include('includes/footers.php');?>