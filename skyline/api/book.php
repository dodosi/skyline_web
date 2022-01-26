<?php 	
$response='FAILED';
if($_POST) {
	require_once 'db_connect.php';
    $service = addslashes($_POST['service']);
	$garage = addslashes($_POST['garage']);
	$model = addslashes($_POST['model']);
	$make = addslashes($_POST['make']);
	$plate_number = addslashes($_POST['plate_number']);
	$engine_number = addslashes($_POST['engine_number']);
	$car_color=addslashes($_POST['car_color']);
	$description=addslashes($_POST['description']);
	$pick_up_date=addslashes($_POST['pickup_date']);
	$pick_up_time=addslashes($_POST['pickup_time']);
	$pick_up_time=date("H:i", strtotime($pick_up_time));
	$book_date=addslashes($_POST['book_date']);
	$book_time=addslashes($_POST['book_time']);
	$book_time=date("H:i", strtotime($book_time));
	$latitude=addslashes($_POST['latitude']);
	$longitude=addslashes($_POST['longitude']);
	$email=addslashes($_POST['email']);
	$streetNumber=addslashes($_POST['street_number']);
	$city=addslashes($_POST['city']);
	$state=addslashes($_POST['state']);
	$zipcode=addslashes($_POST['zip_code']);
	 
		$sql="INSERT INTO `booking`(`service`,`garage`,`make`,`model`, `plate_number`, `engine_number`, `car_color`, `description`, `pick_up_date`, `pick_up_time`,`book_date`, `book_time`,`latitude`,`longitude`,`email`, `state`, `city`, `street`, `zipcode`,`status`) 
		                    VALUES ('$service','$garage','$make','$model','$plate_number','$engine_number','$car_color','$description','$pick_up_date','$pick_up_time','$book_date','$book_time','$latitude','$longitude','$email','$state','$city','$streetNumber','$zipcode','1')";
		if($connect->query($sql) === TRUE) {
				$response='ok';
				
		} else {
				
		}
	$connect->close();

	echo $response;
 
} // /if $_POST
?>