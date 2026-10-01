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
            background: linear-gradient(135deg, #07111f, #102a43, #07111f);
            color: white;
            padding: 40px 20px;
            overflow-x: hidden;
        }

        /* Background animation */

        body::before {
            content: "";
            position: fixed;
            width: 350px;
            height: 350px;
            background: #ff7a00;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.18;
            top: -100px;
            left: -100px;
            animation: move 6s infinite alternate;
        }

        body::after {
            content: "";
            position: fixed;
            width: 300px;
            height: 300px;
            background: #0077ff;
            border-radius: 50%;
            filter: blur(120px);
            opacity: 0.18;
            bottom: -100px;
            right: -100px;
            animation: move2 7s infinite alternate;
        }

        @keyframes move {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(150px, 100px);
            }
        }

        @keyframes move2 {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-120px, -80px);
            }
        }

        /* Main container */

        .cart-container {
            position: relative;
            z-index: 2;
            width: 90%;
            max-width: 1000px;
            margin: auto;
            padding: 35px;
            border-radius: 20px;

            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(15px);

            border: 1px solid rgba(255, 255, 255, 0.15);

            box-shadow:
                0 25px 50px rgba(0, 0, 0, 0.5),
                inset 0 1px rgba(255, 255, 255, 0.15);

            animation: containerIn 0.8s ease;
        }

        @keyframes containerIn {

            from {
                opacity: 0;
                transform: translateY(40px) rotateX(8deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }

        }

        /* Heading */

        .cart-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .cart-title h1 {
            font-size: 36px;
            letter-spacing: 2px;
        }

        .cart-title span {
            color: #ff7a00;
        }

        .cart-title p {
            color: #b8c4d4;
            margin-top: 8px;
        }

        /* Continue shopping */

        .continue {
            display: inline-block;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #ff7a00, #ff9d3d);
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 25px;

            box-shadow:
                0 8px 0 #b94f00,
                0 15px 25px rgba(255, 122, 0, 0.25);

            transition: 0.3s;
        }

        .continue:hover {
            transform: translateY(-4px);
            box-shadow:
                0 12px 0 #b94f00,
                0 20px 30px rgba(255, 122, 0, 0.35);
        }

        /* Table */

        .table-box {
            overflow-x: auto;
            border-radius: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            background: rgba(0, 0, 0, 0.2);
        }

        th {
            background: #ff7a00;
            color: white;
            padding: 17px;
            text-align: left;
            font-size: 16px;
        }

        td {
            padding: 17px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #e8edf5;
        }

        tr {
            transition: 0.3s;
        }

        tr:hover {
            background: rgba(255, 122, 0, 0.08);
            transform: scale(1.01);
        }

        /* Remove button */

        .remove {
            text-decoration: none;
            color: white;
            background: #d93636;
            padding: 8px 14px;
            border-radius: 7px;
            transition: 0.3s;
        }

        .remove:hover {
            background: #ff4d4d;
            box-shadow: 0 5px 15px rgba(255, 50, 50, 0.3);
        }

        /* Total */

        .total-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 25px;
            padding: 20px;

            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;

            box-shadow: inset 0 0 15px rgba(255,255,255,0.03);
        }

        .total-box h3 {
            font-size: 24px;
        }

        .total-price {
            color: #ff7a00;
        }

        /* Place order */

        .order-btn {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: white;

            background: linear-gradient(135deg, #ff7a00, #ff9d3d);

            padding: 14px 30px;
            border-radius: 10px;

            font-size: 17px;
            font-weight: bold;

            box-shadow:
                0 8px 0 #b94f00,
                0 15px 25px rgba(255, 122, 0, 0.25);

            transition: 0.3s;
        }

        .order-btn:hover {
            transform: translateY(-5px);
            box-shadow:
                0 13px 0 #b94f00,
                0 20px 35px rgba(255, 122, 0, 0.35);
        }

        /* Mobile */

        @media(max-width: 600px) {

            .cart-container {
                width: 100%;
                padding: 20px;
            }

            .cart-title h1 {
                font-size: 28px;
            }

            th,
            td {
                padding: 12px;
                font-size: 14px;
            }

            .total-box {
                flex-direction: column;
                gap: 15px;
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


    <a href="product.php" class="continue">
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