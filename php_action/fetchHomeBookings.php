<?php 	

require_once 'db_connect.php';

$sql ="SELECT `booking`.id, `servicestbl`.serviceName, `booking`.garage, `booking`.make, `booking`.model, 
`booking`.plate_number, `booking`.car_color, `booking`.pick_up_date, 
`booking`.pick_up_time, `booking`.email,`booking`.status, booking.book_date, booking.book_time
 FROM `booking`, `servicestbl` WHERE `booking`.service = `servicestbl`.servID   ORDER BY pick_up_date DESC LIMIT 15";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
	//$d ='';
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
 		$activeCategories = "<label class='label label-warning'>Pro forma done</label>";
 	}elseif($row[10] == 7) {
 		// deactivate member
 		$activeCategories = "<label class='label label-info'>Pro forma Accepted</label>";
 	}elseif($row[10] == 8) {
 		// deactivate member
 		$activeCategories = "<label class='label label-default'>Pro forma Rejected</label>";
 	}elseif($row[10] == 9) {
 		// deactivate member
 		$activeCategories = "<label class='label label-success'>Booking Done</label>";
 	}else{
		// deactivate member
 		$activeCategories = "<label class='label label-default'>Booking Rejected</label>";
	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Details</a></li> 
	     <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> View invoice</a></li>       
	  </ul> 
	</div>';
        $date  = $row[7];
        $datetime  = $row[8];
        $date1  = $row[11];
        $datetime1  = $row[12];
        //$date = new DateTime($d);
 	$output['data'][] = array(  	
        $row[9],  
 		$row[1],  
        $row[2], 
        $row[3].'-'.$row[4], 
        $row[6], 
        date('m/d/Y', strtotime($date)),
        date('h:i A', strtotime($datetime)), 
        date('m/d/Y', strtotime($date1)),	
        date('h:i A', strtotime($datetime1)), 		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);