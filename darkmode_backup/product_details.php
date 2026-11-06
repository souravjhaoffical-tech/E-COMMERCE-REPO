<?php
session_start();
require_once __DIR__ . "/db.php";

if (!$conn) {
    die("Database connection failed.");
}

$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    die("Invalid product ID.");
}

$stmt = mysqli_prepare(
    $conn,
    "SELECT id, p_brand, p_name, p_price, image, category
     FROM eproduct
     WHERE id = ?"
);

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$product) {
    http_response_code(404);
    die("Product not found.");
}

$imageName = basename($product["image"] ?? "");
$imageUrl = $imageName !== ""
    ? "uploads/" . rawurlencode($imageName)
    : "";

function escapeHtml($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= escapeHtml($product["p_name"]) ?> | Shop Vibe</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 16px;
            background: #f5f6fa;
            color: #222;
            font-family: Arial, sans-serif;
        }

        .details-container {
            max-width: 950px;
            margin: 30px auto;
            padding: 28px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 35px;
            align-items: center;
            background: white;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        .product-photo {
            width: 100%;
            height: 350px;
            object-fit: contain;
            border-radius: 12px;
            background: #fafafa;
        }

        .brand {
            color: #777;
            margin-bottom: 12px;
        }

        .category {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 20px;
            background: #fff0e5;
            color: #d94f00;
            font-size: 13px;
        }

        h1 {
            margin: 15px 0;
            overflow-wrap: anywhere;
        }

        .price {
            color: #e85d04;
            font-size: 30px;
            font-weight: bold;
            margin: 20px 0;
        }

        .cart-btn, .back-btn {
            display: inline-block;
            padding: 13px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            margin: 5px 5px 5px 0;
        }

        .cart-btn {
            color: white;
            background: #e85d04;
        }

        .back-btn {
            color: #333;
            background: #eee;
        }

        @media (max-width: 650px) {
            .details-container {
                grid-template-columns: 1fr;
                padding: 18px;
                gap: 20px;
            }

            .product-photo {
                height: 260px;
            }
        }
    </style>
</head>

<body>
    <main class="details-container">
        <div>
            <?php if ($imageUrl !== ""): ?>
                <img
                    class="product-photo"
                    src="<?= escapeHtml($imageUrl) ?>"
                    alt="<?= escapeHtml($product["p_name"]) ?>"
                >
            <?php else: ?>
                <p>Product image unavailable.</p>
            <?php endif; ?>
        </div>

        <div>
            <span class="category">
                <?= escapeHtml($product["category"] ?? "Uncategorized") ?>
            </span>

            <h1><?= escapeHtml($product["p_name"]) ?></h1>

            <p class="brand">
                Brand: <?= escapeHtml($product["p_brand"]) ?>
            </p>

            <div class="price">
                ₹<?= number_format((float)$product["p_price"], 2) ?>
            </div>

            <a
                class="cart-btn"
                href="add_cart.php?id=<?= (int)$product["id"] ?>"
            >
                🛒 Add to Cart
            </a>

            <a class="back-btn" href="users_home.php#products">
                ← Back to Products
            </a>
        </div>
    </main>
</body>
</html>

<?php
mysqli_close($conn);
?>