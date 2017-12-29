<?php
include ("config.php");
session_start();
$utilizator = $_SESSION['login_user'];

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $codValidare = mysqli_real_escape_string($conn, $_POST['codValidare']);

    if ($codValidare == md5($_SESSION['secret'])) {
        $SQL = "UPDATE candidat SET mailValid = 1 WHERE uniqueEmail = '$utilizator'";
        if($conn -> query($SQL) == TRUE){
            header("location: home.php");
        } else {
            echo "Error: " . $SQL . "<br>" . $conn -> error;
        }
        echo "Validat cu succes";

    } else
        echo "Invalid";
}
?>

<html>
    <head>
        <title>
            Contact Admin
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

        <div class="container">
            <h2>Multumim, <?php echo $_SESSION['login_user'] ?> pentru inregistrare! <br> Te rugam sa iti verifici mailul pentru a confirma inregistrarea!</h2>
            <h3>Inscrie codul aici:</h3>
            <form action = "" method="post">
                <input type="text" name="codValidare"><br>
                <input type = "submit" value = " Submit "/>
            </form>
        </div>
    </body>
</html>

<?php

/**
 * This example shows settings to use when sending via Google's Gmail servers.
 * This uses traditional id & password authentication - look at the gmail_xoauth.phps
 * example to see how to use XOAUTH2.
 */
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor\autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "raresphpcristea@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "googlephp";
//Set who the message is to be sent from
$mail->setFrom('raresphpcristea@gmail.com', 'Admitere FMI - 2018');
//Set an alternative reply-to address
$mail->addReplyTo('raresphpcristea@gmail.com', 'Admitere FMI - 2018');
//Set who the message is to be sent to
$mail->addAddress($_SESSION['login_user'], 'John Doe');
//Set the subject line
$mail->Subject = 'Inregistrare cont Admitere FMI - 2018';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML('Salut! Acesta este codul tau de validare:' . md5($_SESSION['secret']), __DIR__);
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';

$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
?>