<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $fname=$lname=$phone1=$phone2=$street=$city=$state=$zip=$company=$regDate=$password = $confirm_password = "";
$email_err = $fname_err =$lname_err =$phone1_err =$phone2_err =$street_err =$city_err =$zip_err =$state_err =$company_err =$date_err =$password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter an email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM partnertbl WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already taken.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
	
	    // Validate fname
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter a fname.";     
    } elseif(strlen(trim($_POST["fname"])) < 3){
        $fname_err = "Fname must have atleast 3 characters.";
    } else{
        $fname = trim($_POST["fname"]);
    }
	
	    // Validate lname
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter a lname.";     
    } elseif(strlen(trim($_POST["lname"])) < 3){
        $lname_err = "Lname must have atleast 3 characters.";
    } else{
        $lname = trim($_POST["lname"]);
    }
	
	    // Validate phone 1
    if(empty(trim($_POST["phone1"]))){
        $phone1_err = "Please enter a phone 1.";     
    } elseif(strlen(trim($_POST["phone1"])) < 3){
        $phon1_err = "Phon1 must have atleast 3 characters.";
    } else{
        $phone1 = trim($_POST["phone1"]);
    }
	    // Validate phone 2
      $phone2 = trim($_POST["phone2"]);
	  
	  // Validate reg date
      $regDate = trim($_POST["regDate"]);
	  
	  // Validate user 
    if(empty(trim($_POST["user"]))){
        $user_err = "Please enter a user."; 
    } else{
        $user_role = trim($_POST["user"]);
    }
	
		    // Validate street
    if(empty(trim($_POST["street"]))){
        $street_err = "Please enter a street.";      
    } else{
        $street = trim($_POST["street"]);
    }
	
		    // Validate city
    if(empty(trim($_POST["city"]))){
        $city_err = "Please enter a city.";      
    } else{
        $city = trim($_POST["city"]);
    }
	
		    // Validate city
    if(empty(trim($_POST["state"]))){
        $state_err = "Please enter a state.";      
    } else{
        $state = trim($_POST["state"]);
    }
	
		    // Validate Company
    if(empty(trim($_POST["company"]))){
        $company_err = "Please enter company picture.";   
    } else{
        $company = trim($_POST["company"]);
    }
	
		    // Validate Zip
    if(empty(trim($_POST["zip"]))){
        $zip_err = "Please enter a zip.";     
    } elseif(strlen(trim($_POST["zip"])) < 3){
        $zip_err = "Zip must have atleast 3 characters.";
    } else{
        $zip = trim($_POST["zip"]);
    }
	  
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    } 
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        echo $sql = "INSERT INTO partnertbl (fname, lname, phone1, phone2, email, password, street, city, state, zip, company_pic,user_type, active) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //die("2end Etape");
        if($stmt = mysqli_prepare($link, $sql)){
			
			echo $sql;
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssssssssii", $param_fname, $param_lname, $param_phone1, $param_phone2, $param_email, $param_password, $param_street, $param_city, $param_state, $param_zip, $param_company, $param_user, $param_active);
            
            // Set parameters
            $param_fname = $fname;
			$param_lname = $lname;
			$param_phone1 = $phone1;
			$param_phone2 = $phone2;
			$param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
			$param_street = $street;
			$param_city = $city;
			$param_state = $state;
			$param_zip = $zip;
			$param_company = $company;
			$param_regD = $regDate;
			$param_user = $user_role;
			$param_active = 0;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login-page.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
		echo "Wrong ".mysqli_error($link);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skyline-Web App</title>
    <meta name="description" content="Skyline-Web App">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/logo2.png">
    <link rel="shortcut icon" href="images/logo2.png"> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	
    <style type="text/css">
	    .login-content{
			argin-left: auto;
  margin-right: auto;
		}
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;   margin-left: auto;
  margin-right: auto;}
    </style>
</head>
<body> 

 <div class="container">       
    <div class="wrapper">
	<div class="login-content">
                <div class="login-logo">
                    <a href="index.php">
                        <img class="align-content" src="images/skyline-logo3.png" width="90%" height="85%" alt=""/>
                    </a>
                </div>
			</div> 
        <h3>Registration</h3>
		<hr/>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		    <div class="form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
                <label>First name</label>
                <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                <span class="help-block"><?php echo $fname_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
                <label>Last name</label>
                <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                <span class="help-block"><?php echo $lname_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($phone1_err)) ? 'has-error' : ''; ?>">
                <label>1st Phone</label>
                <input type="text" name="phone1" class="form-control" value="<?php echo $phone1; ?>">
                <span class="help-block"><?php echo $phone1_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($phone2_err)) ? 'has-error' : ''; ?>">
                <label>2nd Phone</label>
                <input type="text" name="phone2" class="form-control" value="<?php echo $phone2; ?>">
                <span class="help-block"><?php echo $phone2_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>
			<div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                <label>Street</label>
                <input type="text" name="street" class="form-control" value="<?php echo $street; ?>">
                <span class="help-block"><?php echo $street_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                <label>City</label>
                <input type="text" name="city" class="form-control" value="<?php echo $city; ?>">
                <span class="help-block"><?php echo $city_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                <label>State</label>
                <input type="text" name="state" class="form-control" value="<?php echo $state; ?>">
                <span class="help-block"><?php echo $state_err; ?></span>
            </div> 
            <div class="form-group <?php echo (!empty($zip_err)) ? 'has-error' : ''; ?>">
                <label>Zip code</label>
                <input type="text" name="zip" class="form-control" value="<?php echo $zip; ?>">
                <span class="help-block"><?php echo $zip_err; ?></span>
            </div> 
			<div class="form-group <?php echo (!empty($company_err)) ? 'has-error' : ''; ?>">
                <label>Company Picture</label>
                <input type="file" name="company" class="form-control" value="<?php echo $company; ?>">
                <span class="help-block"><?php echo $company_err; ?></span>
            </div>

			
			<div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
			  <label for="regDate">Registration Date</label>
             <input type="date" class="form-control" id="regDate" name="regDate"> 
			</div>
			<div class="form-group <?php echo (!empty($user_err)) ? 'has-error' : ''; ?>">
			  <label for="user">User role</label>
			  <select name="user" class="form-control">
			    <option value="">Select your role</option> 
			    <option value="2">Partner</option> 
			  </select>
              </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login-page.php">Login here</a>.</p>
        </form>
		</div>
		<hr/>
		<footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2020 Skyline
                    </div> 
                    <div class="col-sm-6 text-right">
                        Designed by <a href="#">Starmanager</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>    
</body>
</html>