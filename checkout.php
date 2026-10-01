<?php
session_start();

if(empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<h2>Checkout</h2>
<form action="place_order.php" method="POST">
    <h3>Select Payment Method:</h3>
    <input type="radio" name="payment_method" value="COD" required>
    Cash on Delivery (COD)<br>
    <button type="submit" name="order">Confirm Order</button>
</form>