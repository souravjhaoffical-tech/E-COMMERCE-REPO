<?php

session_start();
include "db.php";

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Remove product from cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = (int)($_POST['id'] ?? 0);
    $action = $_POST['action'] ?? '';

    if ($id > 0 && $action == 'remove') {

        $_SESSION['cart'] = array_values(
            array_filter(
                $_SESSION['cart'],
                function($cartId) use ($id) {
                    return (int)$cartId != $id;
                }
            )
        );
    }

    header("Location: cart.php");
    exit();
}

$cart = $_SESSION['cart'];

$total = 0;
$totalQuantity = count($cart);
$quantities = [];

// Calculate product quantities
foreach ($cart as $id) {

    $id = (int)$id;

    if ($id > 0) {
        $quantities[$id] = ($quantities[$id] ?? 0) + 1;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - ShopVibe</title>

    <!-- Professional Inter Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Inter', sans-serif;
}

body {
    min-height: 100vh;
    background: #f5f6fa;
    color: #222;
    padding: 40px 20px;
}

/* Main Cart Container */

.cart-container {
    position: relative;
    width: 90%;
    max-width: 1000px;
    margin: 0 auto;
    padding: 35px;
    border-radius: 20px;
    background: white;
    border: 1px solid #eee;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    animation: containerIn 0.6s ease;
}

@keyframes containerIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Heading */

.cart-title {
    text-align: center;
    margin-bottom: 30px;
}

.cart-title h1 {
    font-size: 36px;
    letter-spacing: -1px;
    color: #222;
    font-weight: 800;
}

.cart-title span {
    color: #667eea;
}

.cart-title p {
    color: #777;
    margin-top: 8px;
    font-size: 15px;
}

/* Continue Shopping */

.continue {
    display: inline-block;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 12px 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    transition: 0.3s;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    font-weight: 600;
}

.continue:hover {
    transform: translateY(-3px);
    box-shadow: 0 7px 18px rgba(102, 126, 234, 0.3);
}

/* Table */

.table-box {
    overflow-x: auto;
    border-radius: 12px;
    border: 1px solid #eee;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    min-width: 650px;
}

th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 17px;
    text-align: left;
    font-size: 14px;
}

td {
    padding: 17px;
    border-bottom: 1px solid #eee;
    color: #555;
    font-size: 14px;
}

tr {
    transition: background 0.2s;
}

tr:hover {
    background: #f5f6ff;
}

/* Quantity Buttons */

.quantity-control {
    display: flex;
    align-items: center;
    gap: 12px;
}

.quantity-control form {
    display: inline;
}

.qty-btn {
    width: 32px;
    height: 32px;
    border: none;
    border-radius: 8px;
    background: #667eea;
    color: white;
    font-size: 20px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.qty-btn:hover {
    background: #764ba2;
    transform: scale(1.08);
}

.qty-number {
    font-size: 15px;
    font-weight: 700;
    color: #222;
    min-width: 20px;
    text-align: center;
}

/* Remove Button */

.remove {
    border: none;
    color: white;
    background: #e74c3c;
    padding: 9px 14px;
    border-radius: 7px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.3s;
}

.remove:hover {
    background: #c0392b;
    transform: translateY(-2px);
}

/* Total */

.total-box {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 25px;
    padding: 22px;
    background: #f5f6fa;
    border: 1px solid #eee;
    border-radius: 12px;
    gap: 15px;
}

.total-box h3 {
    font-size: 20px;
    color: #222;
}

.total-price {
    color: #667eea;
    font-weight: 800;
}

/* Place Order */

.order-btn {
    display: inline-block;
    margin-top: 20px;
    text-decoration: none;
    color: white;
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 14px 30px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    transition: 0.3s;
}

.order-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

/* Empty Cart */

.empty-cart {
    text-align: center;
    padding: 40px 15px;
    color: #777;
}

.empty-cart h2 {
    color: #333;
    margin-bottom: 10px;
}

/* Mobile Responsive */

@media (max-width: 600px) {

    body {
        padding: 20px 12px;
    }

    .cart-container {
        width: 100%;
        padding: 20px 12px;
    }

    .cart-title h1 {
        font-size: 26px;
    }

    th, td {
        padding: 12px;
        font-size: 13px;
        white-space: nowrap;
    }

    .total-box {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .order-btn {
        display: block;
        width: 100%;
        text-align: center;
    }

}

    </style>

    <link rel="stylesheet" href="darkmode/darkmode.css">
    <script src="darkmode/darkmode-head.js"></script>

</head>

<body>

<div class="cart-container">

    <div class="cart-title">

        <h1>🛒 <span>Shop</span>Vibe Cart</h1>

        <p>Your selected products</p>

    </div>

    <a href="users_home.php" class="continue">
        ← Continue Shopping
    </a>

    <?php if (empty($quantities)) { ?>

        <div class="empty-cart">

            <h2>Your Cart is Empty!</h2>

            <p>Add some products to get started.</p>

        </div>

    <?php } else { ?>

    <div class="table-box">

        <table>

            <tr>
                <th>NAME</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>SUBTOTAL</th>
                <th>ACTION</th>
            </tr>

            <?php

            foreach ($quantities as $id => $quantity) {

                $id = (int)$id;

                $result = mysqli_query(
                    $conn,
                    "SELECT * FROM eproduct WHERE id=$id"
                );

                $x = mysqli_fetch_assoc($result);

                if (!$x) {
                    continue;
                }

                $price = (float)$x['p_price'];

                $subtotal = $price * $quantity;

                $total += $subtotal;

            ?>

            <tr>

                <td>
                    <?php echo htmlspecialchars($x['p_name']); ?>
                </td>

                <td>
                    ₹<?php echo number_format($price, 2); ?>
                </td>

                <td>

                    <div class="quantity-control">
    <span class="qty-number">
        <?php echo $quantity; ?>
    </span>
</div>
                </td>

                <td>
                    <strong>
                        ₹<?php echo number_format($subtotal, 2); ?>
                    </strong>
                </td>

                <td>

                    <form method="POST" action="cart.php">

                        <input type="hidden" name="id"
                            value="<?php echo $id; ?>">

                        <input type="hidden" name="action"
                            value="remove">

                        <button type="submit" class="remove">
                            Remove
                        </button>

                    </form>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

    <!-- Total Section -->

    <div class="total-box">

        <h3>
            Total Quantity:

            <span class="total-price">
                <?php echo $totalQuantity; ?>
            </span>
        </h3>

        <h3>
            Total:

            <span class="total-price">
                ₹<?php echo number_format($total, 2); ?>
            </span>
        </h3>

    </div>

    <a href="checkout.php" class="order-btn">
        Place Order →
    </a>

    <?php } ?>

</div>

<script src="darkmode/darkmode.js"></script>

</body>

</html>