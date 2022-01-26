<?php
echo getCostDueToDistance(313);
function sendEmail($to,$subject,$content){
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($content,70);
    
    $headers = "From: info@skylineautoservices.co";

    mail($to,$subject,$msg,$headers);
}
function isEmailValid($email){
    include 'db_connect.php';
    $response=false;
    $sql = "SELECT * FROM customertbl WHERE email = '$email'";
    $result = $connect->query($sql);
    if($result->num_rows>0) {
        $response=true;
    }
    $connect->close();
    return $response;
}
function formatDate($date){
    $mysqldate = date('M-d-Y T h:i:s A', strtotime($date));
}
function getBookingStatus($id){
    include 'db_connect.php';
    $status=0;
    $sql = "SELECT `status` FROM `booking` WHERE  `id` = '$id'";
    $result = $connect->query($sql);
    if($result->num_rows>0) {
        while($row = $result->fetch_array()) {
            $status=$row['status'];  
         }	
    }
    $connect->close();
    return $status;
}
function getDistanceBetweenPoints($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'miles') {
    $theta = $longitude1 - $longitude2; 
    $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta))); 
    $distance = acos($distance); 
    $distance = rad2deg($distance); 
    $distance = $distance * 60 * 1.1515; 
    switch($unit) { 
      case 'miles': 
        break; 
      case 'kilometers' : 
        $distance = $distance * 1.609344; 
    } 
    return (round($distance,2)); 
}
function getCostDueToDistance($id){
    include 'db_connect.php';
    $lat1=0;
    $long1=0;
    $lat2=0;
    $long2=0;
    $cost=0;
    $sql = "SELECT `booking`.`latitude` as latStart,`booking`.`longitude` as longStart,`garagetbl`.`latitude`  as latEnd ,`garagetbl`.`longitude` as longEnd,pickcost FROM `booking`,`garagetbl`,`pickuprangetbl` WHERE  `booking`.`id` = '$id' and `booking`.`garage`=`garagetbl`.`name` and ranged='mile'";
    $result = $connect->query($sql);
    if($result->num_rows>0) {
        while($row = $result->fetch_array()) {
            $lat1=$row['latStart'];
            $long1=$row['longStart'];
            $lat2=$row['latEnd'];
            $long2=$row['longEnd'];
            $cost=$row['pickcost'];
         }	
    }
    $connect->close();
    return getDistanceBetweenPoints($lat1, $long1, $lat2, $long2,'miles')*$cost;
}
?>