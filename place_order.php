
<?php
session_start();
require_once "db.php";

if (
    !isset($_SESSION['user_id']) ||
    !isset($_SESSION['role']) ||
    $_SESSION['role'] !== 'user'
) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST'
    || !isset($_POST['order'])) {
    header("Location: checkout.php");
    exit();
}

$cart = $_SESSION['cart'] ?? [];

if (empty($cart)) {
    die("Your cart is empty.");
}

$payment = $_POST['payment_method'] ?? '';

if (!in_array($payment, ['COD', 'Razorpay'], true)) {
    die("Invalid payment method.");
}

$name = trim($_POST['customer_name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$city = trim($_POST['city'] ?? '');
$pincode = trim($_POST['pincode'] ?? '');

if (
    $name === '' || $phone === '' ||
    $address === '' || $city === '' ||
    !preg_match('/^[0-9]{6}$/', $pincode) ||
    !preg_match('/^[0-9+ -]{10,15}$/', $phone)
) {
    die("Please enter valid customer details.");
}

$products = [];
$total = 0;

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, p_name, p_price
     FROM eproduct
     WHERE id = ?"
);

if (!$stmt) {
    die("Unable to prepare product query.");
}

foreach ($cart as $cartId) {
    $id = filter_var($cartId, FILTER_VALIDATE_INT);

    if (!$id || $id < 1) {
        die("Invalid product in cart.");
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (!mysqli_stmt_execute($stmt)) {
        die("Unable to load cart product.");
    }

    $result = mysqli_stmt_get_result($stmt);
    $product = mysqli_fetch_assoc($result);

    if (!$product || !is_numeric($product['p_price'])
        || $product['p_price'] < 0) {
        die("A cart product is unavailable or has an invalid price.");
    }

    $product['p_price'] = (float)$product['p_price'];
    $products[] = $product;
    $total += $product['p_price'];
}

mysqli_stmt_close($stmt);

if (!$products || $total <= 0) {
    die("Your order total is invalid.");
}

$_SESSION['checkout_customer'] = [
    'customer_name' => $name,
    'phone' => $phone,
    'address' => $address,
    'city' => $city,
    'pincode' => $pincode
];

$_SESSION['checkout_total'] = round($total, 2);

if ($payment === 'Razorpay') {
    header("Location: razorpay.php");
    exit();
}

$orderReference = bin2hex(random_bytes(16));
$userId = (int) $_SESSION['user_id'];

mysqli_begin_transaction($conn);

try {
    $insert = mysqli_prepare(
        $conn,
        "INSERT INTO orders
        (user_id, p_name, p_price, payment_method,
         `STATUS`, customer_name, phone, address,
         city, pincode, total_amount, order_reference)
        VALUES (?, ?, ?, ?, 'Pending', ?, ?, ?, ?, ?, ?, ?)"
    );

    if (!$insert) {
        throw new Exception("Unable to prepare order query.");
    }

    $firstItem = true;

    foreach ($products as $product) {
        $productName = $product['p_name'];
        $price = $product['p_price'];

        // Store the whole order total only once to avoid
        // double-counting it when multiple item rows exist.
        $rowTotal = $firstItem ? round($total, 2) : null;

        
mysqli_stmt_bind_param(
    $insert,
    "isdssssssds",
    $userId,
    $productName,
    $price,
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
                throw new Exception("Unable to save order item.");
            }

        $firstItem = false;
    }

    mysqli_stmt_close($insert);
    mysqli_commit($conn);

    unset($_SESSION['cart']);
    unset($_SESSION['checkout_customer']);
    unset($_SESSION['checkout_total']);

    header("Location: success.php");
    exit();

} 
 catch (Throwable $e) {
    mysqli_rollback($conn);

    error_log("Shop Vibe COD order error: " . $e->getMessage());

    echo "Database error: " .
         htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    exit();
}

?>
