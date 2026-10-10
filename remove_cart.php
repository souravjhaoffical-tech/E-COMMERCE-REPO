
<?php
session_start();

$id = $_GET['id'] ?? '';

if (isset($_SESSION['cart']) && $id !== '') {
    $key = array_search($id, $_SESSION['cart']);

    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

header("Location: cart.php");
exit();
?>
