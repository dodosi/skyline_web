<?php			       
	    //require_once 'php_action/core.php';
		
		$heroes = array();
		if($_POST) {		
        $request_id = $_POST['id'];
        include 'db_connect.php';
		$sql = "SELECT  `movements`.`id` as id, `email`, `request_id`, `movements`.`type`, `start_time`, `end_time`,TIMESTAMPDIFF(MINUTE,`start_time`,`end_time`) as duration ,`pickcost`
                FROM `movements`,`pickuprangetbl`
		        WHERE `request_id`='$request_id'  and  `ranged`='minute' GROUP BY `id`";
				  
		
	    // echo $sql;
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $email,$request_id,$type,$start,$end,$duration,$unitPrice);
		
			//looping through all the records
			while($stmt->fetch()){
			//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'email'=>$email,
					'request_id'=>$request_id,
					'type'=>$type,
					'start'=>date( 'M-d-Y h:i A', strtotime($start)),
					'end'=>date( 'M-d-Y h:i A', strtotime($end)),
					'duration'=>$duration,
					'unit_price'=>$unitPrice
				];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
        }
	echo json_encode($heroes);
?>