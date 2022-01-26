<?php			       
	//require_once 'php_action/core.php';
	include 'db_connect.php';
	$from=addslashes($_REQUEST['source']);
	$destination=addslashes($_REQUEST['destination']);
	$journey=$from.'-'.$destination;
	$bookdate=addslashes($_REQUEST['date']);
	$today=getTodayDate();
	//create time 20 min before time
	$time='0:0';
	//echo $today;
	$heroes = array(); 				
	if($today==$bookdate){
		$time=getCurrentTime();
		//echo $time;
	}
	if($today<=$bookdate){
		
		$sql = "SELECT `id`, `agency`,`journey`, `price`,`date`,`ticket_number` as ticket,`time`, `status` FROM `tickets` 
					WHERE `journey`='$journey' and `time`>'$time' and `date`='$bookdate' and status=1";
		if($today<$bookdate){
			$sql = "SELECT `id`, `agency`,`journey`, `price`,`date`,`ticket_number` as ticket,`time`, `status` FROM `tickets` 
					WHERE `journey`='$journey' and `date`='$bookdate' and status=1";
					       	
	}
	
		//echo $sql; 								 
		//$result = $connect->query($sql);
		$percentage=getServiceFeePercentage();
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($id, $agency,$journey,$price,$date,$ticket_number,$time,$status);
		
			//looping through all the records
			while($stmt->fetch()){
				
				//pushing fetched data in an array 
				$temp = [
					'id'=>$id,
					'agency'=>$agency,
					'journey'=>$journey,
					'price'=>$price,
					'service_fee'=>$price*$percentage/100,
					'date'=>$date,
					'time'=>$time,
					'ticket_number'=>$ticket_number,
					'status'=>$status
					
				];
				
				//pushing the array inside the hero array 
				array_push($heroes, $temp);
			}
		
			   $connect->close();
	}else{
		//echo 'Invalid date';
	}
	echo json_encode($heroes);

function getFinalDate(){
	$t=time();
	$date1=date("G:i:s",$t);
	$date=date_create($date1);
	date_add($date,date_interval_create_from_date_string("20 min"));
	$finaldate=date_format($date,"G:i:s");
	return $finaldate;
}

function getCurrentTime(){
	/*
	$t=time()+(2*60*60);//time difference to gmt
	$date=date("Y-m-d G:i:s",$t);
	$date1=date_create($date);
	date_add($date1,date_interval_create_from_date_string("20 min"));
	//$finaldate=date_format($date1,"Y-m-d G:i:s");
	$finaldate=date_format($date1,"G:i");
	*/
	$offset=(2*60*60)+(20*60); //converting 2 hours to seconds.
    $dateFormat="H:i";
    $finaldate=gmdate($dateFormat, time()+$offset);

	return $finaldate;						
}
function getTodayDate(){
	/*$t=time();
	$date1=date("Y-m-d G:i:s",$t);
	$date=date_create($date1);
	$mydate=date_format($date,"Y-m-d");
	*/
	//echo 'My Date '.$mydate.'<br>';
	$offset=2*60*60; //converting 5 hours to seconds.
	$dateFormat="Y-m-d";
	$mydate=gmdate($dateFormat, time()+$offset);
	return $mydate;
}
function getServiceFeePercentage(){
	include '../php_action/db_connect.php';
	//get number of sits left
	 $sql="SELECT `fee_percentage` FROM `settings` WHERE 1 LIMIT 1";
	 $result = $connect->query($sql);
	 $percentage=10;
	 while($row = $result->fetch_array()) {
		$percentage=$row['fee_percentage'];
	 }
	 $connect->close();
	return $percentage;
}
?>