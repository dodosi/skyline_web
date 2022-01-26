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
   $sql="SELECT `id`, `name`, `doc_type`, `date`, `email` FROM `documents`  WHERE `email`='$email'";
   $result = $connect->query($sql);
   if($result->num_rows > 0) { 
    while($row = $result->fetch_array()) {
       $response=$row['name'];  
    }						
 }
 $connect->close();
}
echo $response;
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
