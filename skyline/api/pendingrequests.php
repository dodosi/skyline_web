<?php			       
	    //require_once 'php_action/core.php';
		include 'db_connect.php';
		$heroes = array();
		
		$sql = "SELECT `booking`.`id`, `fname`, `lname`, `booking`.`city`, `booking`.`state`, `booking`.`street`, `booking`.`zipcode`, 
		               `garagetbl`.`name`, `garagetbl`.`state`,`garagetbl`.`city`,`garagetbl`.`zip`,`garagetbl`.`street`, `pick_up_date`, `pick_up_time`
		        FROM `customertbl`,`booking`,`garagetbl` 
				WHERE `booking`.`email`=`customertbl`.`email` 
				  and `garagetbl`.`name`=`booking`.`garage` 
				  and `booking`.`status`=2 
				  GROUP BY  `booking`.`id` 
				  ORDER BY `booking`.`id`  DESC  LIMIT 30" ;	
		
	  // echo $sql;
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $fname,$lname,$ccity,$cstate,$cstreet,$czipcode,$gname,$gstate,$gcity,$gzipcode,$gstreet_number,$pick_up_date,$pick_up_time);
		
			//looping through all the records
			while($stmt->fetch()){
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'customer_firstname'=>$fname,
					'customer_lastname'=>$lname,
					'customer_state'=>$cstate,
					'customer_city'=>$ccity,
					'customer_street_number'=>$cstreet,
					'customer_zipcode'=>$czipcode,
					'garage_name'=>$gname,
					'garage_state'=>$gstate,
					'garage_city'=>$gcity,
					'garage_zipcode'=>$gzipcode,
					'garage_street_number'=>$gstreet_number,
					'pick_up_date'=>date( 'M-d-Y', strtotime($pick_up_date)),
					'pick_up_time'=>date( 'h:i A', strtotime($pick_up_time)),
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>