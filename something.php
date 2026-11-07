<?php

session_start();

include "db.php";



if (!isset($_SESSION['user_id']) || ($_SESSION['role'] ?? '') != 'user') {

    header("Location:login.php");

    exit;

}



$sql = "SELECT * FROM eproduct";

$result = mysqli_query($conn, $sql);



$userName = htmlspecialchars(

    $_SESSION['user_name'] ?? $_SESSION['name'] ?? 'User',

    ENT_QUOTES,

    'UTF-8'

);

?>



<!DOCTYPE html>

<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shop Vibe | Durga Puja Sale</title>



<style>



/* ========================================

   SHOP VIBE — BLUE & WHITE THEME

   Primary: #667eea

\======================================== */



:root {

    --primary: #667eea;

    --primary-hover: #5a6fd6;

    --primary-dark: #4658c8;

    --text: #1f2937;

    --muted: #6b7280;

    --white: #ffffff;

    --page-bg: #f5f7ff;

    --light-blue: #eef1ff;

    --border: #dbe2ff;

    --shadow: 0 5px 20px rgba(31, 41, 55, 0.08);

}



* {

    margin: 0;
