<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reservation | Admin | Lissa's Garden Restaurant</title>
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
	<?php $pgname = "reservation" ?>
	<?php include "../sidebar.php" ?>


    <div class="wrapper">
    
        <div class="headbar">
            <h1>Reservations</h1>
        </div>                    

    
        <div class="body-container">
                <div>
                    <?php
                    // Include config file
                    require_once "../config.php";
                    
					//RESERVATION STATUS: TABS OR FORMATTING NA LANG?

                    // Attempt select query execution
                    $sql1 = "SELECT * FROM `reservation`";
                    if($result1 = $mysqli->query($sql1)){
                        if($result1->num_rows > 0){
								echo '<table>';
									echo "<tr>";
										echo "<th width='5%' style='text-align: center'>#</th>";
										echo "<th width='10%'>Date and Time</th>";
										echo "<th width='18%'>Customer Info</th>";
										echo "<th width='50%'>Message</th>";
										echo "<th width='10%'>Status</th>";
										echo "<th width='7%'>Action</th>";
									echo "</tr>";
									
							while($row = $result1->fetch_array()){
									echo "<tr>";
										echo "<td style='text-align: center'>" . $row['reservationID'] . "</td>";
										echo "<td>" . $row['datetime'] . "</td>";
										echo "<td>" . $row['surname'] . "<br>". $row['contactnumber'] . "</td>";
										echo "<td>" . $row['message'] . "</td>";
										echo "<td style='text-align: center'>" . $row['status'] . "</td>";
										echo "<td style='text-align: center'>";
										echo '<a href="update.php?id='. $row['reservationID'] .'" title="Update Status" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
										echo "</td>";										
									echo "</tr>";
								}
											echo "</table>";
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