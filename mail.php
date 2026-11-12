<?php
require_once __DIR__ . "/vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

//smtp setup
$mail->isSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth = true;

//own gmail id 
$mail->Username = "souravjhaoffical@gmail.com";
//own gmail app password
$mail->Password= "kxiasscyhzgqjwhg";
$mail->SMTPDebug = 2;
//SMTP SECURITY
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Timeout = 15;
$mail->SMTPOptions = ['ssl' => ['verify_peer'=>false,'verify_peer_name'=>false,'allow_self_signed'=>true]];

//sender
$mail->setFrom (
  $mail->Username,
  "ardent e-learning"
);
?>




