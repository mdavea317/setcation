<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEWS | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="../wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="../wp-themes/css/swiper-bundle.min.css">   

</head>
<body class="explore-main">

<!--HEADER-->
		<?php include '../header.php'?>        
        

<!--PAGE HEAD--->

		<section class="section1">
                <h1> NEWS </h1>
        </section>

<!-- SLIDER--->
		<section class="section2">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
					<?php
                    $sql_explore = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explorectg`.`category` = 'News' LIMIT 3";
                    $result_explore = mysqli_query($conn, $sql_explore);
                                
					if (mysqli_num_rows($result_explore) > 0) {
                    	while($sql_explore = mysqli_fetch_assoc($result_explore)) {
                        	echo "<div class='swiper-slide'>";
								echo '<a href="news.php?id='. $sql_explore['exploreid'] . '">';
									echo "<div class='textcont'>";
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
		<section class="explore-hm">
                <ul> 
                    <li> <h1> MORE STORIES </h1> </li>
                    <?php
                        $sql_explore = "SELECT `explorectg`.*, `explore`.* FROM `explorectg` LEFT JOIN `explore` ON `explorectg`.`categoryid` = `explore`.`categoryid`  WHERE `explorectg`.`category` = 'News'";
						$result_explore = mysqli_query($conn, $sql_explore);
						if (mysqli_num_rows($result_explore) > 0) {
						  while($sql_explore = mysqli_fetch_assoc($result_explore)) {
							echo "<li>";
							echo '<a href="http://127.0.0.1/setcation/news/news.php?id='. $sql_explore['exploreid'] . '">';
								echo "<div id='imgbox'>";
									echo "<img src='http://127.0.0.1/setcation/wp-uploads/explore-thumb/". $sql_explore["thumbimg"] ."'/>";
								echo "</div>";
								echo "<div id='explore-ctg'> ON " . $sql_explore["category"] . "</div>";
								echo "<div id='explore-tit'>" . $sql_explore["articletitle"] . "</div>";
								echo "<div id='explore-desc'>" . substr($sql_explore["articledesc"], 0, 100) . "...</div>";
							echo "</a>";
							echo "</li>";
						  }
						} else {
						  echo "Soon";
						}                    
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


