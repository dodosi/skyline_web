<?php 	

require_once 'db_connect.php';

 $sql = "SELECT partnertbl.id, partnertbl.fname, partnertbl.lname, partnertbl.phone1, partnertbl.phone2, partnertbl.email,partnertbl.state,partnertbl.city,partnertbl.regDate, garagetbl.Name,partnertbl.user_type, partnertbl.active FROM partnertbl,garagetbl  WHERE partnertbl.garageID = garagetbl.garageID";
$result = $connect->query($sql);

$output = array('data' => array());
//print "HERE YOU GO";
if($result->num_rows > 0) { 

 // $row = $result->fetch_array();
 $activeCategories = ""; 
 $user = ""; 

 while($row = $result->fetch_array()) {
 	$categoriesId = $row[0];
 	// active 
 	if($row['user_type'] == 1) {
 		// activate member
 		$user = "<label class='label label-warning'>Garage Admin</label>"; 
 	} else if($row['user_type'] == 2) {
 		// deactivate member
 		$user = "<label class='label label-info'>Garage Tech</label>";
 	} 
	
	if($row['active'] == 1) {
 		// activate member
 		$activeCategories = "<label class='label label-success'>Approved</label>";
 	} else {
 		// deactivate member
 		$activeCategories = "<label class='label label-danger'>Not approved</label>";
 	}

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Action <span class="caret"></span>
	  </button>
	   <ul class="dropdown-menu">
	    <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-edit"></i> Details</a></li>
		<li><a type="button" data-toggle="modal" id="editCategoriesModalBtn1" data-target="#editCategoriesModal1" onclick="editCategories1('.$categoriesId.')"> <i class="glyphicon glyphicon-check"></i> Approve/Dismiss</a></li>
	    <!--<li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Approve</a></li>
        <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModalP" id="removeCategoriesModalBtnP" onclick="removeCategoriesP('.$categoriesId.')"> <i class="glyphicon glyphicon-trash"></i> Dismiss</a></li>--> 		
	  </ul> 
	</div>';

 	$output['data'][] = array( 		
 	    $row['fname'],  
        $row['lname'], 
        $row['phone1'], 
        $row['phone2'], 
        $row['email'], 
        $row['state'],  
        $row['city'],  
        date("m/d/Y", strtotime($row['regDate'])), 
        $row['Name'],   
        $user,		
 		$activeCategories,
 		$button 		
 		); 	
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);