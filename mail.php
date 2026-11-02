<?php
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

//smtp setup
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;

//own gmail id 
$mail->Username = "souravjha700377@gmail.com";
//own gmail app password
$mail->Password= "ljrerwgfbvamftps";

//SMTP SECURITY
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

//sender
$mail->setFrom (
  $mail->Username,
  "ardent e-learning"
);
?>





?>