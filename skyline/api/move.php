<?php
$response="FAILED";
if($_POST) {
    include 'db_connect.php';	
    $email = addslashes($_POST['email']);
    $type=addslashes($_POST['action']);
    $request_id=addslashes($_POST['id']);
    $t=time();
    $start_time=date("Y-m-d h:i",$t);
    $end_time=date("Y-m-d h:i",$t);
    if($type=='START'){
        $sql = "SELECT id,request_id FROM `pick` WHERE `driver_email` = '$email' and `request_id`='$request_id' ORDER BY `id` DESC LIMIT 1";
        $result = $connect->query($sql);
        if($result->num_rows > 0) { 
                    //$row = $result->fetch_row();
                    $sql = "SELECT `id` FROM `movements` WHERE `email` = '$email' and `mode`=1 ";
                    $result = $connect->query($sql);
                    if($result->num_rows == 0) { 
                        $sql="INSERT INTO `movements`( `email`, `request_id`, `type`, `start_time`, `end_time`,`mode`) 
                                              VALUES ('$email','$request_id','$type','$start_time','$end_time','1')";
                        
                        if($connect->query($sql) === TRUE){
                           $response="ok";
                        } 
                    }
                    
            
        }
       
  }else{
        $sql = "SELECT `id` FROM `movements` WHERE `email` = '$email' and `mode`=1 ORDER BY `id` DESC LIMIT 1";
        $result = $connect->query($sql);
        if($result->num_rows > 0) { 
                    $row = $result->fetch_row();
                    $id=$row[0];
                    $sql="UPDATE `movements` SET `end_time`='$end_time',`mode`=2 WHERE id=$id"; 
                    if($connect->query($sql) === TRUE){
                       $response="ok";
                    } 
               
        }
     }
    $connect->close();  
}
echo $response;
?>