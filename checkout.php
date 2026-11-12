
<?php
session_start();
require_once "db.php";

$cart = $_SESSION['cart'] ?? [];
$products = [];
$total = 0;

// Empty cart check
if (empty($cart)) {
    header("Location: cart.php");
    exit();
}

// Login check
if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user'
) {
    $_SESSION['redirect_after_login'] = 'checkout.php';
    header("Location: login.php");
    exit();
}

// Fetch each cart item safely
$stmt = mysqli_prepare(
    $conn,
    "SELECT id, p_name, p_price FROM eproduct WHERE id = ?"
);

if (!$stmt) {
    die("Unable to prepare checkout.");
}

foreach ($cart as $cartId) {
    $id = filter_var($cartId, FILTER_VALIDATE_INT);

    if ($id === false || $id === null || $id <= 0) {
        continue;
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if ($product) {
        $product['p_price'] = (float) $product['p_price'];
        $products[] = $product;
        $total += $product['p_price'];
    }
}

mysqli_stmt_close($stmt);

if (empty($products)) {
    header("Location: cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Checkout - Shop Vibe</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            color: #222;
            padding: 30px 15px;
        }

        .checkout-container {
            max-width: 1000px;
            margin: auto;
        }

        .heading {
            text-align: center;
            margin-bottom: 25px;
        }

        .heading h1 {
            font-size: 32px;
            margin-bottom: 8px;
        }

        .heading span {
            color: #667eea;
        }

        .heading p {
            color: #666;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 25px;
        }

        .checkout-card {
            background: #fff;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid #e8e8e8;
            box-shadow: 0 5px 18px rgba(0,0,0,0.06);
        }

        h2 {
            font-size: 21px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 17px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            font-size: 14px;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d5d8e0;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        input:focus,
        textarea:focus {
            border-color: #667eea;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .product-row {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            padding: 13px 0;
            border-bottom: 1px solid #eee;
        }

        .product-name {
            overflow-wrap: anywhere;
        }

        .product-price {
            font-weight: bold;
            white-space: nowrap;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #eee;
            font-size: 21px;
            font-weight: bold;
        }

        .total-amount {
            color: #667eea;
        }

        .back-link {
            display: inline-block;
            margin-top: 22px;
            color: #5266d8;
            text-decoration: none;
            font-weight: bold;
        }

        .notice {
            margin-top: 20px;
            padding: 12px;
            border-radius: 8px;
            background: #fff4dc;
            color: #795500;
            font-size: 13px;
            line-height: 1.5;
        }

        /* Form improvements */
        .checkout-form {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .checkout-form label:not(.payment-option) {
            margin-bottom: -5px;
        }

        .checkout-form input:not([type="radio"]),
        .checkout-form textarea {
            transition: 0.3s ease;
        }

        .checkout-form input:not([type="radio"]):focus,
        .checkout-form textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.12);
        }

        /* Payment options */
        .payment-option {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 13px;
            margin: 0;
            border: 1px solid #e8e8e8;
            border-radius: 9px;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .payment-option:hover {
            border-color: #667eea;
            background: rgba(102, 126, 234, 0.05);
        }

        .payment-option input[type="radio"] {
            width: auto;
            margin: 0;
            accent-color: #667eea;
            cursor: pointer;
            flex-shrink: 0;
        }

        .payment-heading {
            font-size: 17px;
            margin: 15px 0 5px;
        }

        /* Confirm Order Button */
        .confirm-order-btn {
            width: 100%;
            min-height: 52px;
            padding: 13px 20px;
            margin-top: 10px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #5266d8);
            color: #fff;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.3px;
            cursor: pointer;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;

            box-shadow: 0 5px 14px rgba(102, 126, 234, 0.25);
            transition: all 0.25s ease;
        }

        .confirm-order-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.35);
        }

        .confirm-order-btn:active {
            transform: scale(0.98);
        }

        .btn-arrow {
            font-size: 22px;
            transition: transform 0.25s ease;
        }

        .confirm-order-btn:hover .btn-arrow {
            transform: translateX(5px);
        }

        /* Mobile responsive */
        @media (max-width: 700px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .heading h1 {
                font-size: 27px;
            }

            .checkout-card {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 18px 12px;
            }

            .checkout-card {
                padding: 17px;
            }

            .confirm-order-btn {
                min-height: 48px;
                font-size: 15px;
            }
        }
    </style>

    <link rel="stylesheet" href="darkmode/darkmode.css">
    <script src="darkmode/darkmode-head.js"></script>

</head>

<body>

<div class="checkout-container">

    <header class="heading">
        <h1>🛍️ Shop <span>Vibe</span> Checkout</h1>
        <p>Review your order and enter your delivery details.</p>
    </header>

    <div class="checkout-layout">

        <!-- Delivery Details -->
        <section class="checkout-card">

            <h2>📦 Delivery Details</h2>

            <form action="place_order.php" method="POST" class="checkout-form">

                <label for="customer_name">Full Name</label>
                <input
                    type="text"
                    id="customer_name"
                    name="customer_name"
                    required
                    maxlength="100"
                >

                <label for="phone">Phone Number</label>
                <input
                    type="tel"
                    id="phone"
                    name="phone"
                    required
                    maxlength="15"
                    pattern="[0-9+ -]{10,15}"
                >

                <label for="address">Full Address</label>
                <textarea
                    id="address"
                    name="address"
                    required
                    maxlength="500"
                ></textarea>

                <label for="city">City</label>
                <input
                    type="text"
                    id="city"
                    name="city"
                    required
                    maxlength="100"
                >

                <label for="pincode">PIN Code</label>
                <input
                    type="text"
                    id="pincode"
                    name="pincode"
                    required
                    pattern="[0-9]{6}"
                    maxlength="6"
                >

                <h3 class="payment-heading">Select Payment Method</h3>

                <label class="payment-option">
                    <input
                        type="radio"
                        name="payment_method"
                        value="COD"
                        required
                    >
                    <span>Cash on Delivery</span>
                </label>

                <label class="payment-option">
                    <input
                        type="radio"
                        name="payment_method"
                        value="Razorpay"
                        required
                    >
                    <span>Pay Online with Razorpay</span>
                </label>

                <button type="submit" name="order" value="1" class="confirm-order-btn">
                    <span>Confirm Order</span>
                    <span class="btn-arrow">→</span>
                </button>

            </form>

            <a class="back-link" href="cart.php">
                ← Back to Cart
            </a>

        </section>

        <!-- Order Summary -->
        <section class="checkout-card">

            <h2>🛒 Order Summary</h2>

            <?php foreach ($products as $product): ?>

                <div class="product-row">

                    <span class="product-name">
                        <?= htmlspecialchars(
                            $product['p_name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </span>

                    <span class="product-price">
                        ₹<?= number_format($product['p_price'], 2) ?>
                    </span>

                </div>

            <?php endforeach; ?>

            <div class="total-row">

                <span>Total</span>

                <span class="total-amount">
                    ₹<?= number_format($total, 2) ?>
                </span>

            </div>

        </section>

    </div>

</div>

<script src="darkmode/darkmode.js"></script>

</body>
</html>
