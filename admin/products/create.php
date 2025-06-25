

<?php
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$productname = $productdesc = $category = $price = $bestseller = $image = "";
$productname_err = $productdesc_err = $category_err = $price_err = $bestseller_err = $image_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
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

    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter a product description.";     
    } else{
        $category = $input_category;
    }
  
    $input_price = trim($_POST["price"]);
    if(empty($input_price)){
        $price_err = "Please enter the price.";     
    } else{
        $price = $input_price;
    }

	// Validate 
    $input_bestseller = trim($_POST["bestseller"]);
    if(empty($input_bestseller)){
        $bestseller_err = "";     
    } else{
        $bestseller = $input_bestseller;
    }
	
    $input_image = trim($_POST["image"]);
    if(empty($input_image)){
        $image_err = "Please enter.";     
    } else{
        $image = $input_image;
    }
	
    // Check input errors before inserting in database
        // Prepare an insert statement
        $sql = "INSERT INTO `products`(`productname`, `productdesc`, `price`, `categoryID`, `bestseller`, `image`) VALUES (?,?,?,?,?,?)";
 
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssssss", $param_productname, $param_productdesc, $param_price, $param_category, $param_bestseller, $param_image);
            
            // Set parameters
            $param_productname = $productname;
            $param_productdesc = $productdesc;
            $param_price = $price;
            $param_category = $category;
			$param_bestseller = $bestseller;
			$param_image = $image;
            
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
    
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
</head>
<body>
	<?php $pgname = "products" ?>
	<?php include "../sidebar.php" ?>

    <div class="wrapper">
    
        <div class="headbar">
            <h1>Add Product</h1>
            <p>Please fill this form and submit to add record to the database.</p>
        </div>                    

    
        <div class="body-container">

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group text">
                            <label>Product Name</label>
                            <input type="text" name="productname" value="<?php echo $productname; ?>">
                            <span><?php echo $productname_err;?></span>
                        </div>
                        
                        <div class="form-group text">
                            <label form="productdesc">Description</label>
                            <textarea name="productdesc" rows="4" cols="66"> <?php echo $productdesc; ?></textarea>
                            <!--input type="text" name="productdesc" value="<?php echo $productname; ?>"-->
                            <span><?php echo $productdesc_err;?></span>
                        </div>
                        
                        <div class="form-group text">
                            <label>Price</label>
                            <input type="text" name="price" value="<?php echo $price; ?>">
                            <span><?php echo $price_err;?></span>
                        </div>
                        
                    <!--PRODUCT CATEGORY--->
                        <div class="form-group text">
                            <label>Category</label>
                            <select name="category" value="<?php echo $category; ?>">
                                  <option value="0">---Select---</option>
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
                              <input class="form-check-input" type="checkbox" name="bestseller" value="1">
                            <span class="invalid-feedback"><?php echo $bestseller_err;?></span>
                            </div>
                          </div>
                        
                        <div class="form-group text">
                            <label for="exampleFormControlFile1"> Image </label>
  							<input type="file" name="image" value="<?php echo $image; ?>" id="exampleFormControlFile1">
                            <span><?php echo $image_err;?></span>
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

<?php     // Close connection
    $mysqli->close();
?>