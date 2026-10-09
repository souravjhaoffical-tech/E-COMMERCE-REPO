
<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "k"
);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>