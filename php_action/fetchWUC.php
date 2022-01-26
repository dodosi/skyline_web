<?php 	

require_once 'db_connect.php';

$sql = "SELECT categories_id, staff_fname, staff_lname, staff_username, staff_email, staff_phone, staff_region, categories_active, categories_status FROM staff_tbl WHERE categories_status = 1";
$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[7] == 1) {
 		// activate member
 		$activeCategories = "<label class='badge badge-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='badge badge-danger'>Not Available</label>";
 	}
	 
 	// active 
 	if($row[6] == 1) {
 		// activate member
 		$region = "<label class='badge badge-success'>Musanze</label>";
 	} else {
 		// deactivate member
 		$region = "<label class='badge badge-danger'>Nyamagabe</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal"  class="btn btn-success" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal"  class="btn btn-danger" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul>
	</div>';

 	$output['data'][] = array( 		
 		$row[1],
        $row[2], 
        $row[3],
        $row[4],
        $row[5],
        $region,     		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);