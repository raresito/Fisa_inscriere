<?php
session_start();
?>

<html>
<head>
    <title>
        Admitere 2017 - Trimis Comentariu
    </title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Welcome <?php if(isset($_SESSION['login_user'])){echo $_SESSION['login_user'];}  ?></a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="logout.php">Sign Out</a></li>
            <li><a href = "ContactPage.php"> Contacteaza-ne! </a></li>
        </ul>
    </div>
</nav>
</body>
</html>

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
    echo "Mesaj transmis cu succes!";
}