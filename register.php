<?php
include "db.php";

$message = "";
$message_type = "";

if (isset($_POST['register'])) {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check email already exists
    $check = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($conn, $check);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {

        $message = "Email already registered!";
        $message_type = "error";

    } else {

        // Secure password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (name, email, password, role)
                VALUES (?, ?, ?, 'user')";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $name,
            $email,
            $hashed_password
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: user_login.php");
            exit;

        } else {

            $message = "Registration failed. Please try again.";
            $message_type = "error";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account</title>

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
            justify-content: center;
            align-items: center;

            background:
                linear-gradient(
                    135deg,
                    #667eea,
                    #764ba2
                );

            padding: 20px;
        }

        .register-container {
            width: 100%;
            max-width: 430px;
        }

        .register-card {
            background: white;
            padding: 40px;
            border-radius: 20px;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.2);

            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {

            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        .logo {
            width: 70px;
            height: 70px;

            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: linear-gradient(
                135deg,
                #667eea,
                #764ba2
            );

            color: white;

            font-size: 30px;
            font-weight: bold;
        }

        h2 {
            text-align: center;
            color: #222;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;

            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .input-group input {
            width: 100%;

            padding: 13px 15px;

            border: 1px solid #ddd;
            border-radius: 10px;

            outline: none;

            font-size: 15px;

            transition: 0.3s;
        }

        .input-group input:focus {

            border-color: #667eea;

            box-shadow:
                0 0 0 3px rgba(102, 126, 234, 0.15);
        }

        .register-btn {

            width: 100%;

            padding: 14px;

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
        }

        .register-btn:hover {

            transform: translateY(-2px);

            box-shadow:
                0 8px 20px rgba(102, 126, 234, 0.35);
        }

        .login-text {

            text-align: center;

            margin-top: 22px;

            font-size: 14px;

            color: #666;
        }

        .login-text a {

            color: #667eea;

            text-decoration: none;

            font-weight: bold;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .message {

            padding: 12px;

            border-radius: 8px;

            margin-bottom: 20px;

            text-align: center;

            font-size: 14px;
        }

        .error {

            background: #ffe5e5;
            color: #d63031;
        }

        @media (max-width: 480px) {

            .register-card {
                padding: 30px 22px;
            }

        }

    </style>

</head>

<body>

<div class="register-container">

    <div class="register-card">

        <div class="logo">
            🛒
        </div>

        <h2>Create Account</h2>

        <p class="subtitle">
            Join us and start shopping today
        </p>

        <?php if ($message != "") { ?>

            <div class="message <?php echo $message_type; ?>">
                <?php echo $message; ?>
            </div>

        <?php } ?>

        <form method="post">

            <div class="input-group">

                <label>Full Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter your name"
                    required
                >

            </div>


            <div class="input-group">

                <label>Email Address</label>

                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="input-group">

                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Create a password"
                    required
                >

            </div>


            <button
                type="submit"
                name="register"
                class="register-btn"
            >
                Create Account
            </button>

        </form>


        <p class="login-text">

            Already have an account?

            <a href="user_login.php">
                Login
            </a>

        </p>

    </div>

</div>

</body>

</html>