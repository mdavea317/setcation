<?php

require_once "config.php"; 

// Define variables and initialize with empty values
$fullname = $username = $password = $confirm_password = "";
$fullname_err = $username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate password
    if(empty(trim($_POST["fullname"]))){
        $fullname_err = "Please enter a full name.";     
    } else{
        $fullname = trim($_POST["fullname"]);
    }

 
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT userID FROM users WHERE username = ?";
        
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // store result
                $stmt->store_result();
                
                if($stmt->num_rows == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
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
    if(empty($fullname_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (fullname, username, password) VALUES (?, ?, ?)";
         
        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_fullname, $param_username, $param_password);
            
            // Set parameters
            $param_fullname = $fullname;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
				
				// Assuming the registration is successful
				$successMessage = "Account registered successfully!";				
                // Redirect to login page
                header("location: login.php?successMessage=" . urlencode($successMessage));
				exit(); 
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   



</head>
<body class="register">

<!--HEADER-->
     <?php include 'header.php'?>        
	 <br>
        <br>

        <h1> Create an Account</h1>
        
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label>Full Name</label>
                    <input type="text" name="fullname" value="<?php echo $fullname; ?>">
                    <span><?php echo $fullname_err; ?></span>
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <span><?php echo $username_err; ?></span>
                    <label>Password</label>
                    <input type="password" name="password" value="<?php echo $password; ?>">
                    <span><?php echo $password_err; ?></span>
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                    <span><?php echo $confirm_password_err; ?></span>
                                
            <input type="submit" value="Create Account" id="btn">
            </form>
      
<!--FOOTER-->
		<?php include 'footer.php'?>        
 
  
  
        
</body>




      <!-- Swiper JS -->
  <script src="wp-themes/js/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
	 autoplay: {
	   delay: 5000},
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

</html>


