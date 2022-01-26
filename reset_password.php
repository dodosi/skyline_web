<?php
// Initialize the session
session_start();

// Include config file
define('DB_SERVER', 'jeanpierre009400390.ipagemysql.com');
define('DB_USERNAME', 'skylineadmin');
define('DB_PASSWORD', 'Skyline@12345678');
define('DB_NAME', 'skylinedb');
 
/* Attempt to connect to MySQL database */
$link = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);


// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = base64_decode(urldecode(trim($_POST["email"])));

// Validate new password
    if (empty(trim($_POST["new_password"]))) {
        $new_password_err = "Please enter the new password.";
    } elseif (strlen(trim($_POST["new_password"])) < 6) {
        $new_password_err = "Password must have atleast 6 characters.";
    } else {
        $new_password = trim($_POST["new_password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($new_password_err) && ($new_password != $confirm_password)) {
            $confirm_password_err = "New passwords did not match.";
        }
    }


    if ($new_password == $confirm_password) {
		//die($sql);
        if (empty($_POST["email"])) {
            $_SESSION["message"] = "<b style='color:orange;'>Something went wrong.</b>";
        } else {
            //Prepare a select statement
            $sql = "SELECT id, password FROM partnertbl WHERE email = ?";
			//die($sql);
            $stmt = $link->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows === 0) {
                $_SESSION["message"] = "<b style='color:orange;'>User not exists</b>";
            } else {
                // Check input errors before updating the database
                if (empty($new_password_err) && empty($confirm_password_err)) {
                    // Prepare an update statement
                    $sql = "UPDATE partnertbl SET password = ? WHERE email = ?";

                    if ($stmt = mysqli_prepare($link, $sql)) {
                        // Bind variables to the prepared statement as parameters
                        mysqli_stmt_bind_param($stmt, "ss", $param_password, $param_email);

                        // Set parameters
                        $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                        $param_email = $email;

                        // Attempt to execute the prepared statement
                        if (mysqli_stmt_execute($stmt)) {
                            // Password updated successfully. Destroy the session, and redirect to login page
                            session_destroy();
                            header("location:index.php");
                            exit();
                        } else {
                            $_SESSION["message"] = "<b style='color:orange;'>Something went wrong.</b>";
                        }
                    }

                    // Close statement
                    mysqli_stmt_close($stmt);
                } else {
                    $_SESSION["message"] = "<b style='color:orange;'>Something went wrong.</b>";
                }
            }
            $stmt->close();
        }
    } else {
        $_SESSION["message"] = "<b style='color:orange;'>Password mismatch.</b>";
    }
}
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Skyline-Web App</title>
    <meta name="description" content="Skyline-Web App">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="images/logo2.png">
    <link rel="shortcut icon" href="images/logo2.png"> 

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
	

	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
 
     
     
   <link href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css" rel="stylesheet" />
	
	   <!-- bootstrap -->
	
	  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	  <link rel="stylesheet" href="https://pn-ciamis.go.id/asset/DataTables/extensions/Buttons/css/buttons.dataTables.css">
	  <!-- bootstrap theme-->
	  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	  <!-- font awesome -->
	  <link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

		  <!-- custom css
	<link rel="stylesheet" href="custom/css/custom.css"> -->
	
		<!-- DataTables -->
	  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">


	  <!-- file input -->
	  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">
	  
  	
	  <!-- jquery -->
	  <script src="assests/jquery/jquery.min.js"></script>
	  <!-- jquery ui  --> 
	  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
	  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

	  <!-- bootstrap js-->
	  <script src="assests/bootstrap/js/bootstrap.min.js"></script> 
</head>
<body >
	    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="#">
                       <img class="align-content" src="images/Skyline-logo3.png" width="90%" height="85%"   alt=""/>
                    </a>
                </div>
				<div class="card-header text-white bg-info">
                            <center>
                                <b>Password reset ?</b><br>
                                <small class="text-muted">
                                    <?php
                                    if (!empty($_SESSION["message"])) {
                                        echo $_SESSION["message"];
                                    }
                                    $_SESSION["message"] = "";
                                    ?>
                                </small>
                            </center>
                </div>
                        <div class="card-body border-info">
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">	
                                <table class="table table-borderless table-sm">
                                    <tr> 
                                        <td>
                                            <label>Enter new Password</label>
                                        </td>
                                        <td>
                                            <input type="hidden"  name="email" value="<?php echo $_GET["xZ"]; ?>" required="required" />
                                            <input type="password"  name="new_password"  placeholder="Enter new password" value="<?php echo $new_password; ?>" class="form-control form-control-sm" required="required" />
                                            <small class="text-muted"><span class="badge  badge-warning"><?php echo $new_password_err; ?></span></small> 
                                        </td> 
                                    </tr>
                                    <tr> 
                                        <td>
                                            <label>Reenter new Password</label>
                                        </td>
                                        <td>
                                            <input type="password"  name="confirm_password"  placeholder="Reenter new Password" value="<?php echo $confirm_password; ?>" class="form-control form-control-sm" required="required"/>
                                            <small class="text-muted"><span class="badge  badge-warning"><?php echo $confirm_password_err; ?></span></small>
                                        </td> 
                                    </tr>
                                    <tr> 
                                        <td>
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn btn-primary btn-sm">Submit</button> 
                                        </td> 
                                    </tr>
                                </table>
                            </form>

                        </div>
                        				<div class="card-footer text-muted border-info center">
                            <span class="btn-group btn-xs" role="group" aria-label="Basic example">
                                <a class="btn btn-xs btn-default" href="javascript:history.go(-1)" title="Go back">Go back</a>
                                <a class="btn btn-xs btn-default" href="index.php" title="Login"><span>Login</span></a>
                            </span>
                </div>
            </div>
        </div>
    </div>  
</body>
 	<?php
	  include("include/footer.php")
	?>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>
</html>
