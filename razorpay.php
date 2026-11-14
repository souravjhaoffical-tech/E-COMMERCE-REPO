
<?php

session_start();

include "db.php";
include "config.php";

// Keep your existing session_start(), db.php and config.php above.


// ==========================================
// CHECK USER AND CHECKOUT SESSION
// ==========================================

if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user' ||
    empty($_SESSION['cart']) ||
    empty($_SESSION['checkout_customer']) ||
    !isset($_SESSION['checkout_total'])
) {
    exit("Invalid checkout session. Please restart checkout.");
}


// ==========================================
// FETCH PRODUCTS AND CHECK STOCK
// ==========================================

$total = 0;
$courses = [];
$quantities = [];

foreach ($_SESSION['cart'] as $cartId) {

    $id = filter_var($cartId, FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        exit("Invalid product in cart.");
    }

    $quantities[$id] = ($quantities[$id] ?? 0) + 1;
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, p_name, p_price, image, stock_quantity
     FROM eproduct
     WHERE id = ?"
);

if (!$stmt) {
    exit("Unable to prepare product query.");
}

foreach ($quantities as $id => $quantity) {

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        exit("Unable to fetch product.");
    }

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if (!$row || !is_numeric($row['p_price']) || $row['p_price'] <= 0) {
        exit("Invalid or unavailable product.");
    }

    if ((int)$row['stock_quantity'] < $quantity) {
        exit(
            "Insufficient stock for " .
            htmlspecialchars($row['p_name'], ENT_QUOTES, 'UTF-8')
        );
    }

    $total += (float)$row['p_price'] * $quantity;

    // Preserve the existing repeated-product cart format.
    for ($i = 0; $i < $quantity; $i++) {
        $courses[] = $row;
    }
}

mysqli_stmt_close($stmt);


// ==========================================
// VERIFY CHECKOUT AMOUNT
// ==========================================

$checkoutTotal = (float)$_SESSION['checkout_total'];

if (
    abs($total - $checkoutTotal) > 0.01 ||
    $total <= 0
) {
    exit("Checkout amount mismatch. Please restart checkout.");
}

$amount = (int)round($total * 100);


// ==========================================
// CREATE RAZORPAY ORDER
// ==========================================

try {

    $order = $api->order->create([
        "amount" => $amount,
        "currency" => "INR"
    ]);

} catch (\Throwable $e) {

    error_log("Razorpay order creation error: " . $e->getMessage());

    echo "Razorpay Error: " .
         htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');

    exit();
}

// ==========================================
// SAVE RAZORPAY SESSION DETAILS
// ==========================================

$_SESSION['rzp_order'] = $order['id'];
$_SESSION['rzp_amount'] = $amount;
$_SESSION['rzp_product'] = $courses;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Online Payment - ShopVibe</title>

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
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: #f4f6fb;
            color: #222;
        }

        .payment-container {
            width: 100%;
            max-width: 460px;
            padding: 40px 32px;
            background: #ffffff;
            border: 1px solid #e8e8e8;
            border-radius: 18px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
        }

        .payment-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(102, 126, 234, 0.12);
            border-radius: 50%;
            font-size: 32px;
        }

        h2 {
            font-size: 27px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .payment-description {
            color: #777;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .amount-box {
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e8e8e8;
            border-radius: 12px;
            background: #f8f9ff;
        }

        .amount-label {
            display: block;
            color: #777;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .amount-value {
            color: #667eea;
            font-size: 29px;
            font-weight: 800;
        }

        #pay {
            width: 100%;
            min-height: 54px;
            padding: 14px 20px;
            border: none;
            border-radius: 11px;
            background: linear-gradient(135deg, #667eea, #5266d8);
            color: #ffffff;
            font-size: 17px;
            font-weight: 700;
            letter-spacing: 0.4px;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(102, 126, 234, 0.25);
            transition: all 0.25s ease;
        }

        #pay:hover {
            transform: translateY(-3px);
            box-shadow: 0 9px 22px rgba(102, 126, 234, 0.35);
        }

        #pay:active {
            transform: scale(0.97);
        }

        .secure-text {
            margin-top: 20px;
            color: #777;
            font-size: 12px;
        }

        @media (max-width: 480px) {

            .payment-container {
                padding: 30px 20px;
            }

            h2 {
                font-size: 24px;
            }

            .amount-value {
                font-size: 26px;
            }

            #pay {
                min-height: 50px;
                font-size: 16px;
            }

        }

    </style>

</head>

<body>

    <div class="payment-container">

        <div class="payment-icon">
            💳
        </div>

        <h2>Online Payment</h2>

        <p class="payment-description">
            Complete your payment securely and confirm your order.
        </p>

        <div class="amount-box">

            <span class="amount-label">
                Total Amount
            </span>

            <div class="amount-value">
                ₹<?php echo number_format($total, 2); ?>
            </div>

        </div>

        <button id="pay" type="button">
            Pay Now →
        </button>

        <p class="secure-text">
            🔒 Secure payment powered by Razorpay
        </p>

    </div>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    <script>

        var options = {

            key: <?php echo json_encode($key); ?>,

            amount: <?php echo $amount; ?>,

            currency: "INR",

            name: "Ardent E-Product",

            order_id: <?php echo json_encode($order['id']); ?>,

            handler: function(res) {

                document.getElementById("pid").value =
                    res.razorpay_payment_id;

                document.getElementById("sig").value =
                    res.razorpay_signature;

                document.getElementById("paymentForm").submit();

            }

        };

        var rzp = new Razorpay(options);

        document.getElementById("pay").onclick = function() {

            rzp.open();

        };

    </script>

    <form id="paymentForm" action="verify.php" method="post">

        <input type="hidden" name="payment_id" id="pid">

        <input type="hidden" name="signature" id="sig">

    </form>

</body>
</html>
