
<?php
session_start();
require_once "db.php";

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    header("Location: index.php");
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT id FROM eproduct WHERE id = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_fetch_assoc($result)) {
    $_SESSION['cart'] ??= [];
    $_SESSION['cart'][] = $id;
}

mysqli_stmt_close($stmt);

header("Location: cart.php");
exit();
?>
