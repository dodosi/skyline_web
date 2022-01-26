<?php			       
	    //require_once 'php_action/core.php';
		include 'db_connect.php';
		$heroes = array();
		$email=addslashes($_POST['email']);
		//$sql = "SELECT `booking`.`id`, `serviceName`, `garage`, `make`, `model`, `plate_number`, `engine_number`, `car_color`, `description`, `pick_up_date`, `pick_up_time`,`book_date`,`book_time`, `latitude`, `longitude`, `booking`.`state`, `booking`.`city`, `booking`.`street`, `booking`.`zipcode`, `booking`.`email`,`comment`, `booking`.`status`,`token` 
		$sql = "SELECT `booking`.`id`, `serviceName`, `garage`,`garagetbl`.`state`,`garagetbl`.`city`,`garagetbl`.`zip`,`garagetbl`.`street`, `make`, `model`, `plate_number`, `engine_number`, `car_color`, `description`, `pick_up_date`, `pick_up_time`,`book_date`,`book_time`, `booking`.`latitude`, `booking`.`longitude`, `booking`.`state`,`booking`.`city`, `booking`.`street`, `booking`.`zipcode`, `booking`.`email`,`comment`, `booking`.`status`,`token`,`customertbl`.`phone` 
			FROM `booking`,`pick`,`customertbl`,`servicestbl`,`garagetbl`  
			WHERE `pick`.`request_id`=`booking`.`id`
			and  `customertbl`.`email`=`booking`.`email`
			and `pick`.`driver_email`='$email' 
			and `booking`.`service`=`servicestbl`.`servID`
			and `garagetbl`.`name`=`booking`.`garage`
			GROUP BY `booking`.`id` 
			ORDER BY `booking`.`id` DESC  LIMIT 30";	
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $service,$garage,$gstate,$gcity,$gzipcode,$gstreet_number,$make,$model,$plate_number,$engine_number,$car_color,$description,$pick_up_date,$pick_up_time,$book_date,$book_time,$latitude, $longitude,$state,$city,$street,$zip,$email,$comment,$status,$token,$phone);
		
		    //looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'service'=>$service,
					'garage'=>$garage,
					'garage_state'=>$gstate,
					'garage_city'=>$gcity,
					'garage_zipcode'=>$gzipcode,
					'garage_street_number'=>$gstreet_number,
					'make'=>$make,
					'model'=>$model,
					'plate_number'=>$plate_number,
					'engine_number'=>$engine_number,
					'car_color'=>$car_color,
					'description'=>$description,
					'pick_up_date'=>date( 'M-d-Y', strtotime($pick_up_date)),
					'pick_up_time'=>date( 'h:i A', strtotime($pick_up_time)),
					'book_date'=> date( 'M-d-Y', strtotime($book_date)),
					'book_time'=>date( 'h:i A', strtotime($book_time)),
				    'longitude'=>$longitude,
					'latitude'=>$latitude,
					'pickedAt'=>$pick_up_time,
					'email'=>$email,
					'state'=>$state,
					'city'=>$city,
					'street_number'=>$street,
					'zip_code'=>$zip,
					'comment'=>$comment,
					'status'=>$status,
					'token'=>$token
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>