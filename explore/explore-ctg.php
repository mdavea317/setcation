<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php";
    // Prepare a select statement
    $sql = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explorectg`.`categoryid` = ?";
    
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
                /*$articledesc = $row["articledesc"];
				$thumbimg = $row["thumbimg"];*/

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
    <title>EXPLORE <?php echo strtoupper($row["category"]); ?> | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="../wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="../wp-themes/css/swiper-bundle.min.css">   

</head>
<body class="explore-main">

<!--HEADER-->
		<?php include '../header.php'?>        
        

<!--PAGE HEAD--->

		<section class="section1">
        		<h2> <a href="http://127.0.0.1/setcation/explore/"> EXPLORE </a> </h2>
                <h1>  <?php echo strtoupper($row["category"]); ?> </h1>
        </section>

<!-- SLIDER--->
		<section class="section2">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
					<?php
                    $sql_explore = "SELECT * FROM `explore` WHERE `categoryid` = ". $row['categoryid'];
                    $result_explore = mysqli_query($conn, $sql_explore);
                                
					if (mysqli_num_rows($result_explore) > 0) {
                    	while($sql_explore = mysqli_fetch_assoc($result_explore)) {
                        	echo "<div class='swiper-slide'>";
								echo '<a href="http://127.0.0.1/setcation/explore/explore.php?id='. $sql_explore['exploreid'] . '">';
									echo "<div class='textcont'>";
										echo "<div id='explore-tit'>" . $sql_explore['articletitle'] ."</div>";
										//echo "<a id='btn' href='http://127.0.0.1/setcation/explore.php?id=". $sql_explore['exploreid'] . "'> <div id='readmore'> READ MORE </div> </a>";
									echo "</div>";
									echo "<img src='../wp-uploads/explore-thumb/".$sql_explore['thumbimg']."'/>";
								echo "</a>";
							echo "</div>";
						}
					} else {
						echo "Soon";
					}
					?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
              </div>
        </section>


<!--WRAPPER-->
		<section class="explore-hm">
                <ul> 
                    <li> <h1> MORE TO EXPLORE </h1> </li>
                    <?php
                        $sql_explore = "SELECT `explorectg`.*, `explore`.* FROM `explorectg` LEFT JOIN `explore` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explore`.`categoryid` = ". $row['categoryid'];
                        include 'explore-strip.php';                  
                        ?>
                </ul>
        </section>
  
<!--FOOTER-->
		<?php include '../footer.php'?>        
 
  
  
        
</body>




  <!-- Swiper JS -->
  <script src="http://127.0.0.1/setcation/wp-themes/js/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
	 autoplay: {
	   delay: 5000},
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

</html>


