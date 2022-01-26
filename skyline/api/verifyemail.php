<?php
$response="FAILED";
if(isset($_GET['code'])) {
    include 'db_connect.php';	
    $token = addslashes($_GET['code']);
    $sql = "SELECT `email` FROM `password_reset_tokens` WHERE  `token`='$token'  ORDER BY `id` DESC LIMIT 1";
    echo $sql;
    $result = $connect->query($sql);
		if($result->num_rows > 0) { 
			while($row = $result->fetch_array()) {
                $email=$row['email'];
                $sql="UPDATE `customertbl` SET `status`='2' WHERE `email`='$email'";
                echo $sql;
                if($connect->query($sql) === TRUE){
                    $sql2="DELETE FROM `password_reset_tokens` WHERE `email`='$email'";
                    $connect->query($sql2);
                    $response="ok";
                } 
			} 

        } // if num_rows
        else{
            echo 'no data';
        }

	$connect->close();
 }
echo $response;
?>