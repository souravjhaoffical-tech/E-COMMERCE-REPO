
<?php

session_start();
include "db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];

    $stmt = mysqli_prepare($conn,
        "SELECT * FROM users WHERE email=?"
    );

    mysqli_stmt_bind_param($stmt,"s",$email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($pass,$user['password'])){

        $otp = random_int(100000,999999);

        $_SESSION['otp'] = password_hash((string)$otp, PASSWORD_DEFAULT);
        $_SESSION['otp_time'] = time();
        $_SESSION['attempts'] = 0;
        $_SESSION['pending_id'] = $user['id'];
        $_SESSION['pending_name'] = $user['name'];

        include "mail.php";

        try {

            $mail->addAddress($email);
            $mail->Subject = "Login OTP";
            $mail->Body = "Your OTP is: ".$otp;

            $mail->send();

            header("Location: gverify.php");
            exit();

        }catch(Exception $e){

            unset($_SESSION['otp'], $_SESSION['otp_time'],
                  $_SESSION['attempts'], $_SESSION['pending_id'],
                  $_SESSION['pending_name']);

            $error = "OTP Sending Failed. Please try again.";

        }

    }else{

        $error = "Wrong Email or Password";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>ShopVibe - Login</title>

<style>

/* GLOBAL */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* THEME COLORS */

:root {
    color-scheme: light;

    --page-bg: #f4f5fc;
    --card: #ffffff;
    --input: #f8f9ff;
    --text: #252b45;
    --muted: #7b8195;
    --border: #e0e3f0;
    --purple: #667eea;
    --pink: #764ba2;
}

/* BODY */

body {
    min-height: 100vh;

    display: flex;
    justify-content: center;
    align-items: center;

    padding: 25px 15px;

    background: var(--page-bg);
    color: var(--text);

    transition: 0.3s;
}

/* MAIN CONTAINER */

.container {
    width: 850px;
    max-width: 100%;
    min-height: 520px;

    display: flex;

    background: var(--card);

    border: 1px solid var(--border);
    border-radius: 22px;

    overflow: hidden;

    box-shadow: 0 15px 45px rgba(35,40,80,0.12);

    animation: appear 0.7s ease;
}

@keyframes appear {

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

    background: linear-gradient(
        135deg,
        #667eea,
        #764ba2
    );

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

    background: rgba(255,255,255,0.10);

    top: -80px;
    right: -80px;
}

.left::after {
    content: "";

    position: absolute;

    width: 180px;
    height: 180px;

    border-radius: 50%;

    background: rgba(255,255,255,0.08);

    bottom: -70px;
    left: -60px;
}

/* LOGO */

.logo {
    display: inline-flex;

    width: fit-content;

    margin-bottom: 65px;

    position: relative;
    z-index: 1;

    animation: logoFloat 3s infinite ease-in-out;
}

.logo img {
    width: 45px;
    height: 45px;

    border-radius: 50%;

    object-fit: cover;
}

@keyframes logoFloat {

    0%,100% {
        transform: translateY(0);
    }

    50% {
        transform: translateY(-5px);
    }

}

/* LEFT CONTENT */

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

    color: white;

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

    0%,100% {
        transform: translateY(0) rotate(-5deg);
    }

    50% {
        transform: translateY(-10px) rotate(5deg);
    }

}

/* RIGHT SECTION */

.right {
    width: 55%;
    min-width: 0;

    padding: 45px 50px;

    display: flex;
    flex-direction: column;

    justify-content: center;

    background: var(--card);
}

.right h2 {
    font-size: 32px;

    color: var(--text);

    margin-bottom: 8px;
}

.subtitle {
    color: var(--muted);

    font-size: 14px;
    line-height: 1.6;

    margin-bottom: 30px;
}

/* FORM */

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;

    color: var(--text);

    font-weight: bold;
    font-size: 14px;

    margin-bottom: 8px;
}

.input-box {
    position: relative;
}

input {
    width: 100%;
    height: 48px;

    padding: 0 15px;

    border: 1px solid var(--border);
    border-radius: 10px;

    outline: none;

    font-size: 14px;

    color: var(--text);

    background: var(--input);

    transition: 0.3s;
}

