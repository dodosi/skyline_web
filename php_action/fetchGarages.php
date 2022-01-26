<?php 	

require_once 'db_connect.php';

//$sql = "SELECT id, categoryName, category_status, category_active FROM category WHERE category_status = 1";
$sql = "SELECT `garageID`, `Name`, `Email`, `Websitelink`, `phone`, `garage_thumbnail`, `state`, `city`,`street`,`zip`,`working_dayID`, `status`, `active` FROM `garagetbl` WHERE active= 1";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[11] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Available</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Not Available</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul> 
	</div>';

 	$output['data'][] = array( 
        //'<p> <img src="images/'.$row[5].'" alt="Logo" class="img-thumbnail" width="100%" height="100%"></p>',	
 		$row[1],  
        $row[2], 
        $row[3], 
        $row[4], 
        $row[6], 
        $row[7],
        $row[8],
        $row[9], 		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);