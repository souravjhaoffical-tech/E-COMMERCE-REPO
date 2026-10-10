<?php
include "db.php";

$res = mysqli_query($conn, "SELECT * FROM eproduct");
$product = mysqli_fetch_all($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopVibe - Product List</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f5f6fa;
    padding: 35px 20px;
    color: #252b45;
}

/* Main Container */
.container {
    width: 100%;
    max-width: 1200px;
    margin: auto;
}

/* Heading */
h2 {
    text-align: center;
    color: #252b45;
    font-size: 30px;
    margin-bottom: 28px;
}

/* Buttons */
.button-area {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 22px;
}

.add-btn {
    display: inline-block;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 12px 18px;
    text-decoration: none;
    border-radius: 9px;
    font-size: 14px;
    font-weight: bold;
    transition: 0.3s;
    box-shadow: 0 5px 12px rgba(102, 126, 234, 0.18);
}

.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(102, 126, 234, 0.28);
}

/* Table Wrapper */
.table-wrapper {
    width: 100%;
    overflow-x: auto;
    background: #ffffff;
    border-radius: 14px;
    box-shadow: 0 8px 25px rgba(35, 40, 80, 0.08);
}

/* Table */
table {
    width: 100%;
    min-width: 750px;
    border-collapse: collapse;
    background: #ffffff;
}

th {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 16px 14px;
    text-align: left;
    font-size: 14px;
    white-space: nowrap;
}

td {
    padding: 14px;
    border-bottom: 1px solid #edf0f7;
    color: #454b63;
    font-size: 14px;
    vertical-align: middle;
}

tbody tr {
    transition: background 0.2s;
}

tbody tr:hover {
    background: #f5f6ff;
}

tbody tr:last-child td {
    border-bottom: none;
}

/* Product Image */
.product-image {
    width: 85px;
    height: 65px;
    object-fit: cover;
    border-radius: 8px;
    border: 1px solid #edf0f7;
    background: #f5f6fa;
}

/* Price */
.price {
    color: #667eea;
    font-weight: bold;
    white-space: nowrap;
}

/* Action Links */
.action-links {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.edit,
.delete,
.cart-link {
    text-decoration: none;
    font-weight: bold;
    font-size: 13px;
    transition: 0.2s;
}

.edit {
    color: #667eea;
}

.edit:hover {
    color: #764ba2;
    text-decoration: underline;
}

.delete {
    color: #e05260;
}

.delete:hover {
    color: #b91c1c;
    text-decoration: underline;
}

.cart-link {
    color: #ffffff;
    background: linear-gradient(135deg, #667eea, #764ba2);
    padding: 8px 10px;
    border-radius: 7px;
    white-space: nowrap;
}

.cart-link:hover {
    opacity: 0.88;
    transform: translateY(-1px);
}

/* Empty List */
.empty-message {
    text-align: center;
    padding: 30px;
    color: #7b8195;
}

/* Responsive */
@media (max-width: 600px) {
    body {
        padding: 25px 12px;
    }

    h2 {
        font-size: 25px;
        margin-bottom: 22px;
    }

    .button-area {
        flex-direction: column;
    }

    .add-btn {
        text-align: center;
    }

    th,
    td {
        padding: 12px 10px;
    }
}
</style>
</head>

<body>

<div class="container">

    <h2>Product List</h2>

    <div class="button-area">
        <a href="addproduct.php" class="add-btn">
            + Add New Product
        </a>

        <a href="add_cart.php" class="add-btn">
            + Add CART
        </a>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Brand</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
            <?php if (!empty($product)) { ?>

                <?php foreach ($product as $x) { ?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($x['id']); ?>
                    </td>

                    <td>
                        <img
                            class="product-image"
                            src="uploads/<?php echo htmlspecialchars($x['image'] ?? ''); ?>"
                            alt="<?php echo htmlspecialchars($x['p_name']); ?>"
                            onerror="this.style.display='none';"
                        >
                    </td>

                    <td>
                        <?php echo htmlspecialchars($x['p_brand']); ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($x['p_name']); ?>
                    </td>

                    <td class="price">
                        ₹<?php echo htmlspecialchars($x['p_price']); ?>
                    </td>

                    <td>
                        <div class="action-links">
                            <a href="editproduct.php?id=<?php echo urlencode($x['id']); ?>"
                               class="edit">Edit</a>

                            <a href="deleteproduct.php?id=<?php echo urlencode($x['id']); ?>"
                               class="delete"
                               onclick="return confirm('Are you sure you want to delete this product?');">
                               Delete
                            </a>

                            <a href="add_cart.php?id=<?php echo urlencode($x['id']); ?>"
                               class="cart-link">Add to Cart</a>
                        </div>
                    </td>
                </tr>
                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="6" class="empty-message">
                        No products found. Add your first product!
                    </td>
                </tr>

            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>