<?php
include "db.php";

if (isset($_POST['add'])) {
    $brand = $_POST['brand'];
    $name = $_POST['name'];
    $price = $_POST['price'];


    $sql = "INSERT INTO eproduct  ( p_brand ,p_name,p_price) VALUES ('$brand','$name','$price')";
    mysqli_query($conn,$sql);
    header("location: product.php");

}
?>
<h1> add product </h1>
<form method ="post">
    product brand  :
    <input type = "text" name = "brand" required>
    <br><br>
    product name :
    <input type = "text" name = "name" required>
    <br><br>
    product price :
    <input type = "number" name = "price" required>
    <br><br>

    <button name = "add">
        add product
    </button>


</form>


