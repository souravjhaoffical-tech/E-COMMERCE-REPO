
<?php

session_start();

include "db.php";

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $query = "SELECT * FROM users 
              WHERE email='$email' 
              AND password='$password' 
              AND role='$role'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] == 'admin') {

            header("Location: dashboard.php");
            exit();

        } else {

            header("Location: users_home.php");
            exit();
        }

    } else {

        $message = "Invalid email, password or login type!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>ShopVibe - Login</title>
    
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 25px 0;
    background: #f5f6fa;
    overflow-x: hidden;
}

/* Background Circles */
.circle {
    position: fixed;
    border-radius: 50%;
    filter: blur(3px);
    opacity: 0.12;
    z-index: -1;
    animation: moveCircle 8s infinite alternate ease-in-out;
}

.circle.one {
    width: 280px;
    height: 280px;
    background: #667eea;
    top: -100px;
    left: -80px;
}

.circle.two {
    width: 350px;
    height: 350px;
    background: #764ba2;
    bottom: -150px;
    right: -100px;
    animation-delay: 2s;
}

@keyframes moveCircle {
    from {
        transform: translate(0, 0);
    }
    to {
        transform: translate(35px, 40px);
    }
}

/* Main Container */
.login-container {
    width: 900px;
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

/* Left Section */
.left-section {
    width: 50%;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 50px;
    position: relative;
    overflow: hidden;
}

.left-section::before {
    content: "";
    position: absolute;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.10);
    top: -100px;
    right: -80px;
}

.left-section::after {
    content: "";
    position: absolute;
    width: 180px;
    height: 180px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.08);
    bottom: -80px;
    left: -60px;
}

/* Logo */
.logo {
    font-size: 34px;
    font-weight: bold;
    margin-bottom: 35px;
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

.left-section h1 {
    font-size: 38px;
    margin-bottom: 18px;
    position: relative;
    z-index: 1;
}

.left-section p {
    color: #f1f2ff;
    line-height: 1.8;
    font-size: 15px;
    max-width: 340px;
    position: relative;
    z-index: 1;
}

.shop-text {
    margin-top: 35px;
    font-size: 15px;
    color: #ffffff;
    font-weight: bold;
    position: relative;
    z-index: 1;
    animation: logoFloat 3s infinite ease-in-out;
}

.floating-icon {
    position: absolute;
    font-size: 55px;
    right: 45px;
    bottom: 40px;
    z-index: 1;
    animation: floating 3s infinite ease-in-out;
}

@keyframes floating {
    0%, 100% {
        transform: translateY(0) rotate(-5deg);
    }
    50% {
        transform: translateY(-12px) rotate(5deg);
    }
}

/* Right Section */
.right-section {
    width: 50%;
    padding: 50px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: #ffffff;
}

.right-section h2 {
    font-size: 32px;
    color: #252b45;
    margin-bottom: 8px;
}

.subtitle {
    color: #7b8195;
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 28px;
}

/* Labels */
label {
    display: block;
    margin-bottom: 7px;
    color: #41465d;
    font-weight: bold;
    font-size: 14px;
}

/* Input Fields */
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 14px 15px;
    border: 1px solid #dfe2ed;
    border-radius: 10px;
    outline: none;
    margin-bottom: 20px;
    font-size: 14px;
    color: #252b45;
    background: #fafbff;
    transition: 0.3s;
}

input[type="email"]:focus,
input[type="password"]:focus {
    border-color: #667eea;
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.13);
}

/* User / Admin Selection */
.role-box {
    margin-bottom: 22px;
}

.role-title {
    display: block;
    margin-bottom: 10px;
    color: #41465d;
    font-weight: bold;
    font-size: 14px;
}

.role-options {
    display: flex;
    gap: 12px;
}

.role-option {
    flex: 1;
    padding: 12px 8px;
    border: 1px solid #dfe2ed;
    border-radius: 10px;
    background: #fafbff;
    cursor: pointer;
    text-align: center;
    transition: 0.3s;
}

