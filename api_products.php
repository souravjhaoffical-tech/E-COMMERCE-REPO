<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: http://localhost:5174");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Method not allowed"]);
    exit;
}

require_once __DIR__ . "/db.php";

if (!$conn) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Database connection failed"]);
    exit;
}

$sql = "SELECT id, image, p_brand, p_name, p_price  FROM eproduct ORDER BY id DESC";
$result = mysqli_query($conn, $sql);

if (!$result) {
    http_response_code(500);
    echo json_encode([
        "success" => false,
        "message" => "Could not fetch products"
    ]);
    exit;
}

$products = [];

while ($row = mysqli_fetch_assoc($result)) {
    $imageName = basename($row["image"] ?? "");
    error_log("Image from database: " . ($row["image"] ?? "NULL"));

    $products[] = [
        "id" => (int) $row["id"],
        "name" => $row["p_name"] ?? "",
        "brand" => $row["p_brand"] ?? "",
        "price" => (float) $row["p_price"],
        "image" => $imageName !== ""
        ? "http://" . $_SERVER['HTTP_HOST'] . "/E-COMMERCE-SITE/E-COMMERCE-REPO/uploads/" . rawurlencode($imageName)
        : null

        
    ];
}

echo json_encode([
    "success" => true,
    "products" => $products
], JSON_UNESCAPED_UNICODE);

mysqli_free_result($result);
mysqli_close($conn);
?>
