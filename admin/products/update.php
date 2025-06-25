<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$productname = $productdesc = $category = $price = $bestseller = $image = "";
$productname_err = $productdesc_err = $category_err = $price_err = $bestseller_err = $image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Get hidden input value
    $id = $_POST["id"];
	
    // Validate 
    $input_productname = trim($_POST["productname"]);
    if(empty($input_productname)){
        $productname_err = "Please enter valid product name.";
    } else{
        $productname = $input_productname;
    }
    
    $input_productdesc = trim($_POST["productdesc"]);
    if(empty($input_productdesc)){
        $productdesc_err = "Please enter a product description.";     
    } else{
        $productdesc = $input_productdesc;
    }

    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price.";     
    } else{
        $price = $input_price;
    }
	
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter a product description.";     
    } else{
        $category = $input_category;
    }
	
	
	// Validate 
    $input_bestseller = trim($_POST["bestseller"]);
    if(empty($input_bestseller)){
        $bestseller_err = "";     
    } else{
        $bestseller = $input_bestseller;
    }
	
    // Check input errors before inserting in database
        // Prepare an update statement
        $sql = "UPDATE `products` SET `productname`=?,`productdesc`=?,`price`=?,`categoryID`=?, `bestseller`=? WHERE `productID`=?";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssi", $param_productname, $param_productdesc, $param_price, $param_category, $param_bestseller, $param_id);
            
            // Set parameters
            $param_productname = $productname;
            $param_productdesc = $productdesc;
            $param_price = $price;
			$param_category = $category;
			$param_bestseller = $bestseller;
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
        $sql = "SELECT `products`.*, `productcat`.`category` FROM `products` LEFT JOIN `productcat` ON `products`.`categoryID` = `productcat`.`id` WHERE `products`.`productID` = ?";
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
                    $productname = $row["productname"];
					$productdesc = $row["productdesc"];
					$price = $row["price"];
					$categoryID = $row["categoryID"];
					$category = $row["category"];
					$bestseller = $row["bestseller"];
					
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
    <title>Update Product for <?php echo $productname;?> | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">
    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "products" ?>
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
                    <input type="text" class="input-text" name="productname" value="<?php echo $productname; ?>">
					<span><?php echo $productname_err;?></span>
				</div>
                        
                <div class="form-group text">
                     <label>Description</label>
                            <textarea name="productdesc" rows="4" cols="66"> <?php echo $productdesc; ?></textarea>
                     <span><?php echo $productdesc_err;?></span>
				</div>
                        
                <div class="form-group text">
                	<label>Price</label>
                    <input type="text" class="input-text" name="price" value="<?php echo $price; ?>">
                    <span><?php echo $price_err;?></span>
				</div>
                
                    <!--PRODUCT CATEGORY--->
                        <div class="form-group text">
                            <label>Category</label>
                            <select name="category" value="<?php echo $category; ?>">
                                  <option value="<?php echo $categoryID; ?>"><?php echo $category; ?></option>
                                  <option value="0">-------------</option>
                                  <?php
								  
								   $sql_ch = "SELECT `id`, `category` FROM `productcat`";
									if($result1 = $mysqli->query($sql_ch)){
										if($result1->num_rows > 0){
												while($row = $result1->fetch_array()){
													echo "<option value='".$row['id']."'>" .$row['category']. "</option>"; 
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
                            </select>     
                            
                                                   
                            <span><?php echo $category_err;?></span> 
                            <a href="../productcat/create.php"> &nbsp; &nbsp; <i class="fa fa-plus"></i> Add Category </a>
                        </div>
                        
                        
                          <div class="form-group">
                            <div class="form-check">
                              <label class="form-check-label">Best Seller?</label>
                              <input class="form-check-input" type="checkbox" id="checkbox1" name="bestseller" value="1">
                            <span class="invalid-feedback"><?php echo $bestseller_err;?></span>
                            </div>
                          </div>

								 <?php 
								 	if ($bestseller==1){
										echo "<script>";
										echo "document.getElementById('checkbox1').checked = true;";
										echo "</script>";
									
									}
								 
								 ?>

                <br>

                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                <input type="submit" id="btn" class="btn-primary" value="Submit">
                <a href="index.php" id="btn" class="btn-secondary" style="color:#FFF">Cancel</a>
			</form>
		</div>
    </div>
        
</body>
</html>

<?php         // Close connection
        $mysqli->close();
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>