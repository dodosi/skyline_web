<?php 	

require_once 'db_connect.php';

 //$sql = "SELECT partnertbl.id, partnertbl.fname, partnertbl.lname, partnertbl.phone1, partnertbl.phone2, partnertbl.email,partnertbl.city,partnertbl.regDate,  partnertbl.active FROM partnertbl WHERE partnertbl.user_type=4";

 $sql ="SELECT customertbl.id, `customertbl`.fname, customertbl.lname, customertbl.phone, customertbl.email,
customertbl.state, `rating`.`request_id`, AVG(rating.rate) as rating, rating.review
FROM `customertbl`
	, `pick`
	, `booking`
	, `rating`
    
    WHERE customertbl.user_type ='Driver' AND pick.request_id = booking.id AND rating.request_id = booking.id"; // 
 
				
				
 $result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row['rating'] > 2.5) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Well done</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Need improvement</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="fa fa-info-circle" aria-hidden="true"></i> Details</a></li>
		<!--<li><a type="button" data-toggle="modal" id="editCategoriesModalBtn"  data-target="#editCategoriesModal"onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Approve/Dismiss</a></li>
	    <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Approve</a></li>
        <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal1" id="removeCategoriesModalBtn1" onclick="removeCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Dismiss</a></li>--> 		
	  </ul> 
	</div>';

 	$output['data'][] = array( 		
 		$row['fname'],  
        $row['lname'], 
        $row['phone'], 
        $row['email'], 
        //$row['request_id'], 
        $row['rating'], 
        //$row['review'], 	
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);