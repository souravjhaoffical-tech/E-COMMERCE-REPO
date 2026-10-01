<?php
<<<<<<< HEAD

session_start();
$id = $_GET['id'];
$key = array_search($id,$_SESSION['CART']);

if($key !== false){
    unset($_SESSION['cart']['key']);
}
header("Location:cart.php");

?>
=======
session_start();
$id = $_GET['id'];
>>>>>>> 38005d9796521024370e2370deb8c0570a68be8a
