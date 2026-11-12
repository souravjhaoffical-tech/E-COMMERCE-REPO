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

$origin = $_SERVER['HTTP_ORIGIN'] ?? '';
$originHost = parse_url($origin, PHP_URL_HOST);
$requestHost = preg_replace('/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '');
$originPort = parse_url($origin, PHP_URL_PORT);

if (
    $originHost &&
    strtolower($originHost) === strtolower($requestHost) &&
    (int)($originPort ?? 80) === 5174
) {
    header("Access-Control-Allow-Origin: $origin");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Vary: Origin");
}

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

require_once __DIR__ . '/db.php';

if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') !== 'user') {
    http_response_code(401);
    echo json_encode([
        'success' => false,
        'message' => 'Please log in as a user first.'
    ]);
    exit;
}

$userId = (int) $_SESSION['user_id'];
$action = $_GET['action'] ?? '';

if ($action === 'list') {
    $stmt = mysqli_prepare(
        $conn,
        'SELECT product_id FROM wishlist WHERE user_id = ?'
    );
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $ids = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $ids[] = (int) $row['product_id'];
    }

    echo json_encode([
        'success' => true,
        'wishlist' => $ids
    ]);
    exit;
}

if ($action === 'toggle' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    $productId = filter_var(
        $body['product_id'] ?? null,
        FILTER_VALIDATE_INT
    );

    if (!$productId || $productId < 1) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid product ID.'
        ]);
        exit;
    }

    // Check that the product exists.
    $check = mysqli_prepare(
        $conn,
        'SELECT id FROM eproduct WHERE id = ?'
    );
    mysqli_stmt_bind_param($check, 'i', $productId);
    mysqli_stmt_execute($check);
    $productResult = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($productResult) === 0) {
        http_response_code(404);
        echo json_encode([
            'success' => false,
            'message' => 'Product not found.'
        ]);
        exit;
    }

    // Check whether this user already saved the product.
    $check = mysqli_prepare(
        $conn,
        'SELECT id FROM wishlist WHERE user_id = ? AND product_id = ?'
    );
    mysqli_stmt_bind_param($check, 'ii', $userId, $productId);
    mysqli_stmt_execute($check);
    $existing = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($existing) > 0) {
        $stmt = mysqli_prepare(
            $conn,
            'DELETE FROM wishlist WHERE user_id = ? AND product_id = ?'
        );
        mysqli_stmt_bind_param($stmt, 'ii', $userId, $productId);
        mysqli_stmt_execute($stmt);
        $added = false;
    } else {
        $stmt = mysqli_prepare(
            $conn,
            'INSERT IGNORE INTO wishlist (user_id, product_id) VALUES (?, ?)'
        );
        mysqli_stmt_bind_param($stmt, 'ii', $userId, $productId);
        mysqli_stmt_execute($stmt);
        $added = mysqli_stmt_affected_rows($stmt) === 1;
    }

    echo json_encode([
        'success' => true,
        'added' => $added,
        'product_id' => $productId
    ]);
    exit;
}

http_response_code(400);
echo json_encode([
    'success' => false,
    'message' => 'Invalid wishlist action.'
]);
?>