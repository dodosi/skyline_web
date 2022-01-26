<?php			       
	//require_once 'php_action/core.php';
		include 'db_connect.php';
		//$phone=addslashes($_REQUEST['phone']);
		$id=addslashes($_POST['id']);
	
		$heroes = array(); 	
		$totalTax=array();
			
		$sql = "SELECT `order_item_id`, `item_name`, `order_item_final_amount`,`order_total_tax` FROM `invoice_order_item`,`invoice_order` 
		 WHERE  `invoice_order_item`.`order_id`=`invoice_order`.`order_id`
		 and `invoice_order`.`bookingId`='$id'";
	   // echo $sql; 								 
		//$result = $connect->query($sql);
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id,$title,$amount,$tax);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'title'=>$title,
					'amount'=>$amount
				 ];
				 $totalTax = [
					'id'=>$id,
					'title'=>'Tax',
					'amount'=>$tax
         		];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
			array_push($heroes, $totalTax);
		$connect->close();
	
	echo json_encode($heroes);
?>