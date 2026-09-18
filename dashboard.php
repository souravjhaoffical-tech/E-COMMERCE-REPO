
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
            min-height: 100vh;
            background: #eef1f7;
            color: #222;
            overflow-x: hidden;
            perspective: 1200px;
        }

        /* Animated Background */
        body::before,
        body::after {
            content: "";
            position: fixed;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 7s infinite alternate ease-in-out;
        }

        body::before {
            background: rgba(245, 158, 11, 0.25);
            top: 80px;
            left: -100px;
        }

        body::after {
            background: rgba(59, 130, 246, 0.20);
            bottom: -100px;
            right: -80px;
            animation-delay: 2s;
        }

        @keyframes float {
            from {
                transform: translate(0, 0);
            }

            to {
                transform: translate(80px, 50px);
            }
        }

        /* Navbar */
        .navbar {
            height: 75px;
            background: rgba(17, 24, 39, 0.95);
            backdrop-filter: blur(12px);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 50px;
            color: white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            animation: slideDown 0.8s ease;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .logo {
            font-size: 29px;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .logo span {
            color: #f59e0b;
        }

        .admin {
            background: rgba(255,255,255,0.08);
            padding: 10px 18px;
            border-radius: 30px;
            color: #d1d5db;
            font-size: 14px;
            border: 1px solid rgba(255,255,255,0.1);
        }

        /* Main */
        .container {
            padding: 50px;
            max-width: 1250px;
            margin: auto;
        }

        .welcome {
            margin-bottom: 40px;
            animation: fadeUp 0.8s ease;
        }

        @keyframes fadeUp {
            from {
                transform: translateY(40px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .welcome h1 {
            font-size: 38px;
            color: #111827;
            margin-bottom: 10px;
        }

        .welcome p {
            color: #6b7280;
            font-size: 15px;
        }

        /* Stats Cards */
        .cards {
            display: flex;
            gap: 25px;
            margin-bottom: 50px;
        }

        .card {
            flex: 1;
            min-height: 170px;
            padding: 30px;
            border-radius: 20px;
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(15px);
            box-shadow:
                0 15px 30px rgba(0,0,0,0.08),
                inset 0 1px 1px rgba(255,255,255,0.8);

            transform-style: preserve-3d;
            transition: 0.4s ease;
            animation: cardAppear 0.8s ease backwards;
        }

        .card:nth-child(1) {
            animation-delay: 0.2s;
        }

        .card:nth-child(2) {
            animation-delay: 0.4s;
        }

        .card:nth-child(3) {
            animation-delay: 0.6s;
        }

        @keyframes cardAppear {
            from {
                opacity: 0;
                transform: translateY(50px) rotateX(15deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        .card:hover {
            transform: translateY(-12px) rotateX(5deg) rotateY(-5deg);
            box-shadow:
                0 25px 45px rgba(0,0,0,0.15);
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 18px;
            display: inline-block;
            transform: translateZ(35px);
            animation: iconFloat 3s infinite ease-in-out;
        }

        @keyframes iconFloat {
            0%, 100% {
                transform: translateY(0) translateZ(35px);
            }

            50% {
                transform: translateY(-7px) translateZ(35px);
            }
        }

        .card h3 {
            color: #111827;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .card p {
            color: #6b7280;
            font-size: 14px;
        }

        /* Management */
        .section-title {
            font-size: 24px;
            color: #111827;
            margin-bottom: 22px;
        }

        .options {
            display: flex;
            gap: 25px;
        }

        .option {
            flex: 1;
            padding: 32px;
            border-radius: 20px;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(15px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
            transition: 0.4s ease;
            transform-style: preserve-3d;
            animation: fadeUp 1s ease;
        }

        .option:hover {
            transform: translateY(-10px) rotateX(4deg);
            box-shadow: 0 25px 45px rgba(0,0,0,0.15);
        }

        .option h2 {
            font-size: 21px;
            margin-bottom: 12px;
            color: #111827;
        }

        .option p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Buttons */
        .option a {
            display: inline-block;
            text-decoration: none;
            background: #f59e0b;
            color: white;
            padding: 12px 22px;
            border-radius: 9px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            box-shadow: 0 7px 0 #c47b06;
        }

        .option a:hover {
            transform: translateY(-4px);
            box-shadow: 0 11px 0 #c47b06;
        }

        .option a:active {
            transform: translateY(3px);
            box-shadow: 0 3px 0 #c47b06;
        }

        .logout {
            background: #ef4444 !important;
            box-shadow: 0 7px 0 #b91c1c !important;
        }

        .logout:hover {
            box-shadow: 0 11px 0 #b91c1c !important;
        }

        /* Responsive */
        @media (max-width: 800px) {

            .navbar {
                padding: 0 20px;
            }

            .container {
                padding: 30px 20px;
            }

            .cards,
            .options {
                flex-direction: column;
            }

            .card,
            .option {
                width: 100%;
            }

            .welcome h1 {
                font-size: 30px;
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
            <p>Manage your Shop Vibe e-commerce store from one place.</p>
        </div>


        <!-- Stats -->
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


        <!-- Management -->
        <h2 class="section-title">Store Management</h2>

        <div class="options">

            <div class="option">
                <h2>➕ Add Product</h2>
                <p>
                    Add new products and make them
                    available on your Shop Vibe store.
                </p>

                <a href="addproduct.php">
                    Add Product
                </a>
            </div>


            <div class="option">
                <h2>👁️ View Products</h2>
                <p>
                    View, check and manage all the
                    products available in your store.
                </p>

                <a href="productview.php">
                    View Products
                </a>
            </div>


            <div class="option">
                <h2>🚪 Logout</h2>
                <p>
                    Logout safely from your
                    Shop Vibe admin account.
                </p>

                <a href="logout.php" class="logout">
                    Logout
                </a>
            </div>

        </div>

    </div>

</body>
</html>

