<?php 	
session_start();
$garageID = $_SESSION["garageID"];
$garageName = $_SESSION["garagename"];
require_once 'db_connect.php';

$sql = "SELECT  booking.id,`booking`.email, booking.garage, 
servicestbl.serviceName, booking.make, 
booking.model, booking.plate_number, 
booking.engine_number, booking.car_color, booking.description, booking.status, customertbl.fname, 
customertbl.lname,customertbl.phone,booking.state, booking.city, booking.street, 
booking.zipcode, booking.pick_up_date, booking.pick_up_time, booking.book_date, booking.book_time FROM `booking`, `garagetbl`, 
`customertbl`, servicestbl WHERE garagetbl.Name = booking.garage AND customertbl.email = booking.email AND  
booking.service = servicestbl.servID AND garagetbl.Name = '$garageName' GROUP BY booking.id  ORDER BY booking.book_date DESC";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $names = "";
 $address = "";
 $i=1;
 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
	//$d ='';
 	// active 
 	if($row[10] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-danger'>Awaiting</label>";
 	} elseif($row[10] == 2) {
 		// deactivate member
 		$activeCategories = "<label class='label label-primary'>Accepted by Garage</label>";
 	} elseif($row[10] == 3) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Picked by Driver</label>";
 	}elseif($row[10] == 4) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Assigned Techn</label>";
 	}elseif($row[10] == 5) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Tech assessment done</label>";
 	}elseif($row[10] == 6) {
 		// deactivate member
 		$activeCategories = "<label class='label label-warning'>Pro forma sent</label>";
 	}elseif($row[10] == 7) {
 		// deactivate member
 		$activeCategories = "<label class='label label-info'>Pro forma Accepted</label>";
 	}elseif($row[10] == 8) {
 		// deactivate member
 		$activeCategories = "<label class='label label-default'>Pro forma Rejected</label>";
 	}elseif($row[10] == 9) {
 		// deactivate member
 		$activeCategories = "<label class='label label-success'>Booking Done</label>";
 	} else{
		// deactivate member
 		$activeCategories = "<label class='label label-default'>Booking Rejected</label>";
	}
    if($row[10] == 1){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModalE"  id="editCategoriesModalBtnE"onclick="editCategories3('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Accept</a></li>
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModalD"  id="editCategoriesModalBtnD"onclick="editCategories2('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Reject</a></li> 
	   <!---  <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal"  id="editCategoriesModalBtn"onclick="editCategories('.$categoriesId.')"> <i class="fa fa-wrench" aria-hidden="true"></i> Assign Techn</a></li> -->      
	  </ul> 
	</div>';
    }elseif($row[10] == 3){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		 <!--<li><a type="button" data-toggle="modal" data-target="#editCategoriesModalE"  id="editCategoriesModalBtnE"onclick="editCategories3('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Accept</a></li>
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModalD"  id="editCategoriesModalBtnD"onclick="editCategories2('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Reject</a></li> --> 
	     <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal"  id="editCategoriesModalBtn"onclick="editCategories('.$categoriesId.')"> <i class="fa fa-wrench" aria-hidden="true"></i> Assign Techn</a></li>       
	  </ul> 
	</div>';
    }elseif($row[10] == 2){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li>  
	  </ul> 
	</div>';
    }elseif($row[10] == 4){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }
elseif($row[10] == 5){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }elseif($row[10] == 6){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }elseif($row[10] == 7){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }elseif($row[10] == 8){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }elseif($row[10] == 9){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }elseif($row[10] == 10){
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button> 
	  <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal1" id="editCategoriesModalBtn" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li> 
		   
	  </ul> 
	</div>';
    }
        $date = $row[18]; 
        $datetime =  $row[19]; 

        $date1 =  $row[20]; 
        $datetime1 =  $row[21]; 
        date('m/d/Y', strtotime($date));
        date('h:i A ', strtotime($datetime));

        date('m/d/Y ', strtotime($date1));
        date('h:i A ', strtotime($datetime1));
        
 	$output['data'][] = array(  
        $i,
        $row[11].' '.$row[12],		
 	    $row[1],
        $row[13],
        $row['street'].'-'.$row['city'].'-'.$row['state'].'-'.$row['zipcode'],	 
        $row[3],  
        $row[9], 
        date('m/d/Y', strtotime($date)).'-'.date('h:i A ', strtotime($datetime)),
        date('m/d/Y ', strtotime($date1)),
        date('h:i A ', strtotime($datetime1)),	 	
 		$activeCategories,
 		$button 		
 		); 	
		$i++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);