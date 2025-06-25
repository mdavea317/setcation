<?php
	require_once "config.php"; 


	
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

            <?php
				$sql = "SELECT transactionID, datecreated FROM likes WHERE transactionID = '$transactionId'";
				$result = $conn->query($sql);
				
				if ($result->num_rows > 0) {
					// Display the transactions and dates in a table
					echo "<table>";
					
					while ($row = $result->fetch_assoc()) {
				
						echo "<tr>";
						echo "<td width='200px'><img src='wp-uploads/202304'" . $row['thumbimg'] . "'></td>";
						echo "</tr>";
					}
					
					echo "</table>";
				} else {
					echo "No transactions found for the provided user ID.";
				}
			?>

            <form>
              <button type="submit" id="btn">GO BACK</button>
            </form>
         </div>

</body>