<?php 	
session_start();
$garageID = $_SESSION["garageID"];

require_once 'db_connect.php';

//$sql = "SELECT id, provider_ID, service_ID, status FROM serviceprovider";
//$sql = "SELECT serviceprovider.id, garagetbl.Name, servicestbl.serviceName,category.categoryName, serviceprovider.status FROM servicestbl, category, garagetbl, serviceprovider WHERE serviceprovider.provider_ID = garagetbl.garageID AND  garagetbl.garageID= {$garageID} AND servicestbl.servID = serviceprovider.service_ID AND servicestbl.serviceCategory = category.id AND garagetbl.status = 1";
$sql = "SELECT serviceprovider.id, garagetbl.Name, servicestbl.serviceName,category.categoryName, serviceprovider.status,servicestbl.status FROM servicestbl, category, garagetbl, serviceprovider WHERE serviceprovider.provider_ID = garagetbl.garageID AND  garagetbl.garageID= {$garageID} AND servicestbl.servID = serviceprovider.service_ID AND servicestbl.serviceCategory = category.id AND servicestbl.status = 1 AND servicestbl.active =1 GROUP BY serviceprovider.service_ID";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[4] == 1) {
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
		<!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"> <i class="fa fa-key"></i> Activate</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Disactivate</a></li> -->      
	  </ul> 
	</div>';

 	$output['data'][] = array( 		
 		//$row[1],
		$row[2], 
        $row[3],   		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);