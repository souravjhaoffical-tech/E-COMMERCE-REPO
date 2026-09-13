<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "ecommerce_db"
);
if(!$conn) {
    echo ("not connected");
}
?>