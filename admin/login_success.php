<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: dashboard.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
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
        $sql = "SELECT `id`, `username`, `password` FROM `users` WHERE `username` = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Username doesn't exist";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html>
<head>
	<title>LOG IN</title>
    <link rel="stylesheet" href="wp-themes/css/style2022.css">

    <link rel="stylesheet" href="wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="wp-themes/js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body class="login">
	<div class="login-wrapper">
    	<div class="login-head">
        	<img src="wp-themes/img/lissa_w_tag.png" alt="Lissa">
        </div>
        <div class="login-body">
        	<h1> Log-in </h1>
        	
            <div class="alert alert-success"> Log-in completed successfully </div>
            
            
            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>
    
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <span><?php echo $username_err; ?></span>
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password">
                    <span><?php echo $password_err; ?></span>
                </div>
                <div style="display:block; text-align:center; margin-top: 10px;">
                    <input type="submit" id="btn" class="btn-primary" value="Login">
                </div>
            </form>
         </div>
    
    <!--admin1234_-->
    
    </div>


</body>        
        
</html>

        <!--form method="POST" action="login.php">
            <div class="login-body">
                <h1>LOG-IN</h1>

                <label>User Name</label>
                <input type="text" name="username" placeholder="User Name">
                <label>Password</label>
                <input type="password" name="password" placeholder="Password"><br>
                <button type="submit">LOG IN</button><br>
            </div>
         
        </form-->
