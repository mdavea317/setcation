
<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$category = "";
$category_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate 
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter valid product name.";
    } else{
        $category = $input_category;
    }
    
	
    // Check input errors before inserting in database
        // Prepare an insert statement
        $sql = "INSERT INTO `productcat`(`category`) VALUES (?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_category);
            
            // Set parameters
            $param_category = $category;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $mysqli->close();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product Category | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "productcat" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>Add Product Category</h1>
            <p>Please fill this form and submit to add record to the database.</p>
        </div>                    

    
        <div class="body-container">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group text">
                            <label>Category</label>
                            <input type="text" name="category" value="<?php echo $category; ?>">
                            <span><?php echo $category_err;?></span>
                        </div>
                                                
                        <br>

                        <input type="submit" id="btn" class="btn-primary" value="Submit">
                        <a href="index.php" id="btn" class="btn-secondary" style="color:#FFF">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>