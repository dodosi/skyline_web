<?php 	

require_once 'db_connect.php';
session_start();
$garageID = $_SESSION["garageID"];

//$sql = "SELECT id, categoryName, category_status, category_active FROM category WHERE category_active = 1";
//$sql = "SELECT `id`, `day`, `hourFrom`, `hourTo`, `garageID`, `status` FROM `workingdays` WHERE status = 1 AND garageID ={$garageID}";
$sql = "SELECT `id`, `makeName`, `modelName`, `garageID`, `status` FROM `carmaketbl` WHERE garageID ={$garageID}";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $i= 1;
 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Available</label>";
		
 	}
    if($row[4] == 0) {
 		// activate member
 		$activeCategories = "<label class='label label-warning'>Not Available</label>";
		
 	}
	if($row[4] == 2) {
 		// activate member
 		$activeCategories = "<label class='label label-danger'>Archived</label>";
		
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
	    $i,
        //$row[0],	
 		$row[1],
        $row[2],  		
 		$activeCategories,
 		$button 		
 		); 
        $i++;		
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);