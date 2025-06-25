<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$status = $contactnumber = $message = "";
$status_err = $contactnumber_err = $message_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get hidden input value
    $id = $_POST["id"];
	
    // Validate 
    $input_status = trim($_POST["status"]);
    if(empty($input_status)){
        $status_err = "Please enter status.";
    } else{
        $status = $input_status;
    }
    
    // Check input errors before inserting in database
        // Prepare an update statement
        $sql = "UPDATE `reservation` SET `status`=? WHERE `reservationID`=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_status, $param_id);
            
            // Set parameters
            $param_status = $status;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM `reservation` WHERE `reservationID` = ?";
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                $result = $stmt->get_result();
                
                if($result->num_rows == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $status = $row["status"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        $stmt->close();
        
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Reservation for <?php echo $status;?> | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">
    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "reservation" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>Update Status</h1>
            <p>Set the reservation whether it's approved or decline. </p>
        </div>                    

    
        <div class="body-container">
        
        
            <?php
								  
								   $sql_ch = "SELECT * FROM `reservation` WHERE `reservationID` = ". $id;
									if($result1 = $mysqli->query($sql_ch)){
										if($result1->num_rows > 0){
												while($row = $result1->fetch_array()){
													echo "<h1>" .$row["reservationID"]. "</h1>";
													echo "<b>".$row["datetime"]."</b>";
													
													echo "<div class='form-group'>";
														echo "<label>Name</label>";
														echo "<p><b>".$row["customername"]."</b></p>";
													echo "</div>";
													
													echo "<div class='form-group'>";
														echo "<label>Contact Number</label>";
														echo "<p><b>". $row["contactnumber"] ."</b></p>";
													echo "</div>";
													
													echo "<div class='form-group'>";
														echo "<label>Message</label>";
														echo "<p><b>". $row["message"] ."</b></p>";
													echo "</div>";
												}
											// Free result set
											$result1->free();
										} else{
											echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
										}
									} else{
										echo "Oops! Something went wrong with the channel list. Please try again later.";
									}
			?>

        
        
        	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">                
                    <!--RESERVATION STATUS: PWEDENG BUTTONS NA LANG PARA MAS MADALI--->
                        <div class="form-group text">
                            <label>Status</label>
                            <select name="status" value="<?php echo $status; ?>">
                                  <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                  <option value="0">-------------</option>
                                  <option value="Approved">Approved</option>
                                  <option value="Declined">Declined</option>
                            </select>                            
                            <span><?php echo $status_err;?></span> 
                        </div>
                 
                <br>

                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" id="btn" class="btn-primary" value="Submit">
                <a href="index.php" id="btn" class="btn-secondary" style="color:#FFF">Cancel</a>
			</form>
		</div>
    </div>
        
</body>
</html>

<?php
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>