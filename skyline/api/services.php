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
			
		$sql = "SELECT `servID`, `serviceName` FROM `servicestbl` WHERE `active`='1' and `status`='1'";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $name);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'name'=>$name,
					];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		$connect->close();
	
	echo json_encode($heroes);
?>