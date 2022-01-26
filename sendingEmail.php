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

		
	      $select = "SELECT * FROM garagetbl WHERE garageID= ".$_SESSION['garageID'];  
		$result = $connect->query($select);
		$rws = $result->fetch_array();
              
              $fromName = $rws[1];

              $htmlContent ='<html>  
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
        <table class="table table-condensed"> 
		    <tr> <td colspan="2"></td><td><img src="images/Skyline-logo3.png" width="290" height="80"></td></tr>
			<tr bgcolor="#85C1E9"> <td colspan="3"><center><h3>Proforma for Invoices N <sup>0</sup>:'.$invoiceID.'</h3></center></td> </tr>
            <tr> <td>';
                 			
				if($_SESSION['user_type'] == 1){  
			$htmlContent .= '<img src="http://l.yimg.com/a/i/ww/met/yahoo_logo_in_061509.png" width="120" height="50"> <br/><br/>';
				}else{
				
			$htmlContent .= '<img src="http://l.yimg.com/a/i/ww/met/yahoo_logo_in_061509.png" width="120" height="50"> <br/><br/>'; 
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
															<th width="38%">Description</th>
															<th width="15%">Quantity</th>
															<th width="15%">Unit Price</th>								
															<th width="15%">Total</th>
														</tr>';
														
														$count = 0;
														while($invoiceItem = $resu->fetch_array()){
															$count++;
																						
														$htmlContent .= '<tr>
															<td><input class="itemRow" type="checkbox"></td>
															<td><input type="text" value="'.$invoiceItem["item_code"].'" id="productCode_"{$count}" class="form-control" autocomplete="off"></td>
															<td><input type="text" value="'.$invoiceItem["item_name"].'" name="productName[]" id="productName_"{$count} class="form-control" autocomplete="off"></td>			
															<td><input type="number" value="'.$invoiceItem["order_item_quantity"].'" name="quantity[]" id="quantity_"{$count} class="form-control quantity" autocomplete="off"></td>
															<td><input type="number" value="'.$invoiceItem["order_item_price"].'" name="price[]" id="price_" {$count} class="form-control price" autocomplete="off"></td>
															<td><input type="number" value="'.$invoiceItem["order_item_final_amount"].'" name="total[]" id="total_"{$count} class="form-control total" autocomplete="off"></td>
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
												         <textarea cols="20%" rows="10">'.$red["note"].'</textarea>
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
																<input value="'.$red["order_total_before_tax"].'" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
															</div>
														</div>
															</td>
															</tr>
															<tr>
														      <td>
														<div class="form-group">
															<label>Tax Rate: &nbsp;</label>
															<div class="input-group">
																<input value="'.$red["order_tax_per"].'" type="number" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
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
																<input value="'.$red["order_total_tax"].'" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
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
																<input value="'.$red["order_total_after_tax"].'" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
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
																<input value="'.$red["order_amount_paid"].'" type="number" class="form-control" name="amountPaid" id="amountPaid" placeholder="Amount Paid">
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
																<input value="'.$red["order_total_amount_due"].'" type="number" class="form-control" name="amountDue" id="amountDue" placeholder="Amount Due">
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
		<p style="color:blue">Thanks for choosing <a href="https://www.skylineautoservices.com/">SkylineAutoservices Ltd</a>.</p> To confirm, click <a href="http://skylineautoservices.co/admin/approvingEmail.php?invoice_id='.$invoiceID.'">here</a>
		                     To reject your invoice, click <a href="http://skylineautoservices.co/admin/rejectingProforma.php?invoice_id='.$invoiceID.'">here</a>; <hr/></td> </tr> 		
		   		
		</table> 
		</div>
                        </div>
                    </div> 
                </div>
            </div><!-- .animated -->
        </div>
		</div>
	</body> 
	</center>
    </html>
'; 

?>
<?php
$sender = "lilinnah64@gmail.com";
$sendername = $fromName;
$recipient = "lilinnah64@gmail.com";
$copyrecipient = "mupla2@gmail.com";
$hiddencopyrecipient = "hitimeric06@yahoo.fr";

$subject = "Approval for Skyline Auto Services"; 

$headers = "From: " . $sendername . " <" . $sender . ">\n" ;
$headers .= "Cc: " . $copyrecipient . "\nBcc: " . $hiddencopyrecipient . "\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=utf-8\n";
$headers .= "Return-Path: " . $sender . "\n";
$headers .= "X-Mailer: PHP/" . phpversion();

//echo $headers;
$send = mail($recipient, $subject, $htmlContent, $headers);

if ($send) { 
    //confirm("Email sent");
   echo "Email is sent,  <a href=' http://skylineautoservices.co/admin/invoice_list'>go back </a>";
 } else { 
echo "Email not sent";
 }

?>