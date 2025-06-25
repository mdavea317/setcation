<?php
	require_once "../config.php"; 


	
// Remove item from cart if the remove parameter is provided
if (isset($_GET['remove'])) {
    $removeIndex = $_GET['remove'];
    if (isset($_SESSION['cart'][$removeIndex])) {
        unset($_SESSION['cart'][$removeIndex]);
    }
    header("Location: cart.php");
    exit();
}
?>




<h1>Shopping Cart</h1>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
    </tr>
    <?php foreach ($_SESSION['cart'] as $index => $item) : ?>
        <tr>
            <td><?php echo $item['destID']; ?></td>
            <td><?php echo $item['destination']; ?></td>
            <td>
                <a href="cart.php?remove=<?php echo $index; ?>">Remove</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="checkout.php" method="post">
    <button type="submit">Checkout</button>
</form>