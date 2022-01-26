<?php 
// Include the database config file 
include_once 'dbConfig.php'; 
 
if(!empty($_POST["country_id"])){ 
    // Fetch state data based on the specific country 
    $query = "SELECT * FROM statetbl WHERE countryid = 1 ORDER BY statename ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of state options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select State</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['statename'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">State not available</option>'; 
    } 
}elseif(!empty($_POST["state_id"])){ 
    // Fetch city data based on the specific state 
    $query = "SELECT * FROM citytbl WHERE stateid = ".$_POST['state_id']." ORDER BY cityname ASC"; 
    $result = $db->query($query); 
     
    // Generate HTML of city options list 
    if($result->num_rows > 0){ 
        echo '<option value="">Select city</option>'; 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['cityname'].'">'.$row['cityname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">City not available</option>'; 
    } 
} 
?>