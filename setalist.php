<?php
	require_once "config.php"; 


	
// Remove item from cart if the remove parameter is provided
if (isset($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
    }
    header("Location: setalist.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SET A LIST | SETCATION</title>
    <link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="wp-themes/css/setcation-style.css">
   <link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   
   
   

</head>
<body class="setalist">

<!--HEADER-->
		<?php include 'header.php'?>        
         <br>
        <br>

        <h1>SET A LIST</h1>
 
 		<div class="wrapper">      
        <table>
		  <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
                <tr>
                    <td width="150px"><img src="wp-uploads/202304/<?php echo $item['thumbimg']; ?>"></td>
                    <td id="placetit"><a target="_blank" href="http://127.0.0.1/setcation/destinations.php?id=<?php echo $item['destID']; ?>"> <?php echo $item['destination']; ?> </a> </td>
                    <td id="close">
                        <a href="setalist.php?remove=<?php echo $index; ?>">&times;</a>
                    </td>
                </tr>
			  <?php endforeach; ?>
            </table>
                    
            <form action="checkout.php" method="post">
              <button type="submit" id="btn">Save</button>
            </form>
         </div>

<!--FOOTER-->
		<?php include 'footer.php'?>        
 
</body>
</html>