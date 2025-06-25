<!DOCTYPE html>
<html lang="en">

<?php require_once "../config.php";

    // Prepare a select statement
    $sql = "SELECT `explore`.*, `explorectg`.`category` FROM `explore` LEFT JOIN `explorectg` ON `explorectg`.`categoryid` = `explore`.`categoryid` WHERE `explore`.`exploreid` = ?";
    
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
                $articletitle = $row["articletitle"];
                $articledesc = $row["articledesc"];
				$thumbimg = $row["thumbimg"];

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
    <title><?php echo strtoupper($row["articletitle"]); ?> | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="../wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="../wp-themes/css/swiper-bundle.min.css">   
   
   

</head>
<body class="explore">

<!--HEADER-->
		<?php include '../header.php'?>        
        
<!--SLIDER--->

		<section class="section1">
            <img src="http://127.0.0.1/setcation/wp-uploads/explore-thumb/<?php echo $row["thumbimg"]; ?>" />
            <div class="text-cont">
                <h3 style="text-transform: uppercase;"> <a href="http://127.0.0.1/setcation/explore/explore-ctg.php?id=<?php echo $row["categoryid"]; ?>"> <?php echo $row["category"]; ?> </a> </h3>
                <h1> <?php echo $row["articletitle"]; ?> </h1>
			</div>
        </section>

		<section class="wrapper">
        	<div class="breadcrumbs">
        	<a href="http://127.0.0.1/setcation/explore/"> Explore </a> &gt;
            <a href="http://127.0.0.1/setcation/explore/explore-ctg.php?id=<?php echo $row["categoryid"]; ?>"> <?php echo $row["category"]; ?> </a> &gt;
            <b> <?php echo $row["articletitle"]; ?> </b>
        	</div>
        
                <span class="aboutthis">	
                    <?php echo $row["articledesc"]; ?> </p>
                </span>

		<br> <br>
		</section>
        
        
<!--FOOTER-->
		<?php include '../footer.php'?>        
 
  
  
        
</body>




  <!-- Swiper JS -->
  <script src="../wp-themes/js/swiper-bundle.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper(".mySwiper", {
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>

	<script src="../wp-themes/js/readmore.js"></script>

</html>


