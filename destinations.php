<!DOCTYPE html>
<html lang="en">

<?php require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM destinations WHERE destID = ?";
    
    if($stmt = $conn->prepare($sql)){
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
                $destID = $row["destID"];
                $destination = $row["destination"];
                $descr = $row["descr"];
				$getthere = $row["getthere"];
                $rating = $row["rating"];
                $thumbimg = $row["thumbimg"];
                $cityID = $row["cityID"];

            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }


?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo strtoupper($row["destination"]); ?> | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   
   
   

</head>
<body class="places">

<!--HEADER-->
		<?php include 'header.php'?>        
        
<!--SLIDER--->

		<section class="section1">
            <img src="http://127.0.0.1/setcation/wp-uploads/202304/<?php echo $row["thumbimg"]; ?>" />
            <div class="text-cont">
                <h1>  <?php echo $row["destination"]; ?> </h1>
                <h3> <i class="fa-solid fa-star"></i> <?php echo $row["rating"]; ?>/5 </h3>

			</div>
        </section>

        <div class="setalist-btn">
        	<a href='addplace.php?id=<?php echo $row["destID"]; ?>'> <i class="fa-solid fa-heart"> </i> Set A List </a>
        </div>

		<section class="wrapper">
        	<!--div class="breadcrumbs">
        Mindanao > Surigao del Sur > Enchanted River, Surigao del Sur
        	</div-->
  
        
                <span class="aboutthis">	
                    <h1> About this </h1>
                    <p>  <?php echo $row["descr"]; ?> </p> <!--button onclick="readmore()" id="btn">Read more</button-->
                </span>

		<br> <br>


<!--HOW TO GET THERE-->
		<h1> How to get there </h1>
        <table class="getthere">
			<?php echo $row["getthere"]; ?>
		</table>
        </section>


		<section class="section4">
        	<h1> PLACES NEARBY </h1>
           <ul>
                <?php
                    $sql_trending = "SELECT * FROM destinations WHERE cityID = '$cityID' AND NOT category = 'destination' ORDER BY RAND() LIMIT 4";
                    $result_trending = mysqli_query($conn, $sql_trending);
                            
                            
                    if (mysqli_num_rows($result_trending) > 0) {
                        while($sql_trending = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>";
                            echo '<a href="destinations.php?id='. $sql_trending['destID'] .'" title="View Place" data-toggle="tooltip">';
                                echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_trending["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='place-tit'>" . $sql_trending["destination"] . "</div>";
                                echo "<h2>" . $sql_trending["rating"] . "/5 </h2>";
                                                                                                                                
                            echo "</a>";
                            echo "</li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
                    ?>            
            </ul>            
        </section>


<!--FOOTER-->
		<?php include 'footer.php'?>        
 
  
  
        
</body>




  <!-- Swiper JS -->
  <script src="wp-themes/js/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

	<script src="wp-themes/js/readmore.js"></script>

</html>


