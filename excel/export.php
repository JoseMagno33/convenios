<?php

//poner nombre de hosting o ip
//$this->enlace = mysqli_connect("localhost","root","","dbproyectosql");


$servername="localhost";
$username="root";
$password="";
$database="dbproyectosql";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
//mysqli_close($conn);
?>
 
