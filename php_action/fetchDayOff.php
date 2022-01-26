<?php 	

require_once 'db_connect.php';
session_start();
$garageID = $_SESSION["garageID"];

//$sql = "SELECT id, categoryName, category_status, category_active FROM category WHERE category_active = 1";
//$sql = "SELECT `id`, `day`, `hourFrom`, `hourTo`, `garageID`, `status` FROM `workingdays` WHERE status = 1 AND garageID ={$garageID}";
$sql = "SELECT `id`, `fromDate`, `toDate`, `garageID`, `status` FROM `dayoff` WHERE garageID ={$garageID}";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $message = "";
 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[4] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Confirmed</label>";
		
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Not confirmed</label>";
 	}
	$d=$row[1];
	//$d = date("Y-M-d",$d);
	$d = date("m/d/Y h:i A ", strtotime($d));
	$d1=$row[2];
	//$d1 = date("Y-M-d",$d1);
	$d1 = date("m/d/Y h:i A ", strtotime($d1));
    //echo "Created date is " . date("Y-M-d", );
	
    $message = "<label class='label label-primary'>We have day off from ".$d. " to ".$d1."</label>";
 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtnD" data-target="#editCategoriesModal2" onclick="editCategories2('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal2" id="removeCategoriesModalBtnD" onclick="removeCategories2('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
	  </ul> 
	</div>';

 	$output['data'][] = array( 	
        //$row[0],
        $message,		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);