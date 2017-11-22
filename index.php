<?php
include("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form

    $myusername = mysqli_real_escape_string($conn,$_POST['username']);
    $mypassword = mysqli_real_escape_string($conn,$_POST['password']);

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

    </div>

</div>

</body>
</html>