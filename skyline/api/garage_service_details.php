<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
        $service_id=addslashes($_POST['service_id']);
        $garage_id=addslashes($_POST['garage_id']);
		//$service='Lubricating doors';
		$heroes = array(); 	
			
		$sql = "SELECT `id`,`makeName`, `modelName`, `price` FROM `carmaketbl` WHERE `garageid`='$garage_id' and `status`='1'";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $make,$model,$price);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'name'=>$make,
					'make'=>$make,
					'model'=>$model,
					'price'=>$price
					
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>