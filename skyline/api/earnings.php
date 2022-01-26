<?php			       
	    //require_once 'php_action/core.php';
		$heroes = array();
        $mysum=0;
		$cost=0;
		if($_POST) {		
        $request_id = $_POST['id'];
        $startDate=$_POST['start_date'];
        $endDate=$_POST['end_date'];
        $email=$_POST['email'];
        include 'db_connect.php';
		$sql = "SELECT ABS(TIME_TO_SEC(timediff(`start_time`, `end_time`))/60) as SUM,`pickcost` FROM `movements`,`pickuprangetbl` 
                WHERE  (DATE(`start_time`) BETWEEN '$startDate' AND '$endDate') and  (DATE(`end_time`) BETWEEN '$startDate' AND '$endDate')
				 and email='$email'  and ranged='minute'";
		if($startDate==$endDate){
		$sql = "SELECT ABS(TIME_TO_SEC(timediff(`start_time`, `end_time`))/60) as SUM,`pickcost` FROM `movements`,`pickuprangetbl` 
		    	WHERE DATE(`start_time`)='$startDate' and DATE(`end_time`)='$endDate' and email='$email' and ranged='minute'";
      	}		  
		
	    // echo $sql;
		$stmt = $connect->prepare($sql);
		$stmt->execute();
		$stmt->bind_result($sum,$pickcost);
		
			//looping through all the records
		while($stmt->fetch()){
			//pushing fetched data in an array 
              $mysum+=$sum;
			  $cost=$pickcost;
			}
		$temp = ['total_time'=>$mysum,
		       'total_earning'=>$cost*$mysum];	
		$connect->close();
        }
	echo json_encode($temp);
?>