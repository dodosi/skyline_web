<?php
$response='NA';
if($_POST){
   require_once 'db_connect.php';
   $email='';
   if(isset($_POST['id'])){
      $id=$_POST['id'];
      $email=getEmailById($id);
   }
   if(isset($_POST['email'])){
      $email=$_POST['email'];
   }
   $heroes = array(); 	
   $sql = "SELECT  `fname`, `lname`, `phone`, `email`,`street_number`, `city`, `state`, `zip_code` FROM `customertbl` WHERE `email`='$email' LIMIT 1";
   // echo $sql; 								 
    //$result = $connect->query($sql);
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $stmt->bind_result($firstname, $lastname,$phone,$email,$street_number,$city,$state,$zip_code);
    
        //looping through all the records
        while($stmt->fetch()){
            //pushing fetched data in an array 
            $temp = [
                'firstname'=>$firstname,
                'lastname'=>$lastname,
                'phone'=>$phone,
                'email'=>$email,
                'street_number'=>$street_number,
                'city'=>$city,
                'zip_code'=>$zip_code,
                'state'=>$state
             ];
            
            //pushing the array inside the hero array 
            array_push($heroes, $temp);
        }
    $connect->close();
 echo json_encode($heroes);
 $connect->close();
}
function getEmailById($id){
   $email='';
   include 'db_connect.php';
   $sql="SELECT `id`, `request_id`, `driver_email`, `date` FROM `pick` WHERE `request_id`='$id'";
   $result = $connect->query($sql);
   if($result->num_rows > 0) { 
    while($row = $result->fetch_array()) {
       $email=$row['driver_email'];  
    }						
 }
 $connect->close();
 return $email;
}
?>
