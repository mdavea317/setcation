<?php
	require_once "config.php"; 

	// USER STARTS HERE
	// Prepare the SQL statement with a parameterized query to prevent SQL injection
	$query = "SELECT userID FROM users WHERE username = ?";
	$stmt = $conn->prepare($query);
	
	// Bind the parameter
	$stmt->bind_param("s", $username);
	
	// Set the username value
	$username = htmlspecialchars($_SESSION["username"]);
	
	// Execute the query
	$stmt->execute();
	
	// Bind the result to a variable
	$stmt->bind_result($userId);
	
	// Fetch the result
	$stmt->fetch();
	
	// Close the statement and database connection
	$stmt->close();

	//TRANSACTION ID
	// Retrieve the transaction ID from the URL parameter or any other source
	$transactionId = $_GET['transaction_id']; // Replace with the actual source of the transaction ID


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SET A LIST | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   
   
   

</head>
<body class="setalist">

<!--HEADER-->
		<?php include 'header.php'?>        
         <br>
        <br>

        <h1>SET A LIST</h1>
 
 		<div class="wrapper">  

            <h2 align="center"> Thank you! You may check your saved list. </h2> <br>

            <table>
            <?php
				$sql = "SELECT `likes`.*, `destinations`.* FROM `likes` LEFT JOIN `destinations` ON `likes`.`destID` = `destinations`.`destID` WHERE transactionID = '$transactionId'";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					// Display the transactions and dates in a table					
					foreach ($result as $row) {?>
                    <tr>
                        <td width="150px"><img src="wp-uploads/202304/<?php echo $row['thumbimg']; ?>"></td>
                        <td id="placetit"><a target="_blank" href="http://127.0.0.1/setcation/destinations.php?id=<?php echo $row['destID']; ?>"> <?php echo $row['destination']; ?> </a> </td>
                        <td id="link"> <a href="<?php echo $row['website']?>" title="View Website" data-toggle="tooltip"> <i class="fa-solid fa-globe-asia"></i> </a> </td>
                        <td id="link"><i class="fa-solid fa-phone"></i> <?php echo $row['contact']?></a> </td>
                    </tr> 
			<?php	
					}
					
					echo "</table>";
				} else {
					echo "No transactions found for the provided user ID.";
				}
			?>
            
         </div>

<!--FOOTER-->
		<?php include 'footer.php'?>        
 
</body>
</html>