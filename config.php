<?php

require "vendor/autolaod.php";
$key = getenv("RAZORPAY_KEY_ID");
$secret = getenv("RAZORPAY_KEY_SECRET");

$api = new Razorpay\Api\Api($key, $secret);

?>