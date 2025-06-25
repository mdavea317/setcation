<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$image = "";
$image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get hidden input value
    $id = $_POST["id"];
	
    // Validate 
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please attach image, whether JPG or PNG.";     
    } else{
        $image = $input_image;
    }

    // Check input errors before inserting in database
        // Prepare an update statement
        $sql = "UPDATE `products` SET `image`=? WHERE `productID`=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_image, $param_id);
            
            // Set parameters
            $param_image = $image;
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
        $sql = "SELECT * FROM `products` WHERE `productID` = ?";
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
                    $image = $row["image"];
                    $productname = $row["productname"];
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
        
        // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Image for <?php echo $productname;?> | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">
    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "products" ?>

	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>Update Image</h1>
            <p>Please attach new image and submit to update the record. <br> for: <b> <?php echo $row["productname"]; ?> </b> </p>
        </div>                    

    
        <div class="body-container product-read">
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                         
                         
                        <img src="http://127.0.0.1/lissa/admin/wp-themes/img/<?php echo $row["image"]; ?>">

                        <div class="form-group">
                            <label for="exampleFormControlFile1"> Change Image </label>
  							<input type="file" name="image" value="<?php echo $image; ?>" id="exampleFormControlFile1">
                            <span class="invalid-feedback"><?php echo $image_err;?></span>
                        </div>
                        <br> <br>
						<span class="alert alert-warning" style="margin-left: 320px;"> NOTE: When you click 'Submit' without attaching any image, your image will be removed. </span>
                        
                        <br> <br>

                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" id="btn" class="btn-primary" value="Submit">
                <a href="index.php" id="btn" class="btn-secondary" style="color:#FFF">Cancel</a>
			</form>
		</div>
    </div>
        
</body>
</html>