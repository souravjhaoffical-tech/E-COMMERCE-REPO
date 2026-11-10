<?php
session_start();

if (empty($_SESSION['otp']) || empty($_SESSION['pending_id'])) {
    header("Location: glogin.php");
    exit();
}

$error = "";

function clear_pending() {
    unset($_SESSION['otp'], $_SESSION['otp_time'], $_SESSION['attempts'],
          $_SESSION['pending_id'], $_SESSION['pending_name']);
}

if (isset($_POST['verify'])) {

    $entered = trim($_POST['otp'] ?? '');

    if (time() - ($_SESSION['otp_time'] ?? 0) > 300 || ($_SESSION['attempts'] ?? 0) >= 5) {
        clear_pending();
        header("Location: glogin.php");
        exit();
    }

    if (password_verify($entered, $_SESSION['otp'])) {

        include "db.php";
        $id   = (int)$_SESSION['pending_id'];
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $user = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

        clear_pending();
        session_regenerate_id(true);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name']    = $user['name'];
        $_SESSION['email']   = $user['email'];
        $_SESSION['role']    = $user['role'] ?? 'user';

        if ($_SESSION['role'] === 'admin') {
            header("Location: dashboard.php");
        } elseif (($_SESSION['redirect_after_login'] ?? '') === 'checkout.php') {
            unset($_SESSION['redirect_after_login']);
            header("Location: checkout.php");
        } else {
            header("Location: users_home.php");
        }
        exit();

    } else {
        $_SESSION['attempts'] = ($_SESSION['attempts'] ?? 0) + 1;
        $error = "Wrong OTP. Attempts left: " . (5 - $_SESSION['attempts']);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopVibe - Verify OTP</title>
<style>
*{box-sizing:border-box;margin:0;padding:0;font-family:Arial,sans-serif}
body{min-height:100vh;display:flex;align-items:center;justify-content:center;background:#0b1020;color:#e8eaf6}
.card{width:100%;max-width:400px;background:#1a1f38;border-radius:20px;padding:36px}
h2{font-size:26px;margin-bottom:6px}
p{color:#9aa3c7;font-size:14px;margin-bottom:22px}
.err{background:#3a1f2b;color:#ff7b8e;padding:12px;border-radius:10px;margin-bottom:16px;font-size:14px}
input{width:100%;padding:14px;border-radius:12px;border:1px solid #2d3458;background:#232948;color:#fff;font-size:22px;letter-spacing:8px;text-align:center;margin-bottom:18px}
button{width:100%;padding:14px;border:0;border-radius:12px;font-size:16px;font-weight:700;color:#fff;cursor:pointer;background:linear-gradient(135deg,#667eea,#764ba2)}
a{display:block;text-align:center;margin-top:16px;color:#b4a7ff;font-size:14px;text-decoration:none}
</style>
</head>
<body>
<form class="card" method="post">
    <h2>Verify OTP</h2>
    <p>Enter the 6-digit code sent to your email. It expires in 5 minutes.</p>
    <?php if ($error): ?><div class="err"><?= htmlspecialchars($error) ?></div><?php endif; ?>
    <input type="text" name="otp" maxlength="6" inputmode="numeric" placeholder="••••••" required autofocus>
    <button name="verify">Verify &amp; Login</button>
    <a href="glogin.php">← Back to login</a>
</form>
</body>
</html>
