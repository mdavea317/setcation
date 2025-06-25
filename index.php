<!DOCTYPE html>
<html lang="en">

<?php require_once "config.php"; ?>



<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   



</head>
<body>

<!--HEADER-->
		<?php include 'header.php'?>        

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

<!-- BANNER TOP -->
		<section class="banner-home">
        	<h1> PLAN now and <br> make it POSSIBLE</h1>
            
            
            <!--SEARCH CONTAINER-->
            <div class="nav">
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
                </div>
                
                <!--BUTTON TO HOTEL & RESTO>
                <ul class="buttoncont">
                	<li> <a href="hotel/"> <i class="fa-solid fa-hotel"></i> Hotels </a> </li>
                	<li> <a href="#"> <i class="fa-solid fa-utensils"></i> Restaurant </a> </li>
                </ul-->
            </div>
    </section>

<!-- TRENDING / MOST RECOMMENDED -->
		<section class="section4" id="trend">
        	<h1> TRENDING DESTINATIONS </h1>

            <div style="text-align: right; float: right; font-weight: normal; margin-top: -50px;">
            	<a id="btn" href="trending/"> VIEW ALL </a>
            </div> 
            
           <ul>
                <?php
                    $sql_trending = "SELECT * FROM `destinations` WHERE `trending`=1 LIMIT 4";
                    $result_trending = mysqli_query($conn, $sql_trending);
                            
                            
                    if (mysqli_num_rows($result_trending) > 0) {
						$xnum = 1;
                        while($sql_trending = mysqli_fetch_assoc($result_trending)) {
                            echo "<li>";
                               	echo "<div id='numbox'>". $xnum++ ."</div>";
           		                echo '<a href="destinations.php?id='. $sql_trending['destID'] .'" title="View Place" data-toggle="tooltip">';
								echo "<div id='imgbox'>";
                                    echo "<img src='http://127.0.0.1/setcation/wp-uploads/202304/". $sql_trending["thumbimg"] ."'/>";
                                echo "</div>";
                                echo "<div id='place-tit'>" . $sql_trending["destination"] . "</div>";
                                //echo "<h2> <i class='fa-solid fa-star'></i>" . $sql_trending["rating"] . "/5 </h2>";
                                                                                                                                
                            echo "</a>";
                            echo "</li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
				    ?>            
            </ul>        
            

                
        </section>
        
       
		<section class="section4" id="recom">
        	<h1> MOST RECOMMENDED DESTINATIONS </h1>

            <div style="text-align: right; float: right; font-weight: normal; margin-top: -50px;">
            	<a id="btn" href="most-recommended/"> VIEW ALL </a>
            </div> 
            

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
                                echo "<h2> <i class='fa-solid fa-star'></i>" . $sql_recom["rating"] . "/5 </h2>";
                                                                                                                                
                            echo "</a>";
                            echo "</li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
                    ?>            
            </ul>            

        </section>
        
          
<!---PLACE--->
		<section class="places-hm">
            <ul> 
                <li> <h1> DISCOVER MORE PLACES </h1> </li>
                <?php
                    $sql_prov = "SELECT `province`.*, `destinations`.* FROM `province` LEFT JOIN `destinations` ON `destinations`.`provinceID` = `province`.`provinceID` GROUP BY `province` ORDER BY `destinations`.`destID` ASC LIMIT 6";
                    $result_prov = mysqli_query($conn, $sql_prov);
                            
                            
                    if (mysqli_num_rows($result_prov) > 0) {
                        while($sql_prov = mysqli_fetch_assoc($result_prov)) {
                            echo "<li>";
								echo '<a href="province.php?id='. $sql_prov['provinceID'] .'" title="View Province" data-toggle="tooltip">';
								echo $sql_prov["province"];
                            echo "</a> </li>";
                        }
                     } else {
                        echo "Coming soon!";
                        }
                    ?>                        
            </ul>	
        </section>


<!--- EXPLORE -->
		<section class="explore-hm" id="explore">
            <ul> 
          		<li> <h1> EXPLORE </h1> <a href="explore"> VIEW ALL </a></li>
                <?php
                    $sql_explore = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explorectg`.`category` NOT LIKE 'News' LIMIT 3";
                    include 'explore/explore-strip.php';                  
                    ?>
            </ul>
        </section>
        
		<section class="news-hm" id="explore">
        	<h1> NEWS AND WEATHER </h1>
            <div class="news-cont">
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
              <!--PHP FOR NEWS STARTS HERE-->
                <?php
                   $sql_explore = "SELECT * FROM `explore` WHERE `categoryid` = '3' LIMIT 3";
                    $result_explore = mysqli_query($conn, $sql_explore);
                                
					if (mysqli_num_rows($result_explore) > 0) {
					  while($sql_explore = mysqli_fetch_assoc($result_explore)) {
							echo "<div class='swiper-slide'>";
								echo "<img src='http://127.0.0.1/setcation/wp-uploads/explore-thumb/". $sql_explore["thumbimg"] ."'/>";
								echo '<a href="news/news.php?id='. $sql_explore['exploreid'] . '">';
									echo "<h2>". $sql_explore["articletitle"] ."</h2> </a> "; 
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
            </div>
            
            <div class="weather-cont">
<div id="ww_8f83b46168eaf" v='1.3' loc='id' a='{"t":"responsive","lang":"en","sl_lpl":1,"ids":["wl831"],"font":"Arial","sl_ics":"one_a","sl_sot":"celsius","cl_bkg":"image","cl_font":"#FFFFFF","cl_cloud":"#FFFFFF","cl_persp":"#81D4FA","cl_sun":"#FFC107","cl_moon":"#FFC107","cl_thund":"#FF5722","sl_tof":"5"}'>Weather Data Source: <a href="https://cuacalab.id/cuaca_manila/hari_ini/" id="ww_8f83b46168eaf_u" target="_blank">ramalan cuaca Manila hari ini</a></div><script async src="https://app1.weatherwidget.org/js/?id=ww_8f83b46168eaf"></script>
			</div>
        </section>
        

  
<!--FOOTER-->
		<?php include 'footer.php'?>        
 
  
  
        
</body>





    <script>
        window.onload = function() {
            var itemList = document.getElementById('item-list');
            var searchInput = document.getElementById('search-bar');
            searchInput.addEventListener('input', function() {
                var filter = this.value.toLowerCase();
                var items = itemList.getElementsByTagName('li');

                var hasResults = false;
                for (var i = 0; i < items.length; i++) {
                    var item = items[i];
                    var text = item.textContent || item.innerText;
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        item.style.display = '';
                        hasResults = true;
                    } else {
                        item.style.display = 'none';
                    }
                }

                if (hasResults) {
                    itemList.style.display = 'block';
                    document.getElementById('no-results').style.display = 'none';
                } else {
                    itemList.style.display = 'none';
                    document.getElementById('no-results').style.display = 'block';
                }
            });

            window.onbeforeunload = function() {
                // Hide the search results when leaving the page or refreshing
                itemList.style.display = 'none';
                document.getElementById('no-results').style.display = 'none';
            };
        };
    </script>    
      <!-- Swiper JS -->
  <script src="wp-themes/js/swiper-bundle.min.js"></script>

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


