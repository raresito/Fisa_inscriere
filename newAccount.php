<?php
include ("config.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT uniqueEmail from candidat where uniqueEmail = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if($count == 1 && $_POST["password"] === $_POST["confirm_password"]){
        echo "This username is already taken";
    }
    else{
        $_SESSION['login_user'] = $email;
        $SQL = "INSERT INTO candidat 
                (uniqueEmail,
                CNP, 
                name, 
                surname, 
                dateOfBirth, 
                nameFather, 
                nameMother, 
                IDtype, 
                serialID, 
                numberID, 
                eliberatedBy, 
                dateEliberated, 
                valabilityDate, 
                country, city, 
                county, 
                citizenship, 
                ethnicity, 
                maritalStatus)
        VALUES ('$email',null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null)";
        if( $conn->query($SQL) == TRUE) {
            header("location: home.php");
        }
        else
            echo "Error: " . $SQL . "<br>" . $conn->error;
    }
}
?>

<html>

    <head>

    </head>

    <body>

    <div align = "center">
        <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
            <div style = "margin:30px">
                <form name="newAccountForm" action = "" method = "post" id="newAccountform" >
                    <label>Email: </label><input type = "text" name = "username" class = "box"/><br /><br />
                    <label>Parola: </label><input type = "password" name = "password" class = "box" required/><br/><br />
                    <label>Parola: </label><input type = "password" name = "confirm_password" class = "box" required /><br/><br />
                    <input type = "submit" value = " Submit "/><br />
                </form>
            </div>
        </div>
    </div>

    </body>
</html>
