<?php

session_start();

include "db.php";

$cart = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - ShopVibe</title>

    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
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
    letter-spacing: 1px;
    color: #222;
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
}

th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 17px;
    text-align: left;
    font-size: 15px;
}

td {
    padding: 17px;
    border-bottom: 1px solid #eee;
    color: #555;
    font-size: 15px;
}

tr {
    transition: background 0.2s;
}

tr:hover {
    background: #f5f6ff;
}

/* Remove Button */

.remove {
    display: inline-block;
    text-decoration: none;
    color: white;
    background: #e74c3c;
    padding: 8px 14px;
    border-radius: 7px;
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
}

.total-box h3 {
    font-size: 24px;
    color: #222;
}

.total-price {
    color: #667eea;
    font-weight: bold;
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
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
    transition: 0.3s;
}

.order-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
}

/* Mobile Responsive */

@media (max-width: 600px) {
    body {
        padding: 20px 12px;
    }

    .cart-container {
        width: 100%;
        padding: 20px 15px;
    }

    .cart-title h1 {
        font-size: 28px;
    }

    th,
    td {
        padding: 12px;
        font-size: 13px;
        white-space: nowrap;
    }

    .total-box {
        flex-direction: column;
        align-items: flex-start;
        gap: 12px;
    }

    .total-box h3 {
        font-size: 21px;
    }

    .order-btn {
        width: 100%;
        text-align: center;
    }
}
    </style>

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


    <div class="table-box">

        <table>

            <tr>

                <th>NAME</th>

                <th>PRICE</th>

                <th>ACTION</th>

            </tr>


            <?php foreach($cart as $id) {

                $id = (int)$id;

                $result = mysqli_query($conn, "SELECT * FROM eproduct WHERE id=$id");

                $x = mysqli_fetch_assoc($result);

                if (!$x) {
                    continue;
                }

                $total = $total + $x['p_price'];

            ?>

            <tr>

                <td>
                    <?php echo $x['p_name']; ?>
                </td>

                <td>
                    ₹<?php echo $x['p_price']; ?>
                </td>

                <td>

                    <a
                        href="remove_cart.php?id=<?php echo $id;?>"
                        class="remove">
                        Remove
                    </a>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>


    <div class="total-box">

        <h3>
            Total:
            <span class="total-price">
                ₹<?php echo $total;?>
            </span>
        </h3>

    </div>


    <?php if(count($cart)>0) {?>

        <a href="checkout.php" class="order-btn">
            Place Order →
        </a>

    <?php } ?>

</div>

</body>

</html>