<?php 	
session_start();
$garageID = $_SESSION["garageID"];
$garageName = $_SESSION["garagename"];

require_once 'db_connect.php';

$sql = "SELECT `bookassignment`.id, booking.id, servicestbl.serviceName, booking.make, booking.model, 
booking.description, bookassignment.customer_email, bookassignment.mechnicalnames, bookassignment.date, 
bookassignment.status, booking.plate_number, booking.engine_number, booking.car_color, booking.state, 
booking.city, booking.street, booking.zipcode, customertbl.fname, customertbl.lname FROM `booking` , 
`bookassignment`, customertbl, servicestbl  
WHERE booking.id = bookassignment.bookID AND bookassignment.status = 1 AND  
booking.service=servicestbl.servID AND booking.email =customertbl.email
 AND booking.garage = '$garageName' AND booking.status =5
 GROUP BY bookassignment.id ORDER BY bookassignment.date DESC";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $names = "";
 $address = "";
 
 while($row = $result->fetch_array()) {
 	$_SESSION["ID"] = $categoriesId = $row[0];
	$_SESSION["bookingID"]=$row[1];
	$_SESSION["service"] = $row[2];
	$_SESSION["make"] = $row[3];
	$_SESSION["model"] = $row[4];
	$_SESSION["plate"] = $row[10];
	$_SESSION["engine"] = $row[11];
	$_SESSION["color"] = $row[12];
	$_SESSION["state"] = $row[13];
	$_SESSION["city"] = $row[14];
	$_SESSION["street"] = $row[15];
	$_SESSION["zipcode"] = $row[16];
	$_SESSION["customerEmail"] = $row[17].' '.$row[18]; 
	//$d ='';
 	// active 
 	if($row[9] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Technical Assessment done</label>";
 	} elseif($row[9] == 2) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Ongoing service</label>";
 	} else{
		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Assined</label>";
	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">  
		 <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Create invoice</a></li>-->
         <li><a href="create_invoice.php?ID='.$categoriesId.'"> <i class="glyphicon glyphicon-check"></i> Create Pro forma</a></li>
	  </ul> 
	</div>';
        $d = date('m/d/Y h:i A ', strtotime($row[8]));
 	$output['data'][] = array(  
        $row[17], 
        $row[18],
		$row[6],		
        $row[2], 
         
         
        $row[3],  
        $row[4],
        $row[5],
        $row[10],		
        $row[7],
        $d,		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);