<?php 	

require_once 'db_connect.php';

//$sql = "SELECT id, categoryName, category_status, category_active FROM category WHERE category_status = 1";
//$sql = "SELECT `garageID`, `Name`, `Email`, `Websitelink`, `phone`, `garage_thumbnail`, `working_hourID`, `working_dayID`, `status`, `active` FROM `garagetbl` WHERE status= 1";
$sql = "SELECT `id`, `fname`, `lname`, `phone`, `email`, `street_number`,`city`, `state`,`zip_code`, `status`,`active` FROM `customertbl` WHERE user_type ='customer'";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row[9] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Unblocked</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Blocked</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu"> 
		 <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')">  &nbsp;<i class="fa fa-info-circle" aria-hidden="true"></i>  Details</a></li>
		 <li><a type="button" data-toggle="modal" data-target="#editCategoriesModal" id="editCategoriesModalBtn" onclick="editCategories('.$categoriesId.')"> <i class="fa fa-unlock" aria-hidden="true"></i> Unblock/Block</a></li>
		 <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="fa fa-unlock" aria-hidden="true"></i> Unblock</a></li>
	         <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModalC" id="removeCategoriesModalBtnC" onclick="removeCategories1('.$categoriesId.')"> <i class="fa fa-lock" aria-hidden="true"></i> Block</a></li>-->       
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