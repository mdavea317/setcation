
<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$category = $productdesc = $price = "";
$category_err = $productdesc_err = $price_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get hidden input value
    $id = $_POST["id"];
	
    // Validate 
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter valid category.";
    } else{
        $category = $input_category;
    }
    
    // Check input errors before inserting in database
        // Prepare an update statement
        $sql = "UPDATE `productcat` SET `category`=? WHERE `id`=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("si", $param_category, $param_id);
            
            // Set parameters
            $param_category = $category;
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
        $sql = "SELECT * FROM `productcat` WHERE `id` = ?";
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
                    $category = $row["category"];
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
    <title>Update Category for<?php echo $category;?>| Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">
    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "productcat" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>Update Product</h1>
            <p>Please edit the input values and submit to update the record.</p>
        </div>                    

    
        <div class="body-container">
        	<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
            	<div class="form-group text">
                	<label>Product Name</label>
                    <input type="text" class="input-text" name="category" value="<?php echo $category; ?>">
					<span><?php echo $category_err;?></span>
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