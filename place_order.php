<?php 
session_start();
include "db.php";

if(isset($_Session['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_POST['order'])){
    $user = $_SESSION['user'];
    $payment = $_POST['payment_method'];
    $cart = $_SESSION['cart'] ??[];

    foreach($cart as $id) {
        $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
        $product = mysqli_fetch_assoc($result);

        $name = $product['p_name'];
        $price = $product['p_price'];

        $sql = "INSERT INTO orders (user, product_name, product_price, payment_method) VALUES ('$user', '$name', '$price', '$payment')";
    }
}