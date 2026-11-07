
<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: product.php");
    exit();
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header("Location: product.php");
    exit();
}

$stmt = mysqli_prepare($conn, "DELETE FROM eproduct WHERE id = ?");

if (!$stmt) {
    die("Database error: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    header("Location: product.php?deleted=1");
    exit();
}

mysqli_stmt_close($stmt);
die("Product could not be deleted.");
?>
