<?php

session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['cart'])) {
    die("Please add products to your cart.");
}

if (isset($_POST['order'])) {

    $user = $_SESSION['user'];
    $payment = $_POST['payment_method'] ?? "";

    if ($payment == "Razorpay") {
        header("Location: razorpay.php");
        exit();
    }

    if ($payment != "COD") {
        die("Invalid payment method");
    }

    foreach (array_unique($_SESSION['cart']) as $id) {

        $id = (int) $id;

        $result = mysqli_query(
            $conn,
            "SELECT * FROM products WHERE id = $id"
        );

        if (!$result) {
            die("Product query failed.");
        }

        $product = mysqli_fetch_assoc($result);

        if (!$product) {
            die("Product not found.");
        }

        $name = $product['p_name'];
        $price = $product['p_price'];

        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO orders
            (user, product_name, product_price, payment_method)
            VALUES (?, ?, ?, ?)"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssds",
            $user,
            $name,
            $price,
            $payment
        );

        if (!mysqli_stmt_execute($stmt)) {
            die("Order failed.");
        }

        mysqli_stmt_close($stmt);
    }

    unset($_SESSION['cart']);

    header("Location: success.php");
    exit();
}

?>
```