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

            echo "OTP Sending Failed";
        }

    }else{
        echo "Wrong Email or Password";
    }
}

?>

<h2>Login</h2>

<form method="post">

<input type="email" name="email" placeholder="Email" required>
<br><br>

<input type="password" name="password" placeholder="Password" required>
<br><br>

<button name="login">Login</button>

</form>

<a href="gregister.php">Register</a>