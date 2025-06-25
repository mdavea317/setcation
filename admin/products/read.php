<?php
// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Include config file
    require_once "../config.php";
    
    // Prepare a select statement
    $sql = "SELECT `products`.*, `productcat`.`category` FROM `products` LEFT JOIN `productcat` ON `products`.`categoryID` = `productcat`.`id` WHERE `products`.`productID` = ?";
    
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
                $productname = $row["productname"];
                $productdesc = $row["productdesc"];
                $price = $row["price"];
                $category = $row["category"];
                $image = $row["image"];
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
    <title><?php echo $row["productname"]; ?> | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
	<?php $pgname = "products" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>View Product</h1>
        </div>                    

    
        <div class="body-container product-read">
                <div>
                    
                    <img src="http://127.0.0.1/lissa/admin/wp-themes/img/<?php echo $row["image"]; ?>" id="showImage">

                    <div class="form-group">
                        <label>Product Name</label>
                        <p><b><?php echo $row["productname"]; ?></b></p>
                    </div>
                    
                    
                    <div class="form-group">
                        <label>Description</label>
                        <p><b><?php echo $row["productdesc"]; ?></b></p>
                    </div>
  
                    <div class="form-group">
                        <label>Category</label>
                        <p><b><?php echo $row["category"]; ?></b></p>
                    </div>

                    <div class="form-group">
                        <label>Price</label>
                        <p><b><?php echo $row["price"]; ?></b></p>
                    </div>
                    <br> <br>
                    
                     <p><a href="index.php" id="btn" class="btn-primary" style="color:#fff">Back</a></p>
          </div>
      </div>        
        </div>
    </div>
</body>
</html>