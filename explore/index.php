<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXPLORE | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="../wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="../wp-themes/css/swiper-bundle.min.css">   

</head>
<body class="explore-main">

<!--HEADER-->
		<?php include '../header.php'?>        
        

<!--PAGE HEAD--->

		<section class="section1">
                <h1> EXPLORE </h1>
        </section>

<!-- SLIDER--->
		<section class="section2">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
					<?php
                    $sql_explore = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explorectg`.`category` NOT LIKE 'News' LIMIT 3";
                    $result_explore = mysqli_query($conn, $sql_explore);
                                
					if (mysqli_num_rows($result_explore) > 0) {
                    	while($sql_explore = mysqli_fetch_assoc($result_explore)) {
                        	echo "<div class='swiper-slide'>";
								echo '<a href="http://127.0.0.1/setcation/explore.php?id='. $sql_explore['exploreid'] . '">';
									echo "<div class='textcont'>";
										echo "<div id='explore-ctg'>" . $sql_explore['category'] ." </div>";
										echo "<div id='explore-tit'>" . $sql_explore['articletitle'] ."</div>";
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
		<?php
        $sql_exploremn = "SELECT * FROM `explorectg` WHERE `category` NOT LIKE 'News'";
        $result_exploremn = mysqli_query($conn, $sql_exploremn);
                    
        if (mysqli_num_rows($result_exploremn) > 0) {
            while($sql_exploremn = mysqli_fetch_assoc($result_exploremn)) {
                echo "<section class='explore-hm'>";
				echo "<ul>";
					echo "<li>";
						echo "<h1>". $sql_exploremn['category'] ."</h1>";
						echo "<a href='http://127.0.0.1/setcation/explore/explore-ctg.php?id=". $sql_exploremn['categoryid'] . "'> VIEW MORE </a>";
					echo "</li>";
					$sql_explore = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explore`.`categoryid` = '". $sql_exploremn['categoryid'] ."' LIMIT 3";
                        include 'explore-strip.php';  
				echo "</ul>";
                echo "</section>";
            }
        } else {
            echo "Soon";
        }
					?>
  
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


