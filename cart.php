<?php

session_start();

include "db.php";

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<a href="product.php">Continue shopping</a>

<br><br>

<table border="1">

<tr>
    <th>Brand</th>
    <th>Name</th>
    <th>Price</th>
    <th>Action</th>
</tr>

<?php foreach($cart as $id) {

    $result = mysqli_query($conn, "SELECT * FROM eproduct WHERE id=$id");

    $x = mysqli_fetch_assoc($result);

    $total = $total + $x['price'];

?>

<tr>

    <td>
        <?php echo $x['p_brand']; ?>
    </td>

    <td>
        <?php echo $x['p_name']; ?>
    </td>

    <td>
        ₹<?php echo $x['price']; ?>
    </td>

    <td>
        <a href="remove_cart.php?id=<?php echo $id; ?>">Remove</a>
    </td>

</tr>

<?php } ?>

</table>

<h3>Total: ₹<?php echo $total; ?></h3>

<?php if(count($cart) > 0) { ?>

    <a href="checkout.php">
        Place Order
    </a>

<?php } ?>