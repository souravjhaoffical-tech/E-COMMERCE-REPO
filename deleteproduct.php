
<?php
session_start();
include "db.php";

// Fetch all products
$sql = "SELECT id, p_name, p_brand, p_price, image, stock_quantity
        FROM eproduct
        ORDER BY id DESC";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Unable to fetch products: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Stock | ShopVibe</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 24px;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
            color: #222;
        }

        h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #666;
            margin-bottom: 24px;
        }

        .table-wrapper {
            overflow-x: auto;
            background: white;
            border-radius: 10px;
            padding: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #f0f2f5;
        }

        .status {
            font-weight: bold;
        }

        .in-stock {
            color: #16803c;
        }

        .out-stock {
            color: #d62828;
        }
    </style>
</head>

<body>

    <h1>Inventory Management</h1>
    <p class="subtitle">
        View product quantities and stock availability.
    </p>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>

                    <?php while ($product = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <?= (int) $product['id'] ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['p_name']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($product['p_brand']) ?>
                            </td>

                            <td>
                                ₹<?= number_format((float) $product['p_price'], 2) ?>
                            </td>

                            <td>
                                <?= (int) $product['stock_quantity'] ?>
                            </td>

                            <td>
                                <?php if ((int) $product['stock_quantity'] > 0): ?>
                                    <span class="status in-stock">In Stock</span>
                                <?php else: ?>
                                    <span class="status out-stock">Out of Stock</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>

                <?php else: ?>
                    <tr>
                        <td colspan="6">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>
</html>
