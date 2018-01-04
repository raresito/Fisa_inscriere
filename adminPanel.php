<?php

session_start();
include 'config.php' ;

if($_SESSION['login_user'] != 'admin')
    die("Page avalabile only to admin");

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
//echo get_client_ip_env();

$sql = "SELECT * FROM vizitatori";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

date_default_timezone_set("Europe/Bucharest");
$acum = date("Y.m.d h:i:sa");

class getData{

    private $result = false;
    private $row = null;

    function __construct()
    {

        //Connect to DB

        $servername = "localhost";
        $username = "root";
        $password = "lab223";
        $dbname = "Admitere 2017";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $user =  $_SESSION['login_user'];
        $sqlData = "SELECT * FROM candidat";
        $this->result = mysqli_query($conn, $sqlData);
    }

    function getRow(){
        return $this->row = mysqli_fetch_array($this->result, 1);
    }
}

$personData = new getData();
$data = $personData->getRow();

?>

<html>
    <head>
        <title>
            Admitere 2018 - Facultatea de Matematica si Informatica
        </title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/custom.js"></script>
    </head>

    <body>
        Welcome Admin!
        <h2><a href='exportAdmin.php' >Export</a></h2>
        <?php echo "Numar de vizitatori unici:" . $count; ?>
        <div class="container table-responsive">
            <table class = "table">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                </tr>
                </thead>
                <tbody>
                <!--Use a while loop to make a table row for every DB row-->
                <?php while( $row = $personData->getRow()) : ?>
                    <tr>
                        <!--Each table column is echoed in to a td cell-->
                        <td><?php echo $row['uniqueEmail']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['surname']; ?></td>
                    </tr>
                <?php endwhile ?>
                </tbody>
            </table>
        </div>
        <h2><a href = 'logout.php'>Log Out</a></h2>
    </body>
</html>


