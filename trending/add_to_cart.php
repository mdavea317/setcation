<?php
	require_once "../config.php"; 

// Check if the destination ID is provided
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Get the destination ID from the URL
$destID = $_GET['id'];

// Query the selected destination from the database
$sql = "SELECT * FROM destinations WHERE destID = $destID";
$result = $conn->query($sql);

// Check if the destination exists
if ($result->num_rows == 0) {
    header("Location: index.php");
    exit();
}

// Get the destination details
$destination = $result->fetch_assoc();

// Add the destination to the cart session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Add the destination to the cart session
$_SESSION['cart'][] = $destination;

// Redirect back to the destination listing page
$lastPage = $_SERVER['HTTP_REFERER'];
header("Location: " . $lastPage);
exit();
?>
