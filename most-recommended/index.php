<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOST RECOMMENDED | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/setcation/wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/setcation/wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="http://127.0.0.1/setcation/wp-themes/css/swiper-bundle.min.css">   

</head>
<body class="trend">

<!--HEADER-->
		<?php include '../header.php'?>        
        

<!--PAGE HEAD--->

		<section class="section1">
                <h1> MOST RECOMMENDED PLACES </h1>
        </section>

<!--WRAPPER-->
		<section class="wrapper">
        
           <ul>
                <?php
                    $sql_trending = "SELECT * FROM `destinations` ORDER BY `rating` DESC LIMIT 10";
                    $result_trending = mysqli_query($conn, $sql_trending);
                            
                            
                    if (mysqli_num_rows($result_trending) > 0) {
                        while($sql_trending = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>";
           		                echo '<a href="http://127.0.0.1/setcation/destinations.php?id='. $sql_trending['destID'] .'" title="View Place" data-toggle="tooltip">';
								echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_trending["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='placetit'>" . $sql_trending["destination"];
                                echo "<h3> <i class='fa-solid fa-star'></i>" . $sql_trending["rating"] . "/5 </h3>";
                                echo "</div>";                                                                                                
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


