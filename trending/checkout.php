<?php

require_once "../config.php"; 

// Check if the cart is empty
if (empty($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

// Retrieve the user ID from your authentication system or session data


// Generate a unique transaction ID
$transactionId = uniqid();

// Prepare the SQL statement with a parameterized query to prevent SQL injection
$query = "SELECT userID FROM users WHERE username = ?";
$stmt = $conn->prepare($query);

// Bind the parameter
$stmt->bind_param("s", $username);

// Set the username value
$username = htmlspecialchars($_SESSION["username"]);

// Execute the query
$stmt->execute();

// Bind the result to a variable
$stmt->bind_result($userId);

// Fetch the result
$stmt->fetch();

// Close the statement and database connection
$stmt->close();

// Save the cart contents and transaction ID to the database
foreach ($_SESSION['cart'] as $item) {
    $destID = $item['destID'];
    $destination = $item['destination'];

    // Perform an SQL INSERT operation to save the cart item in the database along with the transaction ID
    $sql = "INSERT INTO likes (transactionID, userID, destID, destination) VALUES ('$transactionId', '$userId', '$destID', '$destination')";
    $conn->query($sql);
}

// Clear the cart session after saving the cart items
$_SESSION['cart'] = array();

// Redirect to a thank you page or any other appropriate page, passing the transaction ID as a parameter
header("Location: thank_you.php?transaction_id=" . $transactionId);
exit();
?>
