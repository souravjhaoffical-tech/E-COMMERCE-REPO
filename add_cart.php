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
    $_SESSION['cart'][] = $id;
}

header("Location: cart.php");
exit;
?>