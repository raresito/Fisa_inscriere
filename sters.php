<?php
include ("config.php");
session_start();
$utilizator = $_SESSION['login_user'];

?>

<html>
    <head>
        <title>
            Sters!
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


        <?php
            echo $_POST['pangarit'];
        ?>
    </body>
</html>

