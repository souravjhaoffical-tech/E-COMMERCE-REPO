<?php
include "db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

   $stmt = mysqli_prepare($conn,
   "INSERT INTO users (name,email,password) values(?,?,?)"
   );
   mysqli_stmt_bind_param(
    $stmt, "sss",
    $name,$email,$password

   );

   if(mysqli_stmt_execute($stmt)){
    header("location: glogin.php");
    exit();
   }
   echo "registration failed";
}
?> 
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* {
    box-sizing: border-box;
    font-family: 'Inter', 'Segoe UI', Roboto, Arial, sans-serif;
}

body {
    min-height: 100vh;
    margin: 0;
    padding: 25px 15px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
}

form {
    width: 420px;
    max-width: 100%;
    padding: 40px;
    background: #ffffff;
    border: none;
    border-radius: 20px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.25);
}

br {
    display: none;
}

input {
    width: 100%;
    height: 48px;
    padding: 0 15px;
    margin-bottom: 18px;
    border: 2px solid #667eea;
    border-radius: 10px;
    outline: none;
    font-size: 15px;
    color: #111111;
    background: #f0f2ff;
    box-shadow: 0 3px 8px rgba(102, 126, 234, 0.25);
    transition: 0.3s;
}

input::placeholder {
    color: #555a73;
}

input:focus {
    border-color: #764ba2;
    background: #ffffff;
    box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.25);
}

button {
    width: 100%;
    height: 47px;
    border: none;
    border-radius: 10px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: #ffffff;
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

a {
    margin-top: 20px;
    color: #ffffff;
    font-size: 14px;
    font-weight: bold;
    text-decoration: none;
    transition: 0.3s;
}

a:hover {
    color: #e0e7ff;
    text-decoration: underline;
}
</style>
<form method="post">
    <input
    type="text"
    name="name"
    placeholder="enter name"
    required
    >
    <br><br>
    <input
    type="email"
    name="email"
    placeholder="enter email"
    required
    >
    <br><br>
    <input
    type="password"
    name="password"
    placeholder="enter password"
    required
    >
    <br><br>
    <button name="register">Register</button>
</form>
<br>
<a href="glogin.php">Already register? Login</a>