.role-option:hover {
    border-color: #667eea;
    background: #f1f2ff;
    transform: translateY(-2px);
}

.role-option input {
    width: auto;
    margin: 0 6px 0 0;
    accent-color: #667eea;
    cursor: pointer;
}

/* Login Button */
button {
    width: 100%;
    padding: 15px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
    border-radius: 10px;
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

/* Error Message */
.error-message {
    background: #fff0f0;
    color: #c53030;
    border: 1px solid #fed7d7;
    padding: 11px;
    border-radius: 8px;
    margin-bottom: 18px;
    text-align: center;
    font-size: 13px;
    font-weight: bold;
}

/* Create Account */
.create-account {
    text-align: center;
    margin-top: 18px;
    color: #7b8195;
    font-size: 14px;
}

.create-account a {
    color: #667eea;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

.create-account a:hover {
    color: #764ba2;
    text-decoration: underline;
}

/* Bottom Text */
.bottom-text {
    text-align: center;
    margin-top: 22px;
    color: #8b90a3;
    font-size: 12px;
    line-height: 1.6;
}

/* Responsive Design */
@media (max-width: 750px) {
    body {
        padding: 20px 0;
    }

    .login-container {
        width: 92%;
        max-width: 500px;
        flex-direction: column;
        margin: 10px 0;
    }

    .left-section,
    .right-section {
        width: 100%;
    }

    .left-section {
        padding: 35px 30px;
    }

    .logo {
        font-size: 30px;
        margin-bottom: 22px;
    }

    .left-section h1 {
        font-size: 30px;
    }

    .left-section p {
        font-size: 14px;
    }

    .shop-text {
        margin-top: 22px;
    }

    .right-section {
        padding: 35px 30px;
    }

    .right-section h2 {
        font-size: 28px;
    }

    .floating-icon {
        display: none;
    }
}

@media (max-width: 380px) {
    .left-section,
    .right-section {
        padding: 28px 22px;
    }

    .role-options {
        gap: 8px;
    }

    .role-option {
        padding: 10px 5px;
        font-size: 13px;
    }
}
</style>
</head>

<body>

<!-- Animated Background -->

<div class="circle one"></div>
<div class="circle two"></div>


<div class="login-container">

    <!-- LEFT SIDE -->

    <div class="left-section">

        <div class="logo">
            Shop<span>Vibe</span>
        </div>

        <h1>
            Welcome Back!
        </h1>

        <p>
            Login to your account and continue shopping
            your favourite products at the best prices.
        </p>

        <div class="shop-text">
            🛍️ Shop Smart. Shop Easy.
        </div>

        <div class="floating-icon">
            🛒
        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="right-section">

        <h2>
            Login
        </h2>

        <p class="subtitle">
            Sign in to follow the trends and get the best deals on ShopVibe
        </p>


        <?php if ($message != "") { ?>

            <div class="error-message">
                <?php echo $message; ?>
            </div>

        <?php } ?>


        <form method="post">

            <label>
                Email Address
            </label>

            <input
                type="email"
                name="email"
                placeholder="Enter your email"
                required
            >


            <label>
                Password
            </label>

            <input
                type="password"
                name="password"
                placeholder="Enter your password"
                required
            >


            <!-- USER / ADMIN SELECTION -->
            <div class="role-box">
                <span class="role-title">
                    Are you Admin or User?
                </span>
                <div class="role-options">
                    <label class="role-option">
                        <input
                            type="radio" name="role" value="user" checked > 
                        User
                    </label>
                    <label class="role-option">
                        <input
                            type="radio" name="role" value="admin">
                        Admin
                    </label>
                </div>
            </div>
            <button name="login"> Login </button>
            <div class="create-account">
            <a href="register.php">Create an Account</a>
            </div>
        </form>
        <div class="bottom-text"> 🔒 Secure access to your ShopVibe dashboard </div>
    </div>
</div>
</body>
</html>
