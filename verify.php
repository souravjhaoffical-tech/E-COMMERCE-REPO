<?php

session_start();

include "db.php";
include "config.php";

if(!isset($_SESSION['user']) ||
   !isset($_SESSION['rzp_order'])){
    die("Invalid session");
}

$orderId = $_SESSION['rzp_order'];
$amount = $_SESSION['rzp_amount'];
$courses = $_SESSION['rzp_courses'];

$paymentId = $_POST['payment_id'] ?? "";
$signature = $_POST['signature'] ?? "";

try {

    $api->utility->verifyPaymentSignature([
        "razorpay_order_id" => $orderId,
        "razorpay_payment_id" => $paymentId,
        "razorpay_signature" => $signature
    ]);

    $payment = $api->payment->fetch($paymentId);

    if(
        $payment['status'] != "captured" ||
        $payment['order_id'] != $orderId ||
        $payment['amount'] != $amount ||
        $payment['currency'] != "INR"
    ){
        die("Payment not completed");
    }

    $user = $_SESSION['user'];

    // Avoid saving the same order again
    $stmt = mysqli_prepare($conn,
        "SELECT id FROM orders WHERE razorpay_order_id=? LIMIT 1"
    );

    mysqli_stmt_bind_param($stmt,"s",$orderId);
    mysqli_stmt_execute($stmt);

    $existing = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($existing) == 0){

        mysqli_begin_transaction($conn);

        try {

            foreach($eproduct as $eproduct){

                $name = $course['course_name'];
                $price = $course['price'];

                $stmt = mysqli_prepare($conn,
                    "INSERT INTO orders
                    (user_name,course_name,price,
                     payment_method,status,
                     razorpay_order_id,razorpay_payment_id)
                    VALUES (?, ?, ?, 'Razorpay', 'Paid', ?, ?)"
                );

                mysqli_stmt_bind_param(
                    $stmt,"ssiss",
                    $user,$name,$price,$orderId,$paymentId
                );

                if(!mysqli_stmt_execute($stmt)){
                    throw new Exception("Order save failed");
                }
            }

            mysqli_commit($conn);

        } catch(Exception $e){

            mysqli_rollback($conn);
            throw $e;
        }
    }

    unset($_SESSION['cart']);
    unset($_SESSION['rzp_order']);
    unset($_SESSION['rzp_amount']);
    unset($_SESSION['rzp_courses']);

    header("Location: success.php");
    exit();

} catch(Exception $e){

    echo "Payment verification failed. Check order status before retrying.";

}

?>