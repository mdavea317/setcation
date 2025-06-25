                <?php
                    $result_explore = mysqli_query($conn, $sql_explore);
                                
                                if (mysqli_num_rows($result_explore) > 0) {
                                  while($sql_explore = mysqli_fetch_assoc($result_explore)) {
									echo "<li>";
									echo '<a href="http://127.0.0.1/setcation/explore/explore.php?id='. $sql_explore['exploreid'] . '">';
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
