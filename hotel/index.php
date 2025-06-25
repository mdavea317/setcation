<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php"; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOTELS | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="http://127.0.0.1/setcation/wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="http://127.0.0.1/setcation/wp-themes/css/swiper-bundle.min.css">   

</head>
<body class="hotelresto">

<!--HEADER-->
		<?php include '../header.php'?>        
        
<!--SEARCH-->
		<?php
        // Sample list of items
		$sql_search = "SELECT `destinations`.*, `province`.* FROM `destinations` LEFT JOIN `province` ON `destinations`.`provinceID` = `province`.`provinceID`;";
		$result_search = mysqli_query($conn, $sql_search);
				
				
		if (mysqli_num_rows($result_search) > 0) {
			while($sql_search = mysqli_fetch_assoc($result_search)) {
				$items[] = ["ctg" => "destinations", "searchnm" => $sql_search["destination"], "searchid" => $sql_search["destID"], "searchsub" => $sql_search["province"], "faclass" => "fa-location-arrow"];
				$items[] = ["ctg" => "province", "searchnm" => $sql_search["province"], "searchid" => $sql_search["provinceID"], "searchsub" => $sql_search["regionnm"], "faclass" => "fa-location-dot"];

			}
		 } else {
			echo "Coming soon!";
			}
		
        
		// Get the search query from the user
		$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
		
		// Filter the items based on the search query
		$filteredItems = [];
		foreach ($items as $item) {
			if (stripos($item['searchnm'], $searchQuery) !== false) {
				$filteredItems[] = $item;
			}
		}
		
		// Check if the clear button is clicked
		if (isset($_GET['clear'])) {
			$searchKeyword = '';
			$filteredItems = array();
		}
        ?>

<!--PAGE HEAD--->

		<section class="section1">
                <h1> HOTELS </h1>
        </section>
        
		<section class="section2">
                <div class="searchcont">
                    <form action="" method="GET">
                      <i class="fa fa-search"></i>
                      <input type="text" id="search-bar" placeholder="Search Destination" name="search">
                    </form>
                    <div id="item-list">
						<?php if (!empty($filteredItems)): ?>
                            <ul>
                                <?php foreach ($filteredItems as $item): ?>
                                    <a href="<?php echo $item['ctg'];?>.php?id=<?php echo $item['searchid']; ?>">
                                    	<li> <i class="fa-solid <?php echo $item['faclass']; ?>"></i>
										     <?php echo $item['searchnm']; ?> <br>
											 <span id="searchsub"> <?php echo $item['searchsub']; ?> </span>
                                        </li>
                                    </a>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <p>No results found.</p>
                        <?php endif; ?>
                    </div>
        </section>
        
		<section class="section4" id="recom">

           <ul>
                <?php
                    $sql_recom = "SELECT * FROM `destinations` ORDER BY `rating` DESC LIMIT 4";
                    $result_recom = mysqli_query($conn, $sql_recom);
                            
                            
                    if (mysqli_num_rows($result_recom) > 0) {
                        while($sql_recom = mysqli_fetch_assoc($result_recom)) {
                            echo "<li>";
                            echo '<a href="destinations.php?id='. $sql_recom['destID'] .'" title="View Place" data-toggle="tooltip">';
                                echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_recom["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='place-tit'>" . $sql_recom["destination"] . "</div>";
                                //echo "<h2> <i class='fa-solid fa-star'></i>" . $sql_recom["rating"] . "/5 </h2>";
                                                                                                                                
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


