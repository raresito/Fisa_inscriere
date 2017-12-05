<?php

session_start();
include 'config.php' ;

if($_SESSION['login_user'] == 'admin') {
    echo "<html>
            <head>
                <header>
                    Admin FMI
                </header>
            </head>
        
            <body>
                Welcome Admin!
            <h2><a href='exportAdmin.php' >Export</a></h2>
            <h2><a href = \"logout.php\">Sign Out</a></h2>
            </body>
          </html>";

}
else
    echo "Page avalabile only to admin";

?>


