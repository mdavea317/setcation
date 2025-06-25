<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM `reservation` WHERE `reservationID` = ?";
    
    if($stmt = $mysqli->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["id"]);
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            $result = $stmt->get_result();
            
            if($result->num_rows == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $customername = $row["customername"];
                $contactnumber = $row["contactnumber"];
                $message = $row["message"];
                $status = $row["status"];
			} else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $mysqli->close();
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <title> Reservations| Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php $pgname = "reservation" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>View reservation</h1>
        </div>                    

    
        <div class="body-container reservation-read">
                <div>
                    
					<h1> <?php echo $row["reservationID"]; ?> </h1>

                    <b><?php echo $row["datetime"]; ?></b>
                    
                    <div class="form-group">
                        <label>Name</label>
                        <p><b><?php echo $row["customername"]; ?></b></p>
                    </div>
                    
                    
                    <div class="form-group">
                        <label>Contact Number</label>
                        <p><b><?php echo $row["contactnumber"]; ?></b></p>
                    </div>
                    
                    <div class="form-group">
                        <label>Message</label>
                        <p><b><?php echo $row["message"]; ?></b></p>
                    </div>
                    <br> <br>
                    
                     <p><a href="index.php" id="btn" class="btn-primary" style="color:#fff">Back</a></p>
          </div>
      </div>        
        </div>
    </div>
</body>
</html>