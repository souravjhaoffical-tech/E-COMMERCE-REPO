<?php

require "vendor/autolaod.php";
$key = getnv ("RAZORPAY_KEY_ID");
$secret = getenv("RAZORPAY_KEY_ID");

$api = new razorpay\Api\Api($key,$secret);


?>