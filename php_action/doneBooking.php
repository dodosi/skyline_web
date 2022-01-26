<?php 	

require_once 'db_connect.php';


$valid['success'] = array('success' => false, 'messages' => array());

$categoriesId = $_POST['editCategoriesId'];
$bookID = $_POST['books'];
//die($categoriesId);
if($categoriesId) { 

 $sql = "UPDATE `bookassignment` SET `status`= 1 WHERE `id`= {$categoriesId}";

 if($connect->query($sql) === TRUE) {
         $sql1 = "UPDATE `booking` SET `status`= 5 WHERE `id`= {$bookID}";
         $connect->query($sql1);
 	$valid['success'] = true;
	$valid['messages'] = "Technical  assessment work done successfully " ;		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while completing the technical assessment work ";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST 