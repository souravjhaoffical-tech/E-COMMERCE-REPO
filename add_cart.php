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

$id = (int)($_GET['id'] ?? 0);

if ($id > 0) {

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $_SESSION['cart'][] = $id;
}

header("Location: cart.php");
exit();
?>