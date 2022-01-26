<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
		$service=addslashes($_POST['service']);
		$service_id=addslashes($_POST['service_id']);
		$state=addslashes($_POST['state']);
		$city=addslashes($_POST['city']);
		//$service='Lubricating doors';
		$heroes = array(); 	
			
		$sql = "SELECT `garageID`, `Name`, `Email`, `Websitelink`, `phone`, `garage_thumbnail`, `state`, `city`, `street`, `zip`, `latitude`, `longitude` FROM `garagetbl`,`serviceprovider`	
		        WHERE `service_id`='$service_id' and `provider_id`=`garageid` and `city`='$city' and `state`='$state' and `garagetbl`.`status`='1' GROUP BY `garageID` ";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $name,$email,$website,$phone,$imageUrl,$state,$city,$street,$zip,$latitude,$longitude);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'name'=>$name,
					'latitude'=>$longitude,
					'longitude'=>$latitude,
					'email'=>$email,
					'website'=>$website,
					'state'=>$state,
					'city'=>$city,
					'street'=>$street,
					'zip'=>$zip,
					'phone'=>$phone,
					'imageUrl'=>$imageUrl
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>