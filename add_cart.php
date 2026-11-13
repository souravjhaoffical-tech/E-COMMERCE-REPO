<?php

$allowedOrigins = [
    "http://localhost:5173",
    "http://localhost:5174"
];

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';

if (in_array($origin, $allowedOrigins, true)) {
    header("Access-Control-Allow-Origin: " . $origin);
    header("Access-Control-Allow-Credentials: true");
}

header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

header("Content-Type: application/json; charset=UTF-8");
session_start();

if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

 require_once __DIR__ . "/db.php";


// React request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $id = (int)($_POST['id'] ?? 0);
    $quantity = (int)($_POST['quantity'] ?? 1);
    $action = $_POST['action'] ?? '';

    if ($id <= 0 || $action !== 'set_quantity') {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
    exit;
}

$quantity = max(1, min($quantity, 99));

// Check available stock
$stmt = mysqli_prepare($conn, "SELECT stock_quantity FROM eproduct WHERE id = ?");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database query failed']);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $stock);

if (!mysqli_stmt_fetch($stmt)) {
    mysqli_stmt_close($stmt);
    http_response_code(404);
    echo json_encode(['success' => false, 'message' => 'Product not found']);
    exit;
}

mysqli_stmt_close($stmt);

$stock = (int) $stock;

if ($stock <= 0) {
    http_response_code(409);
    echo json_encode(['success' => false, 'message' => 'This product is out of stock']);
    exit;
}

if ($quantity > $stock) {
    http_response_code(409);
    echo json_encode([
        'success' => false,
        'message' => "Only $stock item(s) available in stock"
    ]);
    exit;
}

    $_SESSION['cart'] = array_values(
        array_filter($_SESSION['cart'], function($cartId) use ($id) {
            return (int)$cartId !== $id;
        })
    );

    for ($i = 0; $i < $quantity; $i++) {
        $_SESSION['cart'][] = $id;
    }

    echo json_encode(['success' => true, 'quantity' => $quantity]);
    exit;
}

// Old PHP product page links
$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT stock_quantity FROM eproduct WHERE id = ?");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $stock);

        if (mysqli_stmt_fetch($stmt)) {
            $currentQuantity = count(array_filter(
                $_SESSION['cart'],
                function($cartId) use ($id) {
                    return (int)$cartId === $id;
                }
            ));

            if ((int)$stock > $currentQuantity) {
                $_SESSION['cart'][] = $id;
            }
        }

        mysqli_stmt_close($stmt);
    }
}

header("Location: cart.php");
exit;
?>