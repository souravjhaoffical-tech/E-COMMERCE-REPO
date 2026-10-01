
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
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            overflow: hidden;
            perspective: 1200px;
        }

        /* ANIMATED BACKGROUND */

        .circle {
            position: fixed;
            border-radius: 50%;
            filter: blur(2px);
            opacity: 0.5;
            z-index: -1;
            animation: moveCircle 8s infinite alternate ease-in-out;
        }

        .circle.one {
            width: 280px;
            height: 280px;
            background: #f59e0b;
            top: -100px;
            left: -80px;
        }

        .circle.two {
            width: 350px;
            height: 350px;
            background: #6366f1;
            bottom: -150px;
            right: -100px;
            animation-delay: 2s;
        }

        @keyframes moveCircle {

            0% {
                transform: translate(0, 0) scale(1);
            }

            50% {
                transform: translate(70px, 40px) scale(1.1);
            }

            100% {
                transform: translate(-30px, 80px) scale(0.9);
            }
        }

        /* MAIN 3D CONTAINER */

        .login-container {
            width: 900px;
            min-height: 520px;

            display: flex;

            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px);

            border: 1px solid rgba(255,255,255,0.8);
            border-radius: 25px;

            overflow: hidden;

            box-shadow:
                0 30px 70px rgba(0,0,0,0.15),
                0 10px 20px rgba(0,0,0,0.08);

            transform-style: preserve-3d;

            animation: containerAppear 1s ease;
        }

        @keyframes containerAppear {

            from {
                opacity: 0;
                transform:
                    translateY(80px)
                    rotateX(15deg)
                    scale(0.9);
            }

            to {
                opacity: 1;
                transform:
                    translateY(0)
                    rotateX(0)
                    scale(1);
            }
        }

        /* LEFT SIDE */

        .left-section {
            width: 50%;

            background:
                linear-gradient(
                    135deg,
                    #111827,
                    #1f2937,
                    #374151
                );

            color: white;

            display: flex;
            flex-direction: column;
            justify-content: center;

            padding: 55px;

            position: relative;

            overflow: hidden;
        }

        /* LIGHT EFFECT */

        .left-section::before {

            content: "";

            position: absolute;

            width: 250px;
            height: 250px;

            border-radius: 50%;

            background: rgba(245,158,11,0.18);

            top: -100px;
            right: -80px;

            animation: glowMove 5s infinite alternate;
        }

        @keyframes glowMove {

            from {
                transform: translate(0,0);
            }

            to {
                transform: translate(-80px,120px);
            }
        }

        /* LOGO */

        .logo {
            font-size: 34px;
            font-weight: bold;
            margin-bottom: 35px;

            position: relative;

            transform: translateZ(40px);

            animation: logoFloat 3s infinite ease-in-out;
        }

        .logo span {
            color: #f59e0b;
        }

        @keyframes logoFloat {

            0%,100% {
                transform: translateY(0) translateZ(40px);
            }

            50% {
                transform: translateY(-8px) translateZ(40px);
            }
        }

        .left-section h1 {

            font-size: 42px;

            margin-bottom: 18px;

            position: relative;

            transform: translateZ(35px);
        }

        .left-section p {

            color: #d1d5db;

            line-height: 1.7;

            font-size: 15px;

            max-width: 340px;

            position: relative;

            transform: translateZ(25px);
        }

        .shop-text {

            margin-top: 40px;

            font-size: 15px;

            color: #f59e0b;

            font-weight: bold;

            position: relative;

            transform: translateZ(45px);

            animation: textFloat 2.5s infinite ease-in-out;
        }

        @keyframes textFloat {

            0%,100% {
                transform: translateY(0) translateZ(45px);
            }

            50% {
                transform: translateY(-5px) translateZ(45px);
            }
        }

        /* FLOATING SHOP ICON */

        .floating-icon {

            position: absolute;

            font-size: 55px;

            right: 55px;

            bottom: 50px;

            animation:
                floating 3s infinite ease-in-out;

            filter:
                drop-shadow(
                    0 12px 8px rgba(0,0,0,0.3)
                );
        }

        @keyframes floating {

            0%,100% {
                transform:
                    translateY(0)
                    rotate(-5deg);
            }

            50% {
                transform:
                    translateY(-18px)
                    rotate(5deg);
            }
        }

        /* RIGHT SECTION */

        .right-section {

            width: 50%;

            padding: 55px;

            display: flex;

            flex-direction: column;

            justify-content: center;

            background: rgba(255,255,255,0.55);
        }

        .right-section h2 {

            font-size: 32px;

            color: #111827;

            margin-bottom: 8px;
        }

        .subtitle {

            color: #6b7280;

            font-size: 14px;

            margin-bottom: 30px;
        }

        /* INPUT */

        label {

            display: block;

            margin-bottom: 7px;

            color: #374151;

            font-weight: bold;

            font-size: 14px;
        }

        input[type="email"],
        input[type="password"] {

            width: 100%;

            padding: 14px 16px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            outline: none;

            margin-bottom: 20px;

            font-size: 14px;

            background: rgba(255,255,255,0.9);

            transition: 0.3s;

            box-shadow:
                0 5px 12px rgba(0,0,0,0.04);
        }

        input[type="email"]:focus,
        input[type="password"]:focus {

            border-color: #f59e0b;

            transform: translateY(-2px);

            box-shadow:
                0 0 0 3px rgba(245,158,11,0.15),
                0 8px 18px rgba(0,0,0,0.08);
        }

        /* USER / ADMIN */

        .role-box {

            margin-bottom: 22px;
        }

        .role-title {

            display: block;

            margin-bottom: 10px;

            color: #374151;

            font-weight: bold;

            font-size: 14px;
        }

        .role-options {

            display: flex;

            gap: 15px;
        }

        .role-option {

            flex: 1;

            padding: 12px;

            border: 1px solid #d1d5db;

            border-radius: 10px;

            background: white;

            cursor: pointer;

            text-align: center;

            transition: 0.3s;

            box-shadow:
                0 4px 10px rgba(0,0,0,0.05);
        }

        .role-option:hover {

            transform: translateY(-3px);

            border-color: #f59e0b;

            box-shadow:
                0 8px 18px rgba(0,0,0,0.1);
        }

        .role-option input {

            width: auto;

            margin: 0 6px 0 0;

            accent-color: #f59e0b;
        }

        /* 3D BUTTON */

        button {

            width: 100%;

            padding: 15px;

            background: linear-gradient(
                135deg,
                #f59e0b,
                #d97706
            );

            border: none;

            border-radius: 10px;

            color: white;

            font-size: 16px;

            font-weight: bold;

            cursor: pointer;

            transition: 0.3s;

            box-shadow:
                0 7px 0 #a16207,
                0 12px 25px rgba(245,158,11,0.25);
        }

        button:hover {

            transform:
                translateY(-5px)
                scale(1.02);

            box-shadow:
                0 12px 0 #a16207,
                0 20px 30px rgba(245,158,11,0.3);
        }

        button:active {

            transform: translateY(3px);

            box-shadow:
                0 3px 0 #a16207;
        }

        /* ERROR MESSAGE */

        .error-message {

            background: #fee2e2;

            color: #b91c1c;

            padding: 10px;

            border-radius: 8px;

            margin-bottom: 18px;

            text-align: center;

            font-size: 13px;

            font-weight: bold;
        }

        /* BOTTOM TEXT */

        .bottom-text {

            text-align: center;

            margin-top: 22px;

            color: #6b7280;

            font-size: 13px;
        }

        /* RESPONSIVE */

        @media (max-width: 750px) {

            body {
                overflow-y: auto;
            }

            .login-container {

                width: 92%;

                flex-direction: column;

                margin: 25px 0;
            }

            .left-section,
            .right-section {

                width: 100%;
            }

            .left-section {

                padding: 40px;
            }

            .left-section h1 {

                font-size: 30px;
            }

            .right-section {

                padding: 40px 30px;
            }

            .floating-icon {

                display: none;
            }
        }
        .create-account {
    text-align: center;
    margin-top: 18px;
    color: #6b7280;
    font-size: 14px;
}

.create-account a {
    color: #f59e0b;
    font-weight: bold;
    text-decoration: none;
    margin-left: 5px;
    transition: 0.3s;
}

.create-account a:hover {
    color: #d97706;
    text-decoration: underline;
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
