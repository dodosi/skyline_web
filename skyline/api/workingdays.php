<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
		$id=addslashes($_POST['id']);
	
		$heroes = array(); 	
			
		$sql = "SELECT `garageID`, `Name`, `Email`, `Websitelink`, `phone`, `garage_thumbnail`, `state`, `city`, `street`, `zip`, `latitude`, `longitude` FROM `garagetbl`,`serviceprovider`	
		        WHERE `service_id`='$service_id' and `provider_id`=`garageid` and `city`='$city' and `state`='$state' and `status`='1'";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$title,$amount);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'title'=>$title,
					'amount'=>$amount,
					
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>