
<?php
session_start();
require_once "db.php";
require_once "config.php";


if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user' ||
    empty($_SESSION['rzp_order']) ||
    empty($_SESSION['rzp_amount']) ||
    empty($_SESSION['rzp_product']) ||
    empty($_SESSION['checkout_customer']) ||
    !isset($_SESSION['checkout_total'])
) {
    http_response_code(400);
    exit("Invalid checkout session. Please restart checkout.");
}


$orderId = $_SESSION['rzp_order'];
$amount = (int) $_SESSION['rzp_amount'];
$products = $_SESSION['rzp_product'];
$customer = $_SESSION['checkout_customer'];
$total = (float) $_SESSION['checkout_total'];

$paymentId = trim($_POST['payment_id'] ?? '');
$signature = trim($_POST['signature'] ?? '');

if ($paymentId === '' || $signature === '') {
    http_response_code(400);
    exit("Missing payment details.");
}

try {
    // Verify the Razorpay payment signature.
    $api->utility->verifyPaymentSignature([
        "razorpay_order_id" => $orderId,
        "razorpay_payment_id" => $paymentId,
        "razorpay_signature" => $signature
    ]);

    // Confirm payment details directly with Razorpay.
    $payment = $api->payment->fetch($paymentId);

    if (
        $payment['status'] !== 'captured' ||
        $payment['order_id'] !== $orderId ||
        (int)$payment['amount'] !== $amount ||
        $payment['currency'] !== 'INR'
    ) {
        http_response_code(400);
        exit("Payment is not confirmed as captured.");
    }

    $userId = (int) $_SESSION['user_id'];

$name = $customer['customer_name'];
$phone = $customer['phone'];
$address = $customer['address'];
$city = $customer['city'];
$pincode = $customer['pincode'];
$paymentMethod = 'Razorpay';

    // Prevent saving the same Razorpay order twice.
    mysqli_begin_transaction($conn);

    $check = mysqli_prepare(
        $conn,
        "SELECT id FROM orders
         WHERE razorpay_order_id = ?
         LIMIT 1
         FOR UPDATE"
    );

    if (!$check) {
        throw new Exception("Could not prepare duplicate-order check.");
    }

    mysqli_stmt_bind_param($check, "s", $orderId);
    mysqli_stmt_execute($check);
    $existing = mysqli_stmt_get_result($check);
    $alreadySaved = mysqli_num_rows($existing) > 0;
    mysqli_stmt_close($check);

    if (!$alreadySaved) {
        $reference = bin2hex(random_bytes(16));

        $insert = mysqli_prepare(
            $conn,
            "INSERT INTO orders
            (user_id, p_name, p_price, payment_method,
             razorpay_order_id, razorpay_payment_id,
             `STATUS`, customer_name, phone, address,
             city, pincode, total_amount, order_reference)
            VALUES (?, ?, ?, 'Razorpay', ?, ?, 'Paid',
                    ?, ?, ?, ?, ?, ?, ?)"
        );

        if (!$insert) {
            throw new Exception("Could not prepare order insert.");
        }

        $firstItem = true;

        foreach ($products as $product) {
            if (
                !isset($product['p_name'], $product['p_price']) ||
                !is_numeric($product['p_price']) ||
                (float)$product['p_price'] < 0
            ) {
                throw new Exception("Invalid product data in checkout.");
            }

            $productName = (string)$product['p_name'];
            $price = (float)$product['p_price'];

            // Store the full order total on only the first item row.
            $rowTotal = $firstItem ? round($total, 2) : null;

            

mysqli_stmt_bind_param(
    $insert,
    "isdsssssssds",
    $userId,
    $productName,
    $price,
    $orderId,
    $paymentId,
    $name,
    $phone,
    $address,
    $city,
    $pincode,
    $rowTotal,
    $reference
);




            if (!mysqli_stmt_execute($insert)) {
                throw new Exception("Could not save order item.");
            }

            $firstItem = false;
        }

        mysqli_stmt_close($insert);
    }

    mysqli_commit($conn);

    unset($_SESSION['cart']);
    unset($_SESSION['rzp_order']);
    unset($_SESSION['rzp_amount']);
    unset($_SESSION['rzp_product']);
    unset($_SESSION['checkout_customer']);
    unset($_SESSION['checkout_total']);

    header("Location: success.php");
    exit();

} catch (Throwable $e) {
    if ($conn->errno === 0 || mysqli_ping($conn)) {
        mysqli_rollback($conn);
    }

    error_log("Shop Vibe Razorpay verification error: " . $e->getMessage());

    http_response_code(400);
    echo "Payment verification or order saving failed. Do not pay again immediately; check your Razorpay dashboard and orders table first.";
}
?>
