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

$sql = "SELECT * FROM `vizitatori`
ORDER BY Date DESC
LIMIT 1";
$result = mysqli_query($conn,$sql);
$bow = mysqli_fetch_array($result,MYSQLI_ASSOC);
$stat = "IP-ul ultimului vizitator: " . $bow['IP'] . " la data " . $bow['Date'];

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

        <script type="text/javascript" src="js/jquery-latest.js"></script>
        <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
        <script type="text/javascript" src="js/admin.js"></script>
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
                    <li><a href='exportAdmin.php' >Export</a></li>
                </ul>
            </div>
        </nav>
        <?php echo "Numar de vizitatori unici:" . $count . "<br>" . $stat; ?>
        <div class="container table-responsive">
            <table id="myTable" class="table tablesorter">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Nume</th>
                    <th>Prenume</th>
                    <th>Medie Bac</th>
                    <th>Liceu</th>
                    <th>Scutire Plata</th>
                    <th>Scutire Examen</th>
                    <!--<th>Ștergere</th>-->
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
                        <td><?php echo $row['medieBac']; ?></td>
                        <td><?php echo $row['denumireLiceu']; ?></td>
                        <td><?php
                            if($row['rromi'] == 'on' || $row['pretutindeni'] == 'on' || $row['olimpicAdmitere'] == 'on')
                            {
                                echo'Scutit';
                            }?></td>
                        <td><?php
                            if($row['orfan'] == 'on' || $row['parinteProfesor'] == 'on' || $row['olimpicExamen'] == 'on')
                            {
                                echo'Scutit';
                            }?></td>
                        <!--<td>
                            <form name = "2Form" action = "sters.php" method = "post">
                                <input style = "display: none;" type = "text" name = "pangarit" value=" <?php echo $row['uniqueEmail']; ?>" >
                                <button type = "submit" form = "2Form" > Sterge </button>
                            </form>

                        </td>-->

                    </tr>
                <?php endwhile ?>
                </tbody>
            </table>
        </div>
        <!--
        <form name = "2Form" action = "sters.php" method = "post">
            <input style = "display: none;" type = "text" name = "pangarit" value=" <?php echo $row['uniqueEmail']; ?>" >
            <input type="submit" name="submit" id="submit" class="button" form="2Form" value="Sterge"/>
        </form>
        -->
    </body>
</html>


