
<?php

session_start();

require_once "db.php";
require_once "config.php";


// ==========================================
// 1. CHECK USER AND CHECKOUT SESSION
// ==========================================

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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit("Invalid request method.");
}


// ==========================================
// 2. GET SESSION DATA
// ==========================================

$orderId = $_SESSION['rzp_order'];
$amount = (int)$_SESSION['rzp_amount'];
$customer = $_SESSION['checkout_customer'];
$checkoutTotal = (float)$_SESSION['checkout_total'];
$cartProducts = $_SESSION['rzp_product'];

$paymentId = trim($_POST['payment_id'] ?? '');
$signature = trim($_POST['signature'] ?? '');

if ($paymentId === '' || $signature === '') {
    http_response_code(400);
    exit("Missing payment details.");
}


// ==========================================
// 3. VERIFY RAZORPAY PAYMENT
// ==========================================

try {

    $api->utility->verifyPaymentSignature([
        "razorpay_order_id" => $orderId,
        "razorpay_payment_id" => $paymentId,
        "razorpay_signature" => $signature
    ]);

    // Fetch payment directly from Razorpay.
    $payment = $api->payment->fetch($paymentId);

    if (
        $payment['status'] !== 'captured' ||
        $payment['order_id'] !== $orderId ||
        (int)$payment['amount'] !== $amount ||
        $payment['currency'] !== 'INR'
    ) {
        throw new Exception("Payment is not confirmed as captured.");
    }


    // ==========================================
    // 4. GROUP PRODUCT QUANTITIES
    // ==========================================

    $quantities = [];

    foreach ($cartProducts as $item) {

        $productId = filter_var(
            $item['id'] ?? null,
            FILTER_VALIDATE_INT
        );

        if (!$productId || $productId < 1) {
            throw new Exception("Invalid product in checkout.");
        }

        $quantities[$productId] =
            ($quantities[$productId] ?? 0) + 1;
    }

    if (empty($quantities)) {
        throw new Exception("No products found in checkout.");
    }


    // ==========================================
    // 5. CUSTOMER DETAILS
    // ==========================================

    $userId = (int)$_SESSION['user_id'];

    $name = $customer['customer_name'];
    $phone = $customer['phone'];
    $address = $customer['address'];
    $city = $customer['city'];
    $pincode = $customer['pincode'];

    $paymentMethod = 'Razorpay';


    // ==========================================
    // 6. START DATABASE TRANSACTION
    // ==========================================

    mysqli_begin_transaction($conn);

    $transactionStarted = true;


    // ==========================================
    // 7. PREVENT DUPLICATE ORDER
    // ==========================================

    $check = mysqli_prepare(
        $conn,
        "SELECT id FROM orders
         WHERE razorpay_order_id = ?
         LIMIT 1
         FOR UPDATE"
    );

    if (!$check) {
        throw new Exception("Unable to check duplicate order.");
    }

    mysqli_stmt_bind_param($check, "s", $orderId);

    if (!mysqli_stmt_execute($check)) {
        throw new Exception("Unable to execute duplicate-order check.");
    }

    $existing = mysqli_stmt_get_result($check);

    $alreadySaved = mysqli_num_rows($existing) > 0;

    mysqli_stmt_close($check);


    // If order already exists, do not deduct stock again.
    if ($alreadySaved) {

        mysqli_commit($conn);
        $transactionStarted = false;

        unset($_SESSION['cart']);
        unset($_SESSION['rzp_order']);
        unset($_SESSION['rzp_amount']);
        unset($_SESSION['rzp_product']);
        unset($_SESSION['checkout_customer']);
        unset($_SESSION['checkout_total']);

        header("Location: success.php");
        exit();
    }


    // ==========================================
    // 8. FETCH LATEST PRODUCTS AND CHECK STOCK
    // ==========================================

    $products = [];
    $total = 0;

    $stmt = mysqli_prepare(
        $conn,
        "SELECT id, p_name, p_price, stock_quantity
         FROM eproduct
         WHERE id = ?
         FOR UPDATE"
    );

    if (!$stmt) {
        throw new Exception("Unable to prepare product query.");
    }

    foreach ($quantities as $productId => $quantity) {

        mysqli_stmt_bind_param($stmt, "i", $productId);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Unable to fetch product.");
        }

        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            throw new Exception("A product is no longer available.");
        }

        $stock = (int)$product['stock_quantity'];

        if ($stock < $quantity) {
            throw new Exception(
                "Payment was captured, but stock is insufficient for " .
                $product['p_name'] .
                ". Please contact the administrator for assistance."
            );
        }

        if (
            !is_numeric($product['p_price']) ||
            (float)$product['p_price'] < 0
        ) {
            throw new Exception("Invalid product price.");
        }

        $product['p_price'] = (float)$product['p_price'];
        $product['quantity'] = $quantity;

        $products[] = $product;

        $total += $product['p_price'] * $quantity;
    }

    mysqli_stmt_close($stmt);


    // ==========================================
    // 9. VERIFY FINAL ORDER AMOUNT
    // ==========================================

    $expectedAmount = (int)round($total * 100);

    if (
        $expectedAmount !== $amount ||
        abs($total - $checkoutTotal) > 0.01
    ) {
        throw new Exception(
            "Order amount does not match the verified payment."
        );
    }


    // ==========================================
    // 10. INSERT ORDER DETAILS
    // ==========================================

    $reference = bin2hex(random_bytes(16));

    $insert = mysqli_prepare(
        $conn,
        "INSERT INTO orders
        (
            user_id,
            product_id,
            p_name,
            p_price,
            quantity,
            payment_method,
            razorpay_order_id,
            razorpay_payment_id,
            STATUS,
            customer_name,
            phone,
            address,
            city,
            pincode,
            total_amount,
            order_reference
        )
        VALUES (?, ?, ?, ?, ?, 'Razorpay', ?, ?,
                'Paid', ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$insert) {
        throw new Exception("Unable to prepare order insert.");
    }


    // ==========================================
    // 11. DEDUCT STOCK AND SAVE ORDER
    // ==========================================

    $stockUpdate = mysqli_prepare(
        $conn,
        "UPDATE eproduct
         SET stock_quantity = stock_quantity - ?
         WHERE id = ? AND stock_quantity >= ?"
    );

    if (!$stockUpdate) {
        throw new Exception("Unable to prepare stock update.");
    }

    $firstItem = true;

    foreach ($products as $product) {

        $productId = (int)$product['id'];
        $productName = $product['p_name'];
        $price = (float)$product['p_price'];
        $quantity = (int)$product['quantity'];

        // Store total amount only on the first product row.
        $rowTotal = $firstItem ? round($total, 2) : null;

        mysqli_stmt_bind_param(
            $insert,
            "iisdisssssssds",
            $userId,
            $productId,
            $productName,
            $price,
            $quantity,
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
            throw new Exception("Unable to save order details.");
        }


        // Deduct purchased quantity from inventory.
        mysqli_stmt_bind_param(
            $stockUpdate,
            "iii",
            $quantity,
            $productId,
            $quantity
        );

        if (!mysqli_stmt_execute($stockUpdate)) {
            throw new Exception("Unable to deduct product stock.");
        }

        if (mysqli_stmt_affected_rows($stockUpdate) !== 1) {
            throw new Exception("Stock update failed.");
        }

        $firstItem = false;
    }

    mysqli_stmt_close($insert);
    mysqli_stmt_close($stockUpdate);


    // ==========================================
    // 12. COMMIT TRANSACTION
    // ==========================================

    mysqli_commit($conn);
    $transactionStarted = false;


    // ==========================================
    // 13. CLEAR CHECKOUT SESSION
    // ==========================================

    unset($_SESSION['cart']);
    unset($_SESSION['rzp_order']);
    unset($_SESSION['rzp_amount']);
    unset($_SESSION['rzp_product']);
    unset($_SESSION['checkout_customer']);
    unset($_SESSION['checkout_total']);

    header("Location: success.php");
    exit();


} catch (Throwable $e) {

    if (!empty($transactionStarted)) {
        mysqli_rollback($conn);
    }

    error_log(
        "Shop Vibe Razorpay verification error: " .
        $e->getMessage()
    );

    http_response_code(400);

    echo htmlspecialchars(
        $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    );

    exit();
}

?>
