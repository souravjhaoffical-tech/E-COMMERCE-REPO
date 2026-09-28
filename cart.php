<?php

session_start();

include "db.php";

$cart_items = $_SESSION['cart'] ?? [];

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Shopping Cart - Shop Vibe</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            padding: 40px 20px;
            color: #333;
        }

        /* Main Cart Container */

        .cart-container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.20);
        }

        /* Heading */

        .cart-title {
            text-align: center;
            color: #222;
            margin-bottom: 25px;
            font-size: 30px;
        }

        /* Continue Shopping Button */

        .continue-shopping {
            display: inline-block;
            text-decoration: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 25px;
            transition: 0.3s;
        }

        .continue-shopping:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.35);
        }

        /* Table Wrapper */

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        /* Cart Table */

        .cart-table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 12px;
        }

        /* Table Heading */

        .cart-table th {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 16px;
            text-align: center;
            font-size: 15px;
        }

        /* Table Cells */

        .cart-table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #eee;
            font-size: 15px;
        }

        /* Alternate Rows */

        .cart-table tr:nth-child(even) {
            background: #f8f8ff;
        }

        /* Hover Effect */

        .cart-table tbody tr:hover {
            background: #f0efff;
            transition: 0.2s;
        }

        /* Total Row */

        .total-row {
            background: #f3f1ff !important;
        }

        .total-row td {
            font-size: 17px;
            color: #222;
            padding: 18px 15px;
        }

        /* Total Amount */

        .total-amount {
            color: #667eea;
            font-size: 20px;
        }

        /* Empty Cart */

        .empty-cart {
            text-align: center;
            padding: 40px 20px;
            color: #777;
            font-size: 18px;
        }

        /* Mobile Responsive */

        @media (max-width: 600px) {

            body {
                padding: 20px 10px;
            }

            .cart-container {
                padding: 20px 12px;
                border-radius: 15px;
            }

            .cart-title {
                font-size: 24px;
            }

            .cart-table th,
            .cart-table td {
                padding: 12px 8px;
                font-size: 13px;
            }

            .continue-shopping {
                width: 100%;
                text-align: center;
            }

        }

    </style>

</head>

<body>

    <div class="cart-container">

        <h1 class="cart-title">
            🛒 Your Shopping Cart
        </h1>

        <a href="products.php" class="continue-shopping">
            ← Continue Shopping
        </a>

        <?php if (empty($cart_items)): ?>

            <div class="empty-cart">

                <p>🛒 Your cart is empty.</p>

                <p style="margin-top: 10px;">
                    Add some products to your cart!
                </p>

            </div>

        <?php else: ?>

            <div class="table-wrapper">

                <table class="cart-table">

                    <thead>

                        <tr>

                            <th>Product Name</th>

                            <th>Price</th>

                            <th>Quantity</th>

                            <th>Total</th>

                        </tr>

                    </thead>

                    <tbody>

                       <?php foreach ($cart_items as $item): ?>

    <?php
    $name = $item['name'] ?? 'Unknown Product';
    $price = (float)($item['price'] ?? 0);
    $quantity = (int)($item['quantity'] ?? 1);
    $item_total = $price * $quantity;

    $total += $item_total;
    ?>

    <tr>

            <td>
                <?php echo htmlspecialchars($name); ?>
            </td>

            <td>
                ₹<?php echo number_format($price, 2); ?>
            </td>

            <td>
                <?php echo $quantity; ?>
             </td>

                <td>
                    ₹<?php echo number_format($item_total, 2); ?>
                </td>

                    </tr>

                        <?php endforeach; ?>

                        <tr class="total-row">

                            <td colspan="3">
                                <strong>Grand Total</strong>
                            </td>

                            <td class="total-amount">

                                <strong>
                                    ₹<?php echo number_format($total, 2); ?>
                                </strong>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        <?php endif; ?>

    </div>

</body>

</html>