
<?php

session_start();
require_once "db.php";

// ==========================================
// 1. USER AUTHENTICATION
// ==========================================

if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user'
) {
    header("Location: login.php");
    exit();
}


// ==========================================
// 2. CHECK REQUEST METHOD
// ==========================================

if (
    $_SERVER['REQUEST_METHOD'] !== 'POST' ||
    !isset($_POST['order'])
) {
    header("Location: checkout.php");
    exit();
}


// ==========================================
// 3. GET CART AND GROUP QUANTITIES
// ==========================================

$cart = $_SESSION['cart'] ?? [];

if (empty($cart) || !is_array($cart)) {
    die("Your cart is empty.");
}

$quantities = [];

foreach ($cart as $cartId) {

    $id = filter_var($cartId, FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        die("Invalid product in cart.");
    }

    $quantities[$id] = ($quantities[$id] ?? 0) + 1;
}


// ==========================================
// 4. VALIDATE PAYMENT METHOD
// ==========================================

$payment = $_POST['payment_method'] ?? '';

if (!in_array($payment, ['COD', 'Razorpay'], true)) {
    die("Invalid payment method.");
}


// ==========================================
// 5. CUSTOMER DETAILS
// ==========================================

$name = trim($_POST['customer_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$city = trim($_POST['city'] ?? '');
$pincode = trim($_POST['pincode'] ?? '');

if (
    $name === '' ||
    $phone === '' ||
    $address === '' ||
    $city === '' ||
    !preg_match('/^[0-9]{6}$/', $pincode) ||
    !preg_match('/^[0-9+ -]{10,15}$/', $phone)
) {
    die("Please enter valid customer details.");
}


// ==========================================
// 6. FETCH PRODUCTS AND CHECK STOCK
// ==========================================

$products = [];
$total = 0;

mysqli_begin_transaction($conn);

try {

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

    foreach ($quantities as $id => $quantity) {

        mysqli_stmt_bind_param($stmt, "i", $id);

        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Unable to fetch product.");
        }

        $result = mysqli_stmt_get_result($stmt);
        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            throw new Exception("A product in your cart is unavailable.");
        }

        $stock = (int)$product['stock_quantity'];

        if ($stock < $quantity) {
            throw new Exception(
                "Insufficient stock for " . $product['p_name'] .
                ". Available stock: " . $stock
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

    if (empty($products) || $total <= 0) {
        throw new Exception("Your order total is invalid.");
    }

    // ==========================================
    // 7. SAVE CHECKOUT CUSTOMER DETAILS
    // ==========================================

    $_SESSION['checkout_customer'] = [
        'customer_name' => $name,
        'phone' => $phone,
        'address' => $address,
        'city' => $city,
        'pincode' => $pincode
    ];

    $_SESSION['checkout_total'] = round($total, 2);


    // ==========================================
    // 8. RAZORPAY PAYMENT
    // ==========================================

    if ($payment === 'Razorpay') {

        // No stock deduction here.
        // Stock will be deducted after payment verification.

        mysqli_commit($conn);

        header("Location: razorpay.php");
        exit();
    }


    // ==========================================
    // 9. COD ORDER PROCESSING
    // ==========================================

    $userId = (int)$_SESSION['user_id'];

    $orderReference = bin2hex(random_bytes(16));

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
            STATUS,
            customer_name,
            phone,
            address,
            city,
            pincode,
            total_amount,
            order_reference
        )
        VALUES (?, ?, ?, ?, ?, ?, 'Pending',
                ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$insert) {
        throw new Exception("Unable to prepare order query.");
    }


    // ==========================================
    // 10. INSERT ORDER AND DEDUCT STOCK
    // ==========================================

    $firstItem = true;

    $stockUpdate = mysqli_prepare(
        $conn,
        "UPDATE eproduct
         SET stock_quantity = stock_quantity - ?
         WHERE id = ? AND stock_quantity >= ?"
    );

    if (!$stockUpdate) {
        throw new Exception("Unable to prepare stock update.");
    }

    foreach ($products as $product) {

        $productId = (int)$product['id'];
        $productName = $product['p_name'];
        $price = (float)$product['p_price'];
        $quantity = (int)$product['quantity'];

        // Save total amount only in the first product row.
        $rowTotal = $firstItem ? round($total, 2) : null;

        mysqli_stmt_bind_param(
            $insert,
            "iisdissssssds",
            $userId,
            $productId,
            $productName,
            $price,
            $quantity,
            $payment,
            $name,
            $phone,
            $address,
            $city,
            $pincode,
            $rowTotal,
            $orderReference
        );

        if (!mysqli_stmt_execute($insert)) {
            throw new Exception("Unable to save order.");
        }


        // Deduct stock for this product.
        mysqli_stmt_bind_param(
            $stockUpdate,
            "iii",
            $quantity,
            $productId,
            $quantity
        );

        if (!mysqli_stmt_execute($stockUpdate)) {
            throw new Exception("Unable to update product stock.");
        }

        if (mysqli_stmt_affected_rows($stockUpdate) !== 1) {
            throw new Exception(
                "Stock changed or is insufficient for " . $productName
            );
        }

        $firstItem = false;
    }

    mysqli_stmt_close($insert);
    mysqli_stmt_close($stockUpdate);


    // ==========================================
    // 11. COMMIT TRANSACTION
    // ==========================================

    mysqli_commit($conn);

    unset($_SESSION['cart']);
    unset($_SESSION['checkout_customer']);
    unset($_SESSION['checkout_total']);

    header("Location: success.php");
    exit();


} catch (Throwable $e) {

    mysqli_rollback($conn);

    error_log(
        "Shop Vibe COD order error: " . $e->getMessage()
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
