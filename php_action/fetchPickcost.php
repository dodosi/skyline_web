<?php 	

require_once 'db_connect.php';

$sql = "SELECT `id`, `pickcost`,`ranged`, `date` FROM `pickuprangetbl` WHERE 1";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[0] == 1) {
 		// activate member
 		$activeCategories = "<label class='badge badge-success'>Unblocked</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='badge badge-danger'>Blocked</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>        
	  </ul> 
	</div>';

 	$output['data'][] = array( 
        $row[1], 
        $row[2],
        $row[3],		
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);