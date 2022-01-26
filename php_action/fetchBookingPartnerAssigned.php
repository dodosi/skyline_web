<?php 	
session_start();
$garageID = $_SESSION["garageID"];
$garageName = $_SESSION["garagename"];
require_once 'db_connect.php';

$sql = "SELECT booking.id,`booking`.email, booking.garage, servicestbl.serviceName, booking.make, booking.model, booking.plate_number, booking.engine_number, booking.car_color, booking.description, bookassignment.status, customertbl.fname, customertbl.lname,customertbl.phone,customertbl.state, customertbl.city, customertbl.street_number, customertbl.zip_code, bookassignment.mechnicalnames, bookassignment.date FROM `booking`, `garagetbl`, `customertbl`, servicestbl, bookassignment 
WHERE customertbl.email = booking.email AND booking.service = servicestbl.servID AND 
booking.id = bookassignment.bookID AND booking.garage = '$garageName' 
GROUP By booking.id ORDER BY bookassignment.date DESC";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $names = "";
 $address = "";
 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
	//$d ='';
 	// active 
 	if($row[10] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Technical assessment done</label>";
               $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">  
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModalEE"  id="editCategoriesModalBtnEE"onclick="editCategories33('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Assessment done</a></li>      
	  </ul> 
	</div>';
 	} elseif($row[10] == 0) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Assigned to Technician</label>";

    $button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">  
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModalE"  id="editCategoriesModalBtnE"onclick="editCategories3('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Confirm tech assessment</a></li>      
	  </ul> 
	</div>';
 	} else{
		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Tobe assigned</label>";
	}
    $datetime =  $row[19];  
	
 	$output['data'][] = array(  
        $row[11], 
        $row[12],  
 	    $row[1], 
        $row[3],  
        $row[4],
        $row[5],	
        $row[9],
        $row[18],
         date('m/d/Y h:i A ', strtotime($datetime)),		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);