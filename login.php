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
    header("location : dashboard.php");    // to naviagate 
}else {
    echo "wrong email password";
}
} 
?>
<h2> admin login </h2>
<form method= "post">

Email : <input type = "email" name="email" required> 
<br>
password: <input type = "password" name = "password" required>
<br>
<button name="login">Login</button>
</form>