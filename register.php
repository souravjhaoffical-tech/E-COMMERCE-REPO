<?php
include "db.php";

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $sql = "INSERT INTO users  ( name,email,password) VALUES ('$name','$email','$password')";
    mysqli_query($conn,$sql);
    echo  "register sucessfully";
    header("location:login.php");

}
?>
<form method ="post">
    name :
    <input type = "text" name = "name" required>
    <br><br>
    email  :
    <input type = "text" name = "email" required>
    <br><br>
    password :
    <input type = "text" name = "password" required>
    <br><br>

    <button name = "login">
        "login"
    </button>


</form>
