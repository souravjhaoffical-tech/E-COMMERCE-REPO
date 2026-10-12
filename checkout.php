<?php
session_start();

if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Shop Vibe</title>

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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 25px 15px;
            color: #222;
        }

        /* Checkout Card */

        .checkout-card {
            width: 100%;
            max-width: 450px;
            padding: 35px;
            background: #fff;
            border: 1px solid #eee;
            border-radius: 20px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            animation: cardIn 0.6s ease;
        }

        @keyframes cardIn {
            from {
                opacity: 0;
                transform: translateY(25px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Logo */

        .logo {
            text-align: center;
            font-size: 30px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 28px;
        }

        h2 {
            text-align: center;
            font-size: 28px;
            margin-bottom: 25px;
            color: #222;
        }

        h3 {
            font-size: 17px;
            color: #333;
            margin-bottom: 17px;
        }

        /* Payment Box */

        .payment-box {
            background: #f8f9ff;
            border: 1px solid #e8eaff;
            border-radius: 14px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            margin-bottom: 12px;
            background: #fff;
            border: 1px solid #e5e7f2;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.25s;
        }

        .payment-option:last-child {
            margin-bottom: 0;
        }

        .payment-option:hover {
            border-color: #667eea;
            background: #f5f6ff;
            transform: translateY(-2px);
        }

        input[type="radio"] {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            accent-color: #667eea;
            cursor: pointer;
        }

        .payment-icon {
            font-size: 23px;
        }

        .payment-name {
            display: block;
            color: #333;
            font-weight: bold;
        }

        .payment-description {
            display: block;
            font-size: 12px;
            color: #777;
            margin-top: 5px;
            line-height: 1.4;
        }

        /* Confirm Button */

        .confirm-btn {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
            transition: 0.3s;
        }

        .confirm-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .confirm-btn:active {
            transform: translateY(0);
        }

        /* Back to Cart */

        .back {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .back:hover {
            color: #764ba2;
        }

        /* Mobile */

        @media (max-width: 500px) {
            .checkout-card {
                padding: 27px 20px;
            }

            .logo {
                font-size: 27px;
            }

            h2 {
                font-size: 25px;
            }

            .payment-box {
                padding: 15px;
            }
        }
    </style>
</head>

<body>

    <div class="checkout-card">

        <div class="logo">🛒 Shop Vibe</div>

        <p class="subtitle">Secure Checkout</p>

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

                    <span class="payment-icon">💵</span>

                    <span>
                        <span class="payment-name">
                            Cash on Delivery
                        </span>
                        <span class="payment-description">
                            Pay when your order arrives
                        </span>
                    </span>
                </label>

                <label class="payment-option">
                    <input
                        type="radio"
                        name="payment_method"
                        value="razorpay"
                        required
                    >

                    <span class="payment-icon">💳</span>

                    <span>
                        <span class="payment-name">
                            Online Payment
                        </span>
                        <span class="payment-description">
                            Pay online using Razorpay
                        </span>
                    </span>
                </label>

            </div>

            <button
                type="submit"
                name="order"
                class="confirm-btn"
            >
                Confirm Order →
            </button>

        </form>

        <a href="cart.php" class="back">
            ← Back to Cart
        </a>

    </div>

</body>
</html>