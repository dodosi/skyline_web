<?php 	

require_once 'db_connect.php';
session_start();
$garageID = $_SESSION["garageID"];

//$sql = "SELECT id, categoryName, category_status, category_active FROM category WHERE category_active = 1";
$sql = "SELECT `id`, `day`, `hourFrom`, `hourTo`, `garageID`, `status` FROM `workingdays` WHERE  garageID ={$garageID}";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[5] == 1) {
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
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtnDS" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtnDS" onclick="removeCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul> 
	</div>';

 	$output['data'][] = array( 	
        //$row[4],
        //$_SESSION["garageID"],		
 		$row[1],
        date("h:i A ", strtotime($row[2])),
        date("h:i A ", strtotime($row[3])),		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);