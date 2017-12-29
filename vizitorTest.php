<?php

session_start();
include 'config.php';

if($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected succesfully";

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


?>