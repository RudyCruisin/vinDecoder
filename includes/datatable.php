<?php
require 'database.php';

// session_destroy();

//Grabbing data from mysql and generating them in a table element.

$sql = "SELECT * FROM vinlist";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");


echo"<table>";
echo"<tr><td></td><td>VIN</td><td>Make</td><td>Model</td><td>Year</td><td>Trim</td><td>Body Class</td><td>Cab Type</td><td>Drive Type</td><td>Transmission Style</td><td>Front Airbag Location</td><td>Side Airbag Location</td></tr>\n";
while($row = mysqli_fetch_assoc($result)) {
    echo"<tr><td><form method=post><button class=editdata type=submit name=editData value={$row['vin']}>Edit</button></form></td><td>{$row['vin']}</td><td>{$row['make']}</td><td>{$row['model']}</td><td>{$row['modelYear']}</td><td>{$row['trim']}</td><td>{$row['bodyClass']}</td><td>{$row['cabType']}</td><td>{$row['driveType']}</td><td>{$row['transmissionStyle']}</td><td>{$row['frontAirbagLocation']}</td><td>{$row['sideAirbagLocation']}</td></tr>\n";
}
echo"</table>";

if (isset($_POST['editData'])) {
    $_SESSION['editvin'] = $_POST['editData'];
    header('Location:modify.php');
}

?>