input::placeholder {
    color: var(--muted);
}

input:focus {
    border-color: var(--purple);

    background: var(--card);

    box-shadow: 0 0 0 3px rgba(102,126,234,0.13);
}

/* PASSWORD EYE */

.password-input {
    padding-right: 48px;
}

.toggle-password {
    position: absolute;

    right: 14px;
    top: 50%;

    transform: translateY(-50%);

    cursor: pointer;

    color: var(--muted);

    font-size: 18px;
}

/* LOGIN BUTTON */

.login-btn {
    width: 100%;
    height: 48px;

    border: none;
    border-radius: 10px;

    background: linear-gradient(
        135deg,
        #667eea,
        #764ba2
    );

    color: white;

    font-size: 16px;
    font-weight: bold;

    cursor: pointer;

    transition: 0.3s;

    box-shadow: 0 6px 15px rgba(102,126,234,0.22);
}

.login-btn:hover {
    transform: translateY(-2px);

    box-shadow: 0 9px 20px rgba(102,126,234,0.30);
}

.login-btn:active {
    transform: translateY(0);
}

/* ERROR MESSAGE */

.error-message {
    background: #fff0f0;

    border: 1px solid #ffd1d1;

    color: #d93025;

    padding: 12px;

    border-radius: 9px;

    font-size: 13px;

    margin-bottom: 18px;
}

/* REGISTER LINK */

.bottom-text {
    text-align: center;

    margin-top: 25px;

    font-size: 13px;

    color: var(--muted);

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

    margin-top: 20px;

    font-size: 12px;

    color: var(--muted);
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

/* AUTOMATIC DARK MODE */

@media (prefers-color-scheme: dark) {

    :root {
        color-scheme: dark;

        --page-bg: #101426;
        --card: #1b2038;
        --input: #252b46;
        --text: #f5f6ff;
        --muted: #a7aecb;
        --border: #363d5e;
        --purple: #8985ff;
        --pink: #b18aff;
    }

    .container {
        box-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }

    .login-btn {
        box-shadow: 0 7px 20px rgba(102,126,234,0.25);
    }

    .error-message {
        background: #3a202c;
        border-color: #633442;
        color: #ff9ba5;
    }

    .bottom-text a {
        color: #b6a8ff;
    }

    .bottom-text a:hover {
        color: #d1a4ff;
    }

}

</style>

</head>

<body>

<div class="container">

    <!-- LEFT SECTION -->

    <div class="left">

        <a href="index.php" class="logo">
            <img src="Assets/LOGO.jpg" alt="ShopVibe Logo">
        </a>

        <h1>Welcome Back!</h1>

        <p>
            Login to your ShopVibe account
            and continue exploring amazing
            products at great prices.
        </p>

        <div class="tagline">
            🛍️ Simple. Smart. Shopping.
        </div>

        <div class="cart">🛒</div>

    </div>

    <!-- RIGHT SECTION -->

    <div class="right">

        <h2>Welcome Back</h2>

        <p class="subtitle">
            Login to continue shopping with ShopVibe
        </p>

        <?php if(isset($error)){ ?>

            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>

        <?php } ?>

        <form method="post">

            <!-- EMAIL -->

            <div class="form-group">

                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>

            <!-- PASSWORD -->

            <div class="form-group">

                <label>Password</label>

                <div class="input-box">

                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="password-input"
                        placeholder="Enter your password"
                        required
                    >

                    <span
                        class="toggle-password"
                        onclick="togglePassword()"
                        id="eye"
                    >👁</span>

                </div>

            </div>

            <!-- LOGIN BUTTON -->

            <button type="submit" name="login" class="login-btn">
                Login
            </button>

        </form>

        <div class="bottom-text">

            Don't have an account?

            <a href="register.php">Create Account</a>

        </div>

        <div class="secure">
            🔒 Secure Login with Email OTP Verification
        </div>

    </div>

</div>

<script>

function togglePassword() {

    const password = document.getElementById("password");
    const eye = document.getElementById("eye");

    if(password.type === "password") {

        password.type = "text";
        eye.innerHTML = "🙈";

    } else {

        password.type = "password";
        eye.innerHTML = "👁";

    }

}

</script>

</body>
</html>
