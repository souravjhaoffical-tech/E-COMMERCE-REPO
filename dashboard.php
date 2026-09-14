<?php 
 
echo "welcome to shop vibe"; 
 
?> 

<!DOCTYPE html>
<html>
<head>
    <title>Shop Vibe - Admin Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #222;
        }

        /* Navbar */
        .navbar {
            height: 70px;
            background: #111827;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 45px;
            color: white;
        }

        .logo {
            font-size: 27px;
            font-weight: bold;
        }

        .logo span {
            color: #f59e0b;
        }

        .admin {
            font-size: 14px;
            color: #d1d5db;
        }

        /* Main */
        .container {
            padding: 45px;
        }

        .welcome {
            margin-bottom: 35px;
        }

        .welcome h1 {
            font-size: 32px;
            color: #111827;
            margin-bottom: 8px;
        }

        .welcome p {
            color: #6b7280;
        }

        /* Cards */
        .cards {
            display: flex;
            gap: 25px;
            margin-bottom: 40px;
        }

        .card {
            background: white;
            width: 250px;
            padding: 28px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 32px;
            margin-bottom: 15px;
        }

        .card h3 {
            color: #374151;
            font-size: 17px;
            margin-bottom: 8px;
        }

        .card p {
            color: #9ca3af;
            font-size: 14px;
        }

        /* Dashboard Options */
        .section-title {
            font-size: 22px;
            margin-bottom: 20px;
            color: #111827;
        }

        .options {
            display: flex;
            gap: 25px;
        }

        .option {
            background: white;
            width: 280px;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        }

        .option h2 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #111827;
        }

        .option p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .option a {
            display: inline-block;
            text-decoration: none;
            background: #f59e0b;
            color: white;
            padding: 11px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .option a:hover {
            background: #d97706;
        }

        .logout {
            background: #ef4444 !important;
        }

        .logout:hover {
            background: #dc2626 !important;
        }

        /* Mobile */
        @media (max-width: 750px) {
            .navbar {
                padding: 0 20px;
            }

            .container {
                padding: 25px;
            }

            .cards,
            .options {
                flex-direction: column;
            }

            .card,
            .option {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <div class="navbar">

        <div class="logo">
            Shop<span>Vibe</span>
        </div>

        <div class="admin">
            🛡️ Admin Panel
        </div>

    </div>


    <!-- Dashboard -->
    <div class="container">

        <div class="welcome">
            <h1>Admin Dashboard</h1>
            <p>Manage your Shop Vibe e-commerce store from here.</p>
        </div>


        <!-- Dashboard Cards -->
        <div class="cards">

            <div class="card">
                <div class="card-icon">🛍️</div>
                <h3>Products</h3>
                <p>Manage your store products</p>
            </div>

            <div class="card">
                <div class="card-icon">📦</div>
                <h3>Orders</h3>
                <p>Keep track of customer orders</p>
            </div>

            <div class="card">
                <div class="card-icon">👥</div>
                <h3>Customers</h3>
                <p>Manage your customers</p>
            </div>

        </div>


        <!-- Options -->
        <h2 class="section-title">Store Management</h2>

        <div class="options">

            <div class="option">
                <h2>➕ Add Product</h2>
                <p>Add new products to your Shop Vibe store.</p>

                <a href="addproduct.php">
                    Add Product
                </a>
            </div>


            <div class="option">
                <h2>👁️ View Products</h2>
                <p>View and manage all products in your store.</p>

                <a href="productview.php">
                    View Products
                </a>
            </div>


            <div class="option">
                <h2>🚪 Logout</h2>
                <p>Logout from your Shop Vibe admin account.</p>

                <a href="logout.php" class="logout">
                    Logout
                </a>
            </div>

        </div>

    </div>

</body>
</html>