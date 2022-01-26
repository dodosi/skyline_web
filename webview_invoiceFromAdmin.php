<?php
		session_start();
		include('includes/headers.php');
		require_once "php_action/db_connect.php";
		include "Invoice.php";
		$invoice = new Invoice();
		$invoice->checkLoggedIn();
         
		$invoiceID = $_GET['invoice_id'];

		$squery = "SELECT * FROM `invoice_order` WHERE order_id =".$_GET['invoice_id'];
		$results = $connect->query($squery);
		$red = $results->fetch_array();

		$sr ="SELECT * FROM `invoice_order_item` WHERE order_id=".$_GET['invoice_id'];
		$resu = $connect->query($sr);

		
	    $select = "SELECT * FROM garagetbl WHERE garageID= ".$red[1];  
		$result = $connect->query($select);
		$rws = $result->fetch_array();
        
		$to = $red["email"];
		
		//$to = "hitimeric06@yahoo.fr"; 
		$from = "hitimeric06@yahoo.fr";//$rws[2]; 
		$fromName = $rws[1]; 
		 
		$subject = "Request for Service price approval"; 
 
$htmlContent ='
    <html> 
    <head> 
        <title>Welcome to CodexWorld</title> 
		
		<style type="text/css">
		.table {
			margin: 0 auto;
			margin-left: auto;
			margin-right: auto;
			width: 100%;
		}
		</style>
    </head> 
	<center>
    <body> 	 
      <div class="col-md-6"> 
		<div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">   
			                </div>
							
                            <div class="card-body">  
        <table class="table-condensed"> 
		    <tr> <td colspan="2"></td><td><img src="images/Skyline-logo3.png" width="290" height="80"></td></tr>
			<tr bgcolor="#85C1E9"> <td colspan="3"><center><h3>Proforma for Invoices N <sup>0</sup>:'.$invoiceID.'</h3></center></td> </tr>
            <tr> <td>';
                 			
				if($_SESSION['user_type'] == 1){  
			$htmlContent .= '<img src="php_action/images/'.$rws[5].'" width="120" height="50"> <br/><br/>';
				}else{
				
			$htmlContent .= '<img src="php_action/images/car-garage.jpg" width="120" height="50"> <br/><br/>'; 
				}
 
				$htmlContent .= '<b>'.$rws[1].'</b><br/>
				                <b>'.$rws[2].'</b><br/>
				                <b>'.$rws[3].'</b><br/>
				                <b>'.$rws[4].'</b><br/><hr/>
				                Prepared by '.$_SESSION["fname"].' '.$_SESSION["lname"].'<br/>
				                </td><td>&nbsp;&nbsp;&nbsp;</td> 
				        
						        <td valign="top">  
				                <h3>To: </h3> 
								       '.$red["order_receiver_name"].'
                                        <br/> 												  
										'.$red["order_receiver_address"].'
										<br/> 												  
										'.$red["email"].'';   
								$htmlContent .= '</td></tr>
													  <tr><td colspan=3>&nbsp;&nbsp;&nbsp;</td></tr>
													  <tr><td colspan=3>
													    <table class="table table-bordered table-hover" id="invoiceItem">	
														   <tr>
															<th width="2%"><input id="checkAll" class="formcontrol" type="checkbox"></th>
															<th width="15%">Item No</th>
															<th width="38%">Item Name</th>
															<th width="15%">Quantity</th>
															<th width="15%">Price</th>								
															<th width="15%">Total</th>
														</tr>';
														
														$count = 0;
														while($invoiceItem = $resu->fetch_array()){
															$count++;
																						
														$htmlContent .= '<tr>
															<td><input class="itemRow" type="checkbox"></td>
															<td><input type="text" value="'.$invoiceItem["item_code"].'" id="productCode_"{$count}" class="form-control" autocomplete="off" readonly></td>
															<td><input type="text" value="'.$invoiceItem["item_name"].'" name="productName[]" id="productName_"{$count} class="form-control" autocomplete="off" readonly></td>			
															<td><input type="number" value="'.$invoiceItem["order_item_quantity"].'" name="quantity[]" id="quantity_"{$count} class="form-control quantity" autocomplete="off" readonly></td>
															<td><input type="number" value="'.$invoiceItem["order_item_price"].'" name="price[]" id="price_" {$count} class="form-control price" autocomplete="off" readonly></td>
															<td><input type="number" value="'.$invoiceItem["order_item_quantity"]*$invoiceItem["order_item_price"].'" name="total[]" id="total_"{$count} class="form-control total" autocomplete="off" readonly></td>
															<input type="hidden" value="'.$invoiceItem["order_item_id"].'" class="form-control" name="itemId[]">
														</tr>';	
														} 		
													$htmlContent .= '</table>
												</td>
											</tr>
											<tr><td colspan=3>&nbsp;&nbsp;&nbsp;</td></tr>
											<tr>
											   <td  valign="top">
											      <table>
												    <tr><td><h3>Notes</h3></td></tr>
												      <tr>
													    <td>
												         <textarea cols="20%" rows="10" readonly>'.$red["note"].'</textarea>
													     </td>
													   </tr>
													</table>
													</td>
													<td></td>
													<td> 
													    <table>
														   <tr>
														      <td>
															  
														<div class="form-group">
															<label>Subtotal: &nbsp;</label>
															<div class="input-group">
																<div class="input-group-addon currency">$</div>
																<input value="'.$red["order_total_before_tax"].'" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>
															</div>
														</div>
															</td>
															</tr>
															<tr>
														      <td>
														<div class="form-group">
															<label>Tax Rate: &nbsp;</label>
															<div class="input-group">
																<input value="'.$red["order_tax_per"].'" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate" readonly>
																<div class="input-group-addon">%</div>
															</div>
														</div>
														    </td>
															</tr>
															<tr>
														      <td>
														
														<div class="form-group">
															<label>Tax Amount: &nbsp;</label>
															<div class="input-group">
																<div class="input-group-addon currency">$</div>
																<input value="'.$red["order_total_tax"].'" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount" readonly>
															</div>
														</div>		
                                                               </td>
															</tr>
															<tr>
														      <td>														
														<div class="form-group">
															<label>Total: &nbsp;</label>
															<div class="input-group">
																<div class="input-group-addon currency">$</div>
																<input value="'.$red["order_total_after_tax"].'" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total" readonly>
															</div>
														</div>
														    </td>
															</tr>
															<tr>
														      <td>
														<div class="form-group">
															<label>Amount Paid: &nbsp;</label>
															<div class="input-group">
																<div class="input-group-addon currency">$</div>
																<input value="'.$red["order_amount_paid"].'" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid" readonly>
															</div>
														</div>
														   </td>
															</tr>
															<tr>
														      <td>
														<div class="form-group">
															<label>Amount Due: &nbsp;</label>
															<div class="input-group">
																<div class="input-group-addon currency">$</div>
																<input value="'.$red["order_total_amount_due"].'" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due" readonly>
															</div>
														</div>
													 </td>
															</tr> 
												</table>
                 </td>							
            </tr> 
        </table>
        </td></tr>  	
        <tr  bgcolor="#85C1E9"> <td colspan=3><hr/><strong><p style="color:red">Confirm your bill within 24hours for further processing.</strong></p>
		<p style="color:blue">Thanks for choosing <a href="https://www.skylineautoservices.com/">SkylineAutoservices Ltd</a>.</p> 
		<!--To confirm, click <a href="http://skylineautoservices.co/admin/approvingEmail.php?invoice_id='.$invoiceID.'">here</a>
		                     To reject your invoice, click <a href="http://skylineautoservices.co/admin/rejectingProforma.php?invoice_id='.$invoiceID.'">here</a>;--> <hr/></td> </tr> 		
		   		
		</table> 
		</div>
                        </div>
                    </div> 
                </div>
            </div><!-- .animated -->
        </div>'; 
 echo $htmlContent;
 //echo $from;
 //echo $fromName;
// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
 
// Additional headers 
$headers .= "From: ".$fromName."<".$from.">" . "\r\n"; 
$headers .= "Cc: info@skylineautoservices.co" . "\r\n"; 
$headers .= "Bcc: lilinnah64@gmail.com" . "\r\n"; 
$headers .= "Bcc: hitimeric06@yahoo.fr" . "\r\n";
$headers .= "Bcc: mupla@gmail.com" . "\r\n";   
//echo $headers; 
/*
if(mail($to, $subject, $htmlContent, $headers)){
    echo "<script>confirm('Email has sent successfully');</script>"; 	
    echo ". <br/>
	     Thanks for choosing <a href='https://www.skylineautoservices.com/'>SkylineAutoservices Ltd</a>.</p> To confirm your invoice, click <a href='http://skylineautoservices.co/admin/approvingEmail.php?invoice_id=$invoiceID'>here</a>"; 
    echo ". <br/>
	     Thanks for choosing <a href='https://www.skylineautoservices.com/'>SkylineAutoservices Ltd</a>.</p> To reject your invoice, click <a href='http://skylineautoservices.co/admin/rejectingProforma.php?invoice_id=$invoiceID'>here</a>"; 
}else{ */
   //echo "Email sending failed."; 
  /* echo "Email sending failed.";
		 
	echo"	<br/>
	     Thanks for choosing <a href='https://www.skylineautoservices.com/'>SkylineAutoservices Ltd</a>.</p> To confirm your invoice, click <a href='http://skylineautoservices.co/admin/approvingEmail.php?invoice_id=$invoiceID'>here</a>; 
    
	     Thanks for choosing <a href='https://www.skylineautoservices.com/'>SkylineAutoservices Ltd</a>.</p> To reject your invoice, click <a href='http://skylineautoservices.co/admin/rejectingProforma.php?invoice_id=$invoiceID'>here</a>; 
		 
		 </script>"; 	
}*/
?>
 <?php
    echo "
	
		</div>
	</body> 
	</center>
    </html>"; 
			 // require('includes/footer.php');
			?>