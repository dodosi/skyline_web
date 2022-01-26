<?php 	

require_once 'db_connect.php';

 $sql = "SELECT customertbl.id, customertbl.fname, customertbl.lname, customertbl.phone, customertbl.user_type, customertbl.email,customertbl.city,customertbl.zip_code,  customertbl.status FROM customertbl WHERE customertbl.user_type='Driver'";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[8] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-warning'>Pending</label>";
 	} 
	else if($row[8] == 2) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Approved</label>";
 	}else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Dismissed</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li>
		<li><a type="button" data-toggle="modal" id="editCategoriesModalBtn"  data-target="#editCategoriesModal"onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Approve/Dismiss</a></li>
	    <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Approve</a></li>
        <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Dismiss</a></li>--> 		
	  </ul> 
	</div>';

 	$output['data'][] = array( 		
 		$row[1],  
        $row[2], 
        $row[3], 
        $row[4], 
        $row[5], 
        $row[6], 
        $row[7], 	
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);