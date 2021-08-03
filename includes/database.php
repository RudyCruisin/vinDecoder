<?php
//Localhost Parameters for connecting to Database
// $dbHost = "localhost";
// $dbUser = "root";
// $dbPass = "";
// $dbName = "vindecoder";

//Connecting to database
// $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

//Heroku ClearDB Parameters for connecting to Database

$cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
$cleardb_server = $cleardb_url["host"];
$cleardb_username = $cleardb_url["user"];
$cleardb_password = $cleardb_url["pass"];
$cleardb_db = substr($cleardb_url["path"],1);
$active_group = 'default';
$query_builder = TRUE;

// Connect to DB
$conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);

if (!$conn) {
    die("The connection to the database as failed!");
}
?>