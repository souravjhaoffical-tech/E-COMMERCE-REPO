<?php
session_start();
include "db.php";

if(!insert($SESSION['user'])){
    header("location: login.php";)
}