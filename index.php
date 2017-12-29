<?php
include("config.php");
session_start();
if(isset($_SESSION['login_user'])){
    $myusername = $_SESSION['login_user'];
    if($myusername == 'admin'){
        header("Location: adminPanel.php");
    }
    else {
        header("Location: home.php");
    }
}

function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';

    return $ipaddress;
}

$clientIP = get_client_ip_env();
//$clientIP = '78.96.97.246';
echo get_client_ip_env();

$sql = "SELECT IP FROM vizitatori WHERE IP = '$clientIP' ";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

date_default_timezone_set("Europe/Bucharest");
$acum = date("Y.m.d h:i:sa");

if($count >= 1){
    $SQL = "UPDATE vizitatori SET DATE = '$acum' WHERE IP = '$clientIP'";

    if ($conn->query($SQL) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
else{
    $SQL = "INSERT INTO vizitatori (IP, Date)
            VALUES ('$clientIP', '$acum');";
    if ($conn->query($SQL) === TRUE) {
        echo "Record added successfully";
    } else {
        echo "Error adding record: " . $conn->error;
    }
}
//var_dump($_SESSION);
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,md5($_POST['password']));

    $sql = "SELECT uniqueEmail FROM candidat WHERE uniqueEmail = '$myusername' and password = '$mypassword'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if($count == 1) {
        $_SESSION['login_user'] = $myusername;
        if($myusername == 'admin'){
            header("location: adminPanel.php");
        }
        else{
            header("location: home.php");
        }

    }else {
        $error = "Your Login Name or Password is invalid";
        echo $error;
    }


}
?>
<html>

<head>
    <title>Login Page</title>

    <style type = "text/css">
        body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
        }

        label {
            font-weight:bold;
            width:100px;
            font-size:14px;
        }

        .box {
            border:#666666 solid 1px;
        }
    </style>

</head>

<body bgcolor = "#FFFFFF">

<div align = "center">
    <div style = "width:300px; border: solid 1px #333333; " align = "left">
        <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>

        <div style = "margin:30px">

            <form action = "" method = "post">
                <label>UserName  :</label><input type = "text" name = "username" class = "box"/><br /><br />
                <label>Password  :</label><input type = "password" name = "password" class = "box" /><br/><br />
                <input type = "submit" value = " Submit "/><br />
                <a href="newAccount.php"> Creaza cont nou</a>
            </form>

        </div>

        <div style = "margin:30px">
            <p>
                <a href = "ContactPage.php"> Contacteaza-ne! </a>
            </p>
        </div>

    </div>

</div>

</body>
</html>