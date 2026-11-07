<?php
include "db.php";

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash(
        $_post['password'],
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



