<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>


	<div class="sidebar">
		<img src="http://127.0.0.1/lissa/admin/wp-themes/img/lissa_trans.png" alt="logo" /> <br />
        <span class="username"> HI <?php echo htmlspecialchars($_SESSION["username"]); ?> </span>
		<ul>
        	<li <?php if ($pgname=="dashboard") echo 'id="current"'; ?>><a href="http://127.0.0.1/lissa/admin/dashboard.php">DASHBOARD</a></li>
			<li <?php if ($pgname=="products") echo 'id="current"'; ?>><a href="http://127.0.0.1/lissa/admin/products">PRODUCTS</a></li>
			<li <?php if ($pgname=="productcat") echo 'id="current"'; ?>><a href="http://127.0.0.1/lissa/admin/productcat">PRODUCT CATEGORY</a></li>
			<li <?php if ($pgname=="reservation") echo 'id="current"'; ?>><a href="http://127.0.0.1/lissa/admin/reservation">RESERVATION</a></li>
			<li <?php if ($pgname=="users") echo 'id="current"'; ?>><a href="http://127.0.0.1/lissa/admin/users">USERS</a></li>
		</ul>
        <a href="http://127.0.0.1/lissa" target="_blank">VIEW LIVE SITE</a>
        <br />
		<a href="http://127.0.0.1/lissa/admin/logout.php">LOG OUT</a>
	</div>
    