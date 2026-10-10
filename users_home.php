<?php
session_start();
include "db.php";

// Check user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'user') {
    header("Location:login.php");
    exit;
}

$sql = "SELECT * FROM eproduct";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shop - E-Commerce</title>

<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #f5f6fa;
}

/* Navbar */

.navbar {
    height: 70px;
    background: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 6%;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.logo {
    font-size: 24px;
    font-weight: bold;
    color: #667eea;
}

.nav-right {
    display: flex;
    align-items: center;
    gap: 20px;
}

.welcome {
    color: #555;
    font-size: 14px;
}

.logout {
    text-decoration: none;
    background: #667eea;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
}
.cart {
    text-decoration: none;
    background: #667eea;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
}

/* Hero */

.hero {
    margin: 30px 6%;
    padding: 45px;
    border-radius: 20px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.hero h1 {
    font-size: 36px;
    margin-bottom: 10px;
}

.hero p {
    font-size: 16px;
    opacity: 0.9;
}

/* Products */

.products-section {
    padding: 10px 6% 50px;
}

.section-title {
    font-size: 28px;
    margin-bottom: 25px;
    color: #222;
}

.products {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 25px;
}

.product-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.product-image {
    width: 100%;
    height: 220px;
    object-fit: cover;
}

.product-info {
    padding: 18px;
}

.product-info h3 {
    color: #222;
    margin-bottom: 8px;
}

.description {
    color: #777;
    font-size: 14px;
    line-height: 1.5;
    margin-bottom: 12px;
}

.price {
    font-size: 20px;
    font-weight: bold;
    color: #667eea;
    margin-bottom: 15px;
}

.cart-btn {
    width: 100%;
    padding: 11px;
    border: none;
    border-radius: 8px;
    background: #667eea;
    color: white;
    font-weight: bold;
    cursor: pointer;
}

.cart-btn:hover {
    background: #5568d8;
}

@media (max-width: 600px) {

    .navbar {
        padding: 0 20px;
    }

    .hero {
        margin: 20px;
        padding: 30px 25px;
    }

    .hero h1 {
        font-size: 28px;
    }

    .products-section {
        padding: 10px 20px 40px;
    }

    .welcome {
        display: none;
    }

}

</style>

</head>

<body>

<!-- Navbar -->

<nav class="navbar">

    <div class="logo">
        🛒 Shop Vibe
    </div>

    
<div class="nav-right">

    <span class="welcome">
        Welcome, <?php
        echo htmlspecialchars(
            $_SESSION['user_name'] ?? $_SESSION['name'] ?? 'User'
        );
        ?>
    </span>

    <a href="cart.php" class="cart">
        Cart
    </a>

    <a href="logout.php" class="logout">
        Logout
    </a>

</div>

</nav>

<!-- Hero -->

<section class="hero">

  <h1>
    Welcome, <?php
    echo htmlspecialchars(
        $_SESSION['user_name'] ?? $_SESSION['name'] ?? 'User'
    );
    ?> 👋
</h1>
    <p>
        Discover amazing products and start shopping today.
    </p>

</section>


<!-- Products -->

<section class="products-section">

    <h2 class="section-title">
        Our Products 🛍️
    </h2>

    <div class="products">

        <?php

        if (mysqli_num_rows($result) > 0) {

            while ($product = mysqli_fetch_assoc($result)) {

        ?>

        <div class="product-card">

            <img
                src="<?php echo htmlspecialchars($product['image']); ?>"
                class="product-image"
                alt="Product"
            >

            <div class="product-info">

                <h3>
                    <?php echo htmlspecialchars($product['title']); ?>
                </h3>

                <p class="description">
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>

                <div class="price">
                    $<?php echo htmlspecialchars($product['price']); ?>
                </div>

                <button class="cart-btn">
                     <img src="images/logo.shopvibe.png" alt="Shop Vibe">
                      Add to Cart
                </button>

            </div>

        </div>

        <?php

            }

        } else {

            echo "<p>No products available.</p>";

        }

        ?>

    </div>

</section>

</body>
</html>