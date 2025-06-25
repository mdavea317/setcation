<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Access | Admin | Lissa's Garden Restaurant</title>
    <link rel="stylesheet" href="../wp-themes/css/style2022.css">

    <link rel="stylesheet" href="../wp-themes/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="../wp-themes/js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
	<?php $pgname = "users" ?>
	<?php include "../sidebar.php" ?>


    <div class="wrapper">
    
        <div class="headbar">
            <h1>User Access</h1>
            <a href="create.php" style="margin-right: 5px;"><i class="fa fa-plus"></i> Add User</a>
        </div>                    

    
        <div class="body-container">
                <div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
                    // Attempt select query execution
                    $sql1 = "SELECT * FROM `users`";
                    if($result1 = $mysqli->query($sql1)){
                        if($result1->num_rows > 0){
								echo '<table width="700px">';
									echo "<tr>";
										echo "<th width='5%' style='text-align: center'>#</th>";
										echo "<th width='25%'>Username</th>";
										/*echo "<th width='25%'>Level</th>";*/
										echo "<th width='20%'>Action</th>";
									echo "</tr>";
							while($row = $result1->fetch_array()){
									echo "<tr>";
										echo "<td style='text-align: center'>" . $row['id'] . "</td>";
														/*echo "<td> <img src=http://localhost/rb/nxtv/wp-content/upload2022/program/" . $row['thumbnail_onair'] . " id='showImage'>";*/
										echo "<td>" . $row['username'] . "</td>";
										/*echo "<td>" . $row['status'] . "</td>";*/
										echo "<td style='text-align: center'>";
										echo '<a href="update.php?id='. $row['id'] .'" title="Update Password" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
										/*echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';*/
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