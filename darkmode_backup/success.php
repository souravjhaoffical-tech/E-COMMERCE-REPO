<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Successful | Shop Vibe</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .success-box {
            background: white;
            padding: 35px;
            border-radius: 16px;
            text-align: center;
            box-shadow: 0 5px 25px #00000015;
            max-width: 420px;
            margin: 20px;
        }
        .check {
            font-size: 55px;
            color: #16a34a;
        }
        h1 { color: #166534; }
        p { color: #555; line-height: 1.6; }
        a {
            display: inline-block;
            margin-top: 15px;
            padding: 12px 22px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="success-box">
        <div class="check">✓</div>
        <h1>Thank You!</h1>
        <h2>Order Status</h2>
        <p>Your order process has finished. Please check your order details before leaving this page.</p>
        <a href="index.php">Continue Shopping</a>
    </div>
</body>
</html>
