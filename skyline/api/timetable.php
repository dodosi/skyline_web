<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
        $garage_id=addslashes($_POST['garage_id']);
		//$service='Lubricating doors';
		$heroes = array(); 	
			
		$sql = "SELECT `id`, `day`, `hourFrom`, `hourTo` FROM `workingdays` WHERE `garageID`='$garage_id' and status=1";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $day,$start,$end);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
                    'id'=>$id,
                    'day'=>$day,
					'start'=>date( 'h:i A', strtotime($start)),
					'end'=>date( 'h:i A', strtotime($end))
					
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>