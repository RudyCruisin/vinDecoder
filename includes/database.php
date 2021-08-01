<?php

//Parameters for connecting to Database

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "vindecoder";

//Connecting to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

if (!$conn) {
    die("The connection to the database as failed!");
}

?>