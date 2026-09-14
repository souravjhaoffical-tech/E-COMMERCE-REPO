<?php 
session_start();    // generate request  
include "db.php";    // database connection  import = include  
 
if(isset($_POST['login'])){     // isset function used to save summision  
 
$email = $_POST['email']; 
$password = $_POST['password']; 
 
$sql = "SELECT* FROM users WHERE email= '$email'AND password ='$password'" ; //query call  
 
$result = mysqli_query ($conn,$sql); // query pass  
 
if(mysqli_num_rows($result)>0){        // condition statment  
    $_SESSION['user'] = $email; 
    header("location: dashboard.php");    // to naviagate  
}else { 
    echo "wrong email password"; 
} 
}  
?>

<!DOCTYPE html>
<html>
<head>
    <title>ShopEase - Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #39cee4;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            width: 850px;
            min-height: 500px;
            background: white;
            display: flex;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
        }

        .left-section {
            width: 50%;
            background: linear-gradient(135deg, #111827, #374151);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 50px;
        }

        .logo {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .logo span {
            color: #f59e0b;
        }

        .left-section h1 {
            font-size: 38px;
            margin-bottom: 15px;
        }

        .left-section p {
            color: #2e82ff;
            line-height: 1.6;
            font-size: 15px;
        }

        .shop-text {
            margin-top: 35px;
            font-size: 15px;
            color: #f59e0b;
            font-weight: bold;
        }

        .right-section {
            width: 50%;
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section h2 {
            font-size: 30px;
            color: #111827;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #374151;
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #010306;
            border-radius: 8px;
            outline: none;
            margin-bottom: 20px;
            font-size: 14px;
        }

        input:focus {
            border-color: #f59e0b;
        }

        button {
            width: 100%;
            padding: 14px;
            background: #f59e0b;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #d97706;
            transform: translateY(-2px);
        }

        .bottom-text {
            text-align: center;
            margin-top: 22px;
            color: #6b7280;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            .login-container {
                width: 92%;
                flex-direction: column;
            }

            .left-section,
            .right-section {
                width: 100%;
            }

            .left-section {
                padding: 35px;
            }

            .left-section h1 {
                font-size: 28px;
            }

            .right-section {
                padding: 40px 30px;
            }
        }
    </style>
</head>

<body>

<div class="login-container">

    <div class="left-section">
        <div class="logo">Shop<span>Ease</span></div>

        <h1>Welcome Back!</h1>

        <p>
            Login to your account and continue shopping
            your favourite products at the best prices.
        </p>

        <div class="shop-text">
            🛍️ Shop Smart. Shop Easy.
        </div>
    </div>


    <div class="right-section">

        <h2>Admin Login</h2>

        <p class="subtitle">
            Sign in to manage your e-commerce store
        </p>

        <form method="post">

            <label>Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <button name="login">Login</button>

        </form>

        <div class="bottom-text">
            Secure access to your ShopEase dashboard
        </div>

    </div>

</div>

</body>
</html>