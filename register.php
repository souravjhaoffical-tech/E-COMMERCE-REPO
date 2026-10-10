<?php
include "db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "INSERT INTO users (name,email,password)
            VALUES ('$name','$email','$password')";

    mysqli_query($conn, $sql);

    header("Location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopVibe - Register</title>

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
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 25px 0;
    overflow-x: hidden;
}

/* MAIN CONTAINER */
.container {
    width: 850px;
    max-width: 92%;
    min-height: 520px;
    display: flex;
    background: #ffffff;
    border: 1px solid #e9eaf2;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 45px rgba(35, 40, 80, 0.12);
    animation: containerAppear 0.7s ease;
}

@keyframes containerAppear {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* LEFT SECTION */
.left {
    width: 45%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    padding: 45px;
    position: relative;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    overflow: hidden;
}

.left::before {
    content: "";
    position: absolute;
    width: 230px;
    height: 230px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.10);
    top: -80px;
    right: -80px;
}

.left::after {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    bottom: -70px;
    left: -60px;
}

.logo {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 65px;
    position: relative;
    z-index: 1;
    animation: logoFloat 3s infinite ease-in-out;
}

.logo span {
    color: #e0e7ff;
}

@keyframes logoFloat {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-5px);
    }
}

.left h1 {
    font-size: 34px;
    margin-bottom: 15px;
    position: relative;
    z-index: 1;
}

.left p {
    color: #f1f2ff;
    line-height: 1.8;
    font-size: 15px;
    position: relative;
    z-index: 1;
}

.tagline {
    position: absolute;
    bottom: 45px;
    left: 45px;
    color: #ffffff;
    font-weight: bold;
    font-size: 14px;
    z-index: 1;
}

.cart {
    position: absolute;
    right: 25px;
    bottom: 25px;
    font-size: 45px;
    z-index: 1;
    animation: cartFloat 3s infinite ease-in-out;
}

@keyframes cartFloat {
    0%, 100% {
        transform: translateY(0) rotate(-5deg);
    }
    50% {
        transform: translateY(-10px) rotate(5deg);
    }
}

/* RIGHT SECTION */
.right {
    width: 55%;
    padding: 45px 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #ffffff;
}

.right h2 {
    font-size: 32px;
    color: #252b45;
    margin-bottom: 8px;
}

.subtitle {
    color: #7b8195;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 27px;
}

/* FORM */
.form-group {
    margin-bottom: 17px;
}

label {
    display: block;
    color: #41465d;
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 7px;
}

input {
    width: 100%;
    height: 45px;
    padding: 0 15px;
    border: 1px solid #dfe2ed;
    border-radius: 10px;
    outline: none;
    font-size: 14px;
    color: #252b45;
    background: #fafbff;
    transition: 0.3s;
}

input:focus {
    border-color: #667eea;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.13);
}

input::placeholder {
    color: #a0a5b5;
}

/* REGISTER BUTTON */
button {
    width: 100%;
    height: 47px;
    margin-top: 5px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 6px 15px rgba(102, 126, 234, 0.22);
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 9px 20px rgba(102, 126, 234, 0.30);
}

button:active {
    transform: translateY(0);
}

/* LOGIN LINK */
.bottom-text {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    color: #7b8195;
    line-height: 1.7;
}

.bottom-text a {
    color: #667eea;
    font-weight: bold;
    text-decoration: none;
    margin-left: 4px;
    transition: 0.3s;
}

.bottom-text a:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* SECURE TEXT */
.secure {
    text-align: center;
    margin-top: 17px;
    font-size: 12px;
    color: #8b90a3;
}

/* MOBILE RESPONSIVE */
@media (max-width: 750px) {
    body {
        padding: 20px 0;
    }

    .container {
        width: 92%;
        max-width: 500px;
        min-height: auto;
        flex-direction: column;
        margin: 10px 0;
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
        font-size: 28px;
        margin-bottom: 35px;
    }

    .left h1 {
        font-size: 30px;
    }

    .left p {
        font-size: 14px;
        max-width: 300px;
    }

    .tagline {
        position: relative;
        left: auto;
        bottom: auto;
        margin-top: 25px;
        padding-bottom: 5px;
    }

    .cart {
        right: 22px;
        bottom: 20px;
        font-size: 38px;
    }

    .right {
        padding: 35px 30px;
    }

    .right h2 {
        font-size: 28px;
    }
}

@media (max-width: 380px) {
    .left {
        padding: 25px 22px;
    }

    .right {
        padding: 28px 22px;
    }

    .cart {
        font-size: 32px;
        right: 15px;
    }
}
</style>
</head>

<body>

<div class="container">

    <div class="left">

        <div class="logo">
            Shop<span>Vibe</span>
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
            Register to start shopping with ShopVibe
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