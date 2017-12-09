<?php

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor\autoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'raresphpcristea@gmail.com';
$mail->Password = 'googlephp';
$mail->setFrom('raresphpcristea@gmail.com', 'Admitere 2018');
$mail->addReplyTo($_POST['email'],'Concurent');
$mail->addAddress('raresphpcristea@gmail.com', 'Admin');
$mail->Subject = 'Contact nr. ';
$mail->msgHTML($_POST['numeContact']."<br>".$_POST['commentContact'],__DIR__);

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}