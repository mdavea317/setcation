<!DOCTYPE html>
<html lang="en">

<?php require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM province WHERE provinceID = ?";
    
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
                $province = $row["province"];

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
    <title><?php echo strtoupper($row["province"]); ?> | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   
   
   

</head>
<body class="province">

<!--HEADER-->
		<?php include 'header.php'?>        
        
<!--PAGE HEAD--->

		<section class="section1">
                <h2> DISCOVER </h2>
                <h1> <?php echo $row["province"]; ?> </h1>
        </section>

<!--ABOUT THE PLACE--->
		<section class="section2">
			<div class="slidecont">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img src="wp-uploads/province-thumb/<?php echo $row["thumbimg"]; ?>"></div>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
        	</div>
            
            <div class="textcont">
                <p> <?php echo $row["descr"]; ?> </p>
            </div>
            
        </section>

<!--WRAPPER STARTS HERE-->
		<section class="wrapper">
        	<div class="breadcrumbs">
        		<a href="index.php"> <i class="fa-solid fa-home"> </i> </a> &gt;
				<?php echo $row["province"]; ?>
        	</div>
        
		</section>


		<!--TOP DESTINATIONS-->
		<section class="section4">
        	<h1> TOP DESTINATIONS </h1>
           <ul>
                <?php
                    $sql_trending = "SELECT * FROM `destinations` WHERE `provinceID`=".$row['provinceID']." AND category = 'destination' LIMIT 4";
                    $result_trending = mysqli_query($conn, $sql_trending);
                            
                            
                    if (mysqli_num_rows($result_trending) > 0) {
                        while($sql_trending = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>";
                            echo '<a href="destinations.php?id='. $sql_trending['destID'] .'" title="View Place" data-toggle="tooltip">';
                                echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_trending["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='place-tit'>" . $sql_trending["destination"] . "</div>";
                                echo "<h2> <i class='fa-solid fa-star'></i>" . $sql_trending["rating"] . "/5 </h2>";
                                                                                                                                
                            echo "</a>";
                            echo "</li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
                    ?>            
            </ul>            
        </section>
   
   		<!--HOTELS & RESTARANTS--->
 		<section class="section4">
        	<h1> HOTELS & RESTAURANTS </h1>
           <ul>
                <?php
                    $sql_trending = "SELECT * FROM `destinations` WHERE `provinceID`=".$row['provinceID']." AND NOT category = 'destination' ORDER BY RAND() LIMIT 8";
                    $result_trending = mysqli_query($conn, $sql_trending);
                            
                            
                    if (mysqli_num_rows($result_trending) > 0) {
                        while($sql_trending = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>";
                            echo '<a href="destinations.php?id='. $sql_trending['destID'] .'" title="View Place" data-toggle="tooltip">';
                                echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_trending["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='place-tit'>" . $sql_trending["destination"] . "</div>";
                                echo "<h2> <i class='fa-solid fa-star'></i>" . $sql_trending["rating"] . "/5 </h2>";
                                                                                                                                
                            echo "</a>";
                            echo "</li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
                    ?>            
            </ul>            
        </section>
  
            
   		<!--EXPLORE>
		<section class="explore-hm">
            <ul> 
          		<li> <h1> EXPLORE </h1> </li>
                <?php
                    //$sql_explore = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explorectg`.`category` NOT LIKE 'News' LIMIT 3";
                   // include 'explore/explore-strip.php';                  
                    ?>
            </ul>
        </section--->
            
       
       
      
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


