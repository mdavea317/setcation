<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
    <style>
        /*.wrapper{
            width: 1000px;
            margin: 0 auto;
			*background: url(../wp-themes/img/lissa_square_default.png)
        }
		table {
			font-size: 14px;
		}
        table tr td:last-child{
            width: 120px;
        }
		#showImage {
			width: 50px;
			height: 37.5px;
			float: left;
			margin-right: 10px;
			object-fit: cover;}*/
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>

	<?php $pgname = "products" ?>
	<?php include "../sidebar.php" ?>


    <div class="wrapper">
    
        <div class="headbar">
            <h1>Products</h1>
            <a href="create.php" style="margin-right: 5px;"><i class="fa fa-plus"></i> Add Product</a>
        </div>                    

    
        <div class="body-container">
                <div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
					
                    // Attempt select query execution
                    $sql1 = "SELECT `products`.*, `productcat`.`category` FROM `products` LEFT JOIN `productcat` ON `products`.`categoryID` = `productcat`.`id`;";
                    if($result1 = $mysqli->query($sql1)){
                        if($result1->num_rows > 0){
								echo '<table>';
									echo "<tr>";
										echo "<th width='5%' style='text-align: center'>#</th>";
										echo "<th width='5%'> &nbsp; </th>";
										echo "<th width='20%'>Product Name</th>";
										echo "<th width='25%'>Description</th>";
										echo "<th width='20%'>Category</th>";
										echo "<th width='7%'>Price</th>";
										echo "<th width='13%'>Action</th>";
									echo "</tr>";
							while($row = $result1->fetch_array()){
									echo "<tr>";
										echo "<td style='text-align: center'>" . $row['productID'] . "</td>";
														/*echo "<td> <img src=http://localhost/rb/nxtv/wp-content/upload2022/program/" . $row['thumbnail_onair'] . " id='showImage'>";*/
										echo "<td style='text-align: center'> <img src='http://127.0.0.1/lissa/wp-themes/img/" . $row['image'] . "'/></td>";
										echo "<td>" . $row['productname'] . "</td>";
										echo "<td>" . $row['productdesc'] . "</td>";
										echo "<td style='text-align: center'>" . $row['category'] . "</td>";
										echo "<td style='text-align: center'>" . $row['price'] . "</td>";
										echo "<td style='text-align: center'>";
										echo '<a href="read.php?id='. $row['productID'] .'" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
										echo '<a href="update.php?id='. $row['productID'] .'" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
										echo '<a href="update_img.php?id='. $row['productID'] .'" title="Change Image" data-toggle="tooltip"><span class="fa fa-image"></span></a>';
										echo '<a href="delete.php?id='. $row['productID'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
										echo "</td>";										
									echo "</tr>";
								}
											echo "</table>";/*
											// Free result set
											$result2->free();
										} else{
											echo '<div><em>No records were found.</em></div>';
										}
									} else{
										echo "Oops! Something went wrong. Please try again later.";
									}

									
									
                                }*/
                            // Free result set
                            $result1->free();
                        } else{
                            echo '<div><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
					
					
					
					
					
					
					
                    
                    // Close connection
                    $mysqli->close();
                    ?>
                </div>
        </div>
    </div>
</body>
</html>