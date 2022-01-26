<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
	    $email=addslashes($_POST['email']);
		//$service='Lubricating doors';
	    $heroes = array(); 				
		$sql = "SELECT  `fname`, `lname`, `phone`, `email`,`street_number`, `city`, `state`, `zip_code` FROM `customertbl` WHERE `email`='$email' LIMIT 1";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($firstname, $lastname,$phone,$email,$street_number,$city,$state,$zip_code);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'firstname'=>$firstname,
					'lastname'=>$lastname,
					'phone'=>$phone,
					'email'=>$email,
					'street_number'=>$street_number,
					'city'=>$city,
					'zip_code'=>$zip_code,
					'state'=>$state
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>