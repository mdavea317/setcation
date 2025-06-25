
<!--- NAV BAR-->
        <nav class="navbar">
			<a href="http://127.0.0.1/setcation"> <img class="logo" src="http://127.0.0.1/setcation/wp-themes/img/SETCATION-LOGO-H.png"> </a>
                
                
                <ul>
                    <!--li><a href="#">Calendar</a></li>
                    <li><a href="http://127.0.0.1/setcation/trending/">Trending</a></li>
                    <li><a href="http://127.0.0.1/setcation/most-recommended/">Most Recommended</a></li>
                    <li><a href="http://127.0.0.1/setcation/explore/">Explore</a></li>
                    <li><a href="http://127.0.0.1/setcation/news/">News &amp; Weather</a></li-->
                    <li>
                    	<?php
						if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
							echo "Hi ". htmlspecialchars($_SESSION["username"]);
							echo '<a href="http://127.0.0.1/setcation/setalist.php">SET A LIST</a>';
							echo '<a href="http://127.0.0.1/setcation/logout.php">Logout</a>';
						} else {
							echo "<a href='http://127.0.0.1/setcation/login.php'><i class='fa-solid fa-user'> </i> LOG IN </a> ";
						}
						?>
                    </li>
                    
                    
					<!--li><a href="http://127.0.0.1/setcation/login.php"><i class="fa-solid fa-user"> </i> LOG IN </a> </li>
                    <li> HI </li>
                    <li><a class="active" href="#">Traffic Advisory</a></li>
                    <li><i class="fa fa-search"> </i></li-->
                </ul>
          </nav>      
                

