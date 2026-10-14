<?php

session_start();

include "db.php";
include "config.php";


$total = 0;
$courses = [];

foreach(($_SESSION['cart'] ?? []) as $id){

    $id = (int)$id;

    $result = mysqli_query($conn,
        "SELECT * FROM eproduct WHERE id=$id"
    );

    $row = mysqli_fetch_assoc($result);

    if(!$row || $row['p_price'] <= 0){
        die("Invalid product");
    }

    $total += $row['p_price'];
    $courses[] = $row;
}

$amount = (int)round($total * 100);

try {

    $order = $api->order->create([
        "amount" => $amount,
        "currency" => "INR"
    ]);

} catch(\Throwable $e){
    die("Payment setup failed");
}

$_SESSION['rzp_order'] = $order['id'];
$_SESSION['rzp_amount'] = $amount;
$_SESSION['rzp_product'] = $courses;

?>

<h2>Online Payment</h2>

<h3>Total: ₹<?php echo $total; ?></h3>

<button id="pay">Pay Now</button>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

var options = {

    key: <?php echo json_encode($key); ?>,

    amount: <?php echo $amount; ?>,

    currency: "INR",

    name: "Ardent E-Product",

    order_id: <?php echo json_encode($order['id']); ?>,

    handler: function(res){

        document.getElementById("pid").value =
            res.razorpay_payment_id;

        document.getElementById("sig").value =
            res.razorpay_signature;

        document.getElementById("paymentForm").submit();
    }
};

var rzp = new Razorpay(options);

document.getElementById("pay").onclick = function(){
    rzp.open();
};

</script>

<form id="paymentForm" action="verify.php" method="post">

<input type="hidden" name="payment_id" id="pid">

<input type="hidden" name="signature" id="sig">

</form>