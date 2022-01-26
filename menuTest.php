<?php 
    // Include the database config file 
    include_once 'dbConfig.php'; 
     
    // Fetch all the country data 
    $query = "SELECT * FROM countrytbl ORDER BY countryname ASC"; 
    $result = $db->query($query); 
?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"> 	
<form class="form-horizontal"  action="" method="post">
<div class="form-group">
<!-- Country dropdown -->
<select id="country" name="country"  class="form-control">
    <option value="">Select Country</option>
    <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['id'].'">'.$row['countryname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
    ?>
</select>
 </div>
  <div class="form-group">
        <!-- State dropdown -->
    <select id="state" name="state" class="form-control">
        <option value="">Select state</option>
    </select> 
  </div>

	  <div class="form-group">
    <!-- City dropdown -->
    <select id="city" name="city"  class="form-control">
        <option value="">Select city</option>
    </select>
	  </div>
    <input type="submit" name="submit" value="Submit"  class="form-control"/>
</form>
</div>
<?php 
if(isset($_POST['submit'])){ 
    echo 'Selected Country ID: '.$_POST['country']; echo "<br/>";
    echo 'Selected State ID: '.$_POST['state'];  echo "<br/>";
	$sql = "SELECT statename from statetbl WHERE id =".$_POST['state'];
	$result = $db->query($sql);
	if($result->num_rows > 0){  
    while($row = $result->fetch_assoc()){  
      echo 'Selected State Name is '.$row['statename']; echo "<br/>";
      } 
     } 
    echo 'Selected City name is: '.$_POST['city']; 
} 
?>


<script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>

<script>
$(document).ready(function(){
    $('#country').on('change', function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'country_id='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="">Select state first</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    $('#state').on('change', function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'state_id='+stateID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>