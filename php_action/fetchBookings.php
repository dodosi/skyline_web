<?php 	 
require_once 'db_connect.php';

$sql = "SELECT `booking`.id, `servicestbl`.serviceName, `booking`.garage, `booking`.make, `booking`.model, 
`booking`.plate_number, `booking`.engine_number, `booking`.car_color, `booking`.description, `booking`.pick_up_date, 
`booking`.pick_up_time, `booking`.latitude, `booking`.longitude, `customertbl`.fname, `customertbl`.lname, `booking`.comment, `booking`.status, booking.book_date, booking.book_time
FROM `booking`, `servicestbl`, customertbl 
WHERE `booking`.service = `servicestbl`.servID AND 
       customertbl.email = booking.email GROUP BY `booking`.id ORDER BY booking.book_date DESC";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
$i =1;
 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
	
 	// active 
 	if($row[16] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-danger'>Awaiting</label>";
 	} elseif($row[16] == 2) {
 		// deactivate member
 		$activeCategories = "<label class='label label-primary'>Accepted by Garage</label>";
 	} elseif($row[16] == 3) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Picked by Driver</label>";
 	}elseif($row[16] == 4) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Assigned Techn</label>";
 	}elseif($row[16] == 5) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Tech assessment done</label>";
 	}elseif($row[16] == 6) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Pro forma done</label>";
 	}elseif($row[16] == 7) {
 		// deactivate member
 		$activeCategories = "<label class='label label-info'>Pro forma Accepted</label>";
 	}elseif($row[16] == 8) {
 		// deactivate member
 		$activeCategories = "<label class='label label-default'>Pro forma Rejected</label>";
 	}elseif($row[16] == 9) {
 		// deactivate member
 		$activeCategories = "<label class='label label-success'>Booking Done</label>";
 	}else{
		// deactivate member
 		$activeCategories = "<label class='label label-default'>Booking Rejected</label>";
	}
    
	
	if($row[16] == 7 || $row[16] == 9) {
		$sqls ="SELECT `order_id`, `user_id`, `order_date`, `order_receiver_name`, 
		`order_receiver_address`, `order_total_before_tax`, `order_total_tax`, `order_tax_per`, 
		`order_total_after_tax`, `order_amount_paid`, 
		`order_total_amount_due`, `note`, `state`, `email`, `bookingID` FROM `invoice_order` WHERE  bookingID =$categoriesId";
		//$sqls = "SELECT * FROM invoice_order WHERE bookingID =$categoriesId";
		$results = $connect->query($sqls);
		 
		
		$rowz = $results->fetch_array();
		
        
	   $button = '<!-- Single button -->
		<div class="btn-group">
		  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Action <span class="caret"></span>
		  </button>
		   <ul class="dropdown-menu"> 
			 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
			 <li><a href="./webview_invoiceFromAdmin.php?invoice_id='.$rowz[0].'" title="Print Invoice"><span class="fa fa-paper-plane"></span>  View invoice</a></li> 
			 <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"><i class="fas fa-file-invoice-dollar"></i>  View invoice</a></li>-->       
		     <li><a href="./print_invoiceFromAdmin.php?invoice_id='.$rowz[0].'" title="Print Invoice"><span class="glyphicon glyphicon-print"></span> Print Invoice</a></li> 
		  </ul> 
		</div>';
 	} elseif($row[16] == 6 || $row[16] == 8 ) {
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
	     <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"><i class="fas fa-file-invoice-dollar"></i>  View invoice</a></li>-->       
	  </ul> 
	</div>';
 	} else{
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
	     <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"><i class="fas fa-file-invoice-dollar"></i>  View invoice</a></li>--       
	  </ul> 
	</div>';
	}
       $date =$row[9]; 
       $datetime =$row[10]; 
       $date1 =$row[17]; 
       $datetime1 =$row[18]; 
	   
 	    $output['data'][] = array( 
        $i,  	
 	    $row[1],  
        $row[2], 
        $row[3], 
        $row[4], 
        $row[5], 
        $row[6], 
        $row[7], 
        date('m/d/Y', strtotime($date)),
         date('h:i A', strtotime($datetime)),
        $row[13]." ".$row[14], 
         date('m/d/Y', strtotime($date1)),
         date('h:i A', strtotime($datetime1)),		
 		$activeCategories,
 		$button 		
 		); 
        $i++;		
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);