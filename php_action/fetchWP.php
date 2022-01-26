<?php 	

require_once 'db_connect.php';

$sql = "SELECT categories_id, categories_name,wss_ID, region_ID, categories_active, categories_status FROM water_point_tbl WHERE categories_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
	if($row[2] == 12) {
 		// activate member
 		$wss = "<label class='badge badge-success'>Rwagasangwe</label>";
 	}
	 
	else if($row[2] == 2) {
		$wss = "<label class='badge badge-success'>Kamiranzovu</label>";
	}
	else {
 		// deactivate member
 		$wss = "<label class='badge badge-danger'>Ivomo</label>";
 	}
 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$activeCategories = "<label class='badge badge-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='badge badge-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal"  class="btn btn-success" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="fa fa-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal"  class="btn btn-danger" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="fa fa-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1], 
        $wss,
        $row[3],   		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);