<?php 
session_start(); 
if(empty($_SESSION['cart'])) { 
    header("Location: cart.php"); 
    exit(); 
} 
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ShopVibe</title>

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
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            overflow: hidden;
        }

        /* Background glow */

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
            animation: glow1 6s infinite alternate;
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
            animation: glow2 7s infinite alternate;
        }

        @keyframes glow1 {

            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(130px, 100px);
            }

        }

        @keyframes glow2 {

            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(-120px, -80px);
            }

        }

        /* Checkout Card */

        .checkout-card {

            position: relative;
            z-index: 2;

            width: 430px;
            padding: 40px;

            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(18px);

            border: 1px solid rgba(255, 255, 255, 0.15);

            border-radius: 22px;

            box-shadow:
                0 30px 60px rgba(0, 0, 0, 0.55),
                inset 0 1px rgba(255, 255, 255, 0.15);

            animation: cardIn 0.8s ease;

        }

        @keyframes cardIn {

            from {
                opacity: 0;
                transform: translateY(50px) rotateX(10deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }

        }

        /* Logo */

        .logo {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .logo span {
            color: #ff7a00;
        }

        .subtitle {
            text-align: center;
            color: #b8c4d4;
            margin-bottom: 30px;
        }

        /* Heading */

        h2 {
            text-align: center;
            margin-bottom: 8px;
            font-size: 27px;
        }

        h3 {
            margin-bottom: 18px;
            font-size: 17px;
            color: #dbe4ef;
        }

        /* Payment Box */

        .payment-box {

            background: rgba(0, 0, 0, 0.18);

            border: 1px solid rgba(255, 255, 255, 0.1);

            border-radius: 15px;

            padding: 20px;

            margin-bottom: 25px;

            transition: 0.3s;

        }

        .payment-box:hover {

            transform: translateY(-3px);

            box-shadow:
                0 12px 25px rgba(0, 0, 0, 0.25);

        }

        .payment-option {

            display: flex;
            align-items: center;
            gap: 12px;

            padding: 15px;

            background: rgba(255, 255, 255, 0.06);

            border-radius: 10px;

            cursor: pointer;

            transition: 0.3s;

        }

        .payment-option:hover {

            background: rgba(255, 122, 0, 0.12);

            transform: translateX(4px);

        }

        input[type="radio"] {

            width: 19px;
            height: 19px;

            accent-color: #ff7a00;

            cursor: pointer;

        }

        .cod-icon {

            font-size: 24px;

        }

        .cod-text {

            font-weight: bold;

        }

        .cod-small {

            display: block;
            font-size: 12px;
            color: #9eacbd;
            margin-top: 3px;

        }

        /* Confirm Button */

        button {

            width: 100%;

            padding: 15px;

            border: none;

            border-radius: 11px;

            background: linear-gradient(
                135deg,
                #ff7a00,
                #ff9d3d
            );

            color: white;

            font-size: 17px;

            font-weight: bold;

            cursor: pointer;

            box-shadow:
                0 8px 0 #b94f00,
                0 15px 25px rgba(255, 122, 0, 0.25);

            transition: 0.3s;

        }

        button:hover {

            transform: translateY(-5px);

            box-shadow:
                0 13px 0 #b94f00,
                0 20px 35px rgba(255, 122, 0, 0.35);

        }

        button:active {

            transform: translateY(2px);

            box-shadow:
                0 4px 0 #b94f00;

        }

        /* Back */

        .back {

            display: block;

            text-align: center;

            margin-top: 22px;

            color: #b8c4d4;

            text-decoration: none;

            transition: 0.3s;

        }

        .back:hover {

            color: #ff7a00;

        }

        /* Mobile */

        @media(max-width: 500px) {

            .checkout-card {

                width: 90%;
                padding: 28px 22px;

            }

            .logo {

                font-size: 26px;

            }

        }

    </style>

</head>

<body>

    <div class="checkout-card">

        <div class="logo">
            <span>Shop</span>Vibe
        </div>

        <p class="subtitle">
            Secure Checkout
        </p>

        <h2>Checkout</h2>

        <form action="place_order.php" method="POST">

            <div class="payment-box">

                <h3>Select Payment Method</h3>

                <label class="payment-option">

                    <input
                        type="radio"
                        name="payment_method"
                        value="COD"
                        required
                    >

                    <span class="cod-icon">💵</span>

                    <span>

                        <span class="cod-text">
                            Cash on Delivery
                        </span>

                        <span class="cod-small">
                            Pay when your order arrives
                        </span>

                    </span>

                </label>

            </div>

            <button type="submit" name="order">
                Confirm Order →
            </button>

        </form>

        <a href="cart.php" class="back">
            ← Back to Cart
        </a>

    </div>

</body>

</html>