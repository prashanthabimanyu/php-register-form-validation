<?php
$hostName = "localhost";
$dbUser ="root";
$dbPassword="";
$dbname="dbregistervalidation";

$conn = mysqli_connect($hostName,$dbUser,$dbPassword,$dbname);
if(!$conn){
    die("somethink went wrong");
}

?>