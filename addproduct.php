
<?php

include "db.php";

$message = "";

if (isset($_POST['add'])) {

    $brand = trim($_POST['brand']);
    $name = trim($_POST['name']);
    $price = (int) $_POST['price'];

    if (
        isset($_FILES['image']) &&
        $_FILES['image']['error'] === UPLOAD_ERR_OK
    ) {

        $temp = $_FILES['image']['tmp_name'];
        $originalName = basename($_FILES['image']['name']);
        $image = uniqid() . "_" . $originalName;

        if (!is_dir("uploads")) {
            mkdir("uploads", 0755, true);
        }

        if (move_uploaded_file($temp, "uploads/" . $image)) {

            $query = "INSERT INTO eproduct
                      (p_brand, p_name, p_price, image)
                      VALUES (?, ?, ?, ?)";

            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param(
                $stmt,
                "ssis",
                $brand,
                $name,
                $price,
                $image
            );

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_close($stmt);

                header("Location: product.php");
                exit();

            } else {

                $message = "Product could not be saved.";
            }

        } else {

            $message = "Image upload failed. Please try again.";
        }

    } else {

        $message = "Please select a product image.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ShopVibe - Add Product</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f5f6fa;
            color: #172033;
        }

        /* NAVBAR */

        .navbar {
            min-height: 75px;
            padding: 15px 6%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            background: #172033;
            border-bottom: 3px solid #f59e0b;
        }

        .logo {
            color: white;
            font-size: 29px;
            font-weight: bold;
            letter-spacing: -1px;
        }

        .logo span {
            color: #ffad26;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 11px 18px;
            border: 1px solid #566075;
            border-radius: 8px;
            transition: 0.25s;
            font-size: 14px;
        }

        .nav-link:hover {
            background: #f59e0b;
            border-color: #f59e0b;
            color: #172033;
        }

        /* MAIN CONTENT */

        .main {
            width: 88%;
            max-width: 1150px;
            margin: 55px auto;
        }

        .heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 35px;
        }

        .heading h1 {
            font-size: 34px;
            color: #172033;
            margin-bottom: 9px;
        }

        .heading p {
            color: #737d90;
            font-size: 15px;
            line-height: 1.6;
        }

        .heading-mark {
            width: 58px;
            height: 58px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff0d6;
            color: #d97706;
            border-radius: 16px;
            font-size: 29px;
        }

        /* FORM AREA */

        .form-area {
            background: white;
            padding: 32px;
            border: 1px solid #e5e8ef;
            border-radius: 14px;
            box-shadow: 0 10px 35px rgba(23, 32, 51, 0.05);
        }

        .form-title {
            color: #172033;
            font-size: 19px;
            margin-bottom: 8px;
        }

        .form-description {
            color: #8991a1;
            font-size: 13px;
            margin-bottom: 28px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px 30px;
        }

        .form-group label {
            display: block;
            color: #30394b;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-group input {
            width: 100%;
            min-width: 0;
            padding: 14px 15px;
            border: 1px solid #dce1ea;
            border-radius: 8px;
            background: #fafbfe;
            color: #172033;
            font-size: 14px;
            outline: none;
            transition: 0.25s;
        }

        .form-group input:focus {
            border-color: #f59e0b;
            background: white;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.12);
        }

        .form-group input[type="file"] {
            padding: 10px;
            cursor: pointer;
        }

        .form-group input[type="file"]::file-selector-button {
            background: #fff0d6;
            color: #9a5b00;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            margin-right: 12px;
            cursor: pointer;
        }

        /* FORM FOOTER */

        .form-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #edf0f5;
        }

        .hint {
            color: #8a93a3;
            font-size: 13px;
            line-height: 1.5;
        }

        .add-button {
            border: none;
            border-radius: 8px;
            padding: 14px 25px;
            color: white;
            font-size: 14px;
            font-weight: bold;
            background: linear-gradient(135deg, #f9a11b, #ed7b12);
            box-shadow: 0 4px 0 #c9610b;
            cursor: pointer;
            transition: 0.25s;
        }

        .add-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 7px 0 #c9610b;
            background: linear-gradient(135deg, #ffb638, #f08018);
        }

        .add-button:active {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #c9610b;
        }

        .message {
            padding: 13px 16px;
            margin-bottom: 22px;
            background: #fff1f0;
            color: #b42318;
            border-left: 4px solid #ef4444;
            border-radius: 5px;
            font-size: 14px;
        }

        /* BOTTOM */

        .bottom {
            margin-top: 25px;
            text-align: center;
            color: #939baa;
            font-size: 13px;
        }

        .bottom span {
            color: #e58a0b;
            font-weight: bold;
        }

        /* RESPONSIVE */

        @media (max-width: 650px) {

            .navbar {
                padding: 18px 5%;
            }

            .logo {
                font-size: 24px;
            }

            .nav-link {
                padding: 10px;
                font-size: 12px;
            }

            .main {
                width: 92%;
                margin: 35px auto;
            }

            .heading h1 {
                font-size: 27px;
            }

            .heading-mark {
                width: 45px;
                height: 45px;
                font-size: 23px;
            }

            .form-area {
                padding: 23px 18px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .form-footer {
                align-items: stretch;
                flex-direction: column;
            }

            .add-button {
                width: 100%;
            }
        }

    </style>

</head>

<body>

    <nav class="navbar">

        <div class="logo">
            Shop<span>Vibe</span>
        </div>

        <a href="admin_dashboard.php" class="nav-link">
            ← Admin Dashboard
        </a>

    </nav>


    <main class="main">

        <div class="heading">

            <div>
                <h1>Add Product</h1>

                <p>
                    Add something new to your ShopVibe store.
                    Fill in the details below.
                </p>
            </div>

            <div class="heading-mark">
                +
            </div>

        </div>


        <section class="form-area">

            <h2 class="form-title">
                Product Information
            </h2>

            <p class="form-description">
                Enter the product details and upload its image.
            </p>


            <?php if ($message != "") { ?>

                <div class="message">
                    <?php echo htmlspecialchars($message); ?>
                </div>

            <?php } ?>


            <form method="post" enctype="multipart/form-data">

                <div class="form-grid">

                    <div class="form-group">

                        <label for="brand">Product Brand</label>

                        <input
                            type="text"
                            id="brand"
                            name="brand"
                            placeholder="e.g. Nike"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="name">Product Name</label>

                        <input
                            type="text"
                            id="name"
                            name="name"
                            placeholder="Enter product name"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="price">Product Price (₹)</label>

                        <input
                            type="number"
                            id="price"
                            name="price"
                            placeholder="Enter price"
                            min="1"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="image">Product Image</label>

                        <input
                            type="file"
                            id="image"
                            name="image"
                            accept="image/*"
                            required
                        >

                    </div>

                </div>


                <div class="form-footer">

                    <p class="hint">
                        🛍️ Make sure the product details are correct.
                    </p>

                    <button type="submit" name="add" class="add-button">
                        + &nbsp; Add Product
                    </button>

                </div>

            </form>

        </section>


        <div class="bottom">
            Made for <span>ShopVibe</span> · Manage your store with ease
        </div>

    </main>

</body>

</html>