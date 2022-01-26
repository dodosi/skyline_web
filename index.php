<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: dashboard");
  exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, fname, lname, state, city, street, zip, phone1, phone2, user_type, garageID, password FROM partnertbl WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email,$fname, $lname, $state, $city, $street, $zip, $phone1, $phone2,  $user_type, $garageID, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
							//die($_SESSION["userid"]);
							$_SESSION["fname"] = $fname;
							$_SESSION["lname"] = $lname;
							$_SESSION["phone1"] = $phone1;
							$_SESSION["phone2"] = $phone2;
							
							$_SESSION["state"] = $state;
							$_SESSION["city"] = $city;
							$_SESSION["street"] = $street;
							$_SESSION["zip"] = $zip;
							
							$_SESSION["user_type"] = $user_type;
							
							$_SESSION['userid'] = $garageID;
                            $_SESSION["garageID"] = $garageID; 
                            							
                            $_SESSION["email"] = $email;  							
                            
                            
							
							if(!empty($_POST["remember"])) {
								setcookie ("email", $email, time()+ (10 * 365 * 24 * 60 * 60));  
								setcookie ("password",	$password,	time()+ (10 * 365 * 24 * 60 * 60));
								
							} else {
								setcookie ("email",""); 
								setcookie ("password","");
							} 
		
								// Redirect user to welcome page
                            
							    header("location: dashboard");
		
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
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
	
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
	
    <style type="text/css">
	    .login-content{
			argin-left: auto;
  margin-right: auto;
		}
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px;   margin-left: auto;
  margin-right: auto;}
  
         .field-icon {
		  float: right;
		  margin-left: -25px;
		  margin-top: -25px;
		  position: relative;
		  z-index: 2;
		}
    </style>
</head>
<body> 
<div id="right-panel" class="right-panel"> 
        
    <div class="wrapper">
	<div class="login-content">
                <div class="login-logo">
                    <a href="index">
                        <img class="align-content" src="images/Skyline-logo3.png" width="90%" height="85%" alt=""/>
                    </a>
                </div>
	</div> 
	<div  class="content">
        <h3>Login</h3>
		<hr/>
        <form action="index" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php if(isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" value="<?php if(isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" class="form-control" id="password"  data-toggle="password">
                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
			 <div class="form-group form-check">
				<label>
					  <input  type="checkbox" id="remember" name="remember" <?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?>> Remember me
				</label>
			 </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="forgets-password">Forget password</a>.</p>
        </form>
    </div> 
	 </div> 
    <hr/>
	<div class="clearfix"></div>
     <?php
	  require("include/footer.php");
	?>
</div>	
</body>
</html>
<script type="text/javascript">
	$("#password").password('toggle');
</script> 

