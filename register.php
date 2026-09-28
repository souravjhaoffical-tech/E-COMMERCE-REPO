<?php
include "db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name,email,password)
            VALUES ('$name','$email','$password')";

    mysqli_query($conn, $sql);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopEase - Register</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    min-height: 100vh;
    background: #eef2fa;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* MAIN BOX */

.container {
    width: 850px;
    height: 500px;
    display: flex;
    background: white;
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

/* LEFT */

.left {
    width: 45%;
    background: #182335;
    color: white;
    padding: 45px;
    position: relative;
}

.logo {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 65px;
}

.logo span {
    color: #ff9d00;
}

.left h1 {
    font-size: 34px;
    margin-bottom: 15px;
}

.left p {
    color: #cbd0d9;
    line-height: 1.5;
    font-size: 15px;
}

.tagline {
    position: absolute;
    bottom: 55px;
    color: #ff9d00;
    font-weight: bold;
    font-size: 15px;
}

.cart {
    position: absolute;
    right: 30px;
    bottom: 30px;
    font-size: 50px;
}

/* RIGHT */

.right {
    width: 55%;
    padding: 45px 55px;
}

.right h2 {
    font-size: 32px;
    color: #182335;
    margin-bottom: 7px;
}

.subtitle {
    color: #737b8b;
    font-size: 14px;
    margin-bottom: 27px;
}

.form-group {
    margin-bottom: 16px;
}

label {
    display: block;
    color: #374151;
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 7px;
}

input {
    width: 100%;
    height: 43px;
    padding: 0 15px;
    border: 1px solid #d5d9e0;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
}

input:focus {
    border-color: #ff9d00;
}

button {
    width: 100%;
    height: 45px;
    margin-top: 5px;
    border: none;
    border-radius: 10px;
    background: #f99a05;
    color: white;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
}

button:hover {
    background: #e98900;
}

.bottom-text {
    text-align: center;
    margin-top: 18px;
    font-size: 13px;
    color: #737b8b;
}

.bottom-text a {
    color: #e88900;
    font-weight: bold;
    text-decoration: none;
}

.secure {
    text-align: center;
    margin-top: 15px;
    font-size: 12px;
    color: #8a919d;
}

/* MOBILE */

@media(max-width: 750px) {

    .container {
        width: 92%;
        height: auto;
        flex-direction: column;
    }

    .left,
    .right {
        width: 100%;
    }

    .left {
        padding: 30px;
        min-height: 250px;
    }

    .logo {
        margin-bottom: 35px;
    }

    .tagline {
        bottom: 25px;
    }

    .cart {
        bottom: 15px;
    }

    .right {
        padding: 30px;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="left">

        <div class="logo">
            Shop<span>Ease</span>
        </div>

        <h1>Join Us!</h1>

        <p>
            Create your account and enjoy
            easy shopping with amazing products
            at great prices.
        </p>

        <div class="tagline">
            🛍️ Simple. Smart. Shopping.
        </div>

        <div class="cart">🛒</div>

    </div>


    <div class="right">

        <h2>Create Account</h2>

        <p class="subtitle">
            Register to start shopping with ShopEase
        </p>

        <form method="post">

            <div class="form-group">
                <label>Full Name</label>
                <input type="text"
                       name="name"
                       placeholder="Enter your name"
                       required>
            </div>

            <div class="form-group">
                <label>Email Address</label>
                <input type="email"
                       name="email"
                       placeholder="Enter your email"
                       required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password"
                       name="password"
                       placeholder="Create a password"
                       required>
            </div>

            <button type="submit" name="register">
                Register
            </button>

        </form>

        <div class="bottom-text">
            Already have an account?
            <a href="login.php">Login</a>
        </div>

        <div class="secure">
            🔒 Secure registration
        </div>

    </div>

</div>

</body>
</html>