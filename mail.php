<?php
require "vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

//smtp setup
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;

//own gmail id 
$mail->username = "souravjha700377@gmail.com";
//own gmail app password
$mail->password = "ljrerwgfbvamftps";

//SMTP SECURITY
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->port = 587;

//sender
$mail->setForm (
  $mail->username,
  "ardent e-learning"
);
?>





?>