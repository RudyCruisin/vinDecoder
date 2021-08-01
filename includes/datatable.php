<?php
require 'database.php';

//Grabbing data from mysql and generating them in a table element.

$sql = "SELECT * FROM vinlist";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");


echo"<table>";
echo"<tr><td>VIN</td><td>Make</td><td>Model</td><td>Year</td><td>Trim</td><td>Body Class</td><td>Cab Type</td><td>Drive Type</td><td>Transmission Style</td><td>Front Airbag Location</td><td>Side Airbag Location</td></tr>\n";
while($row = mysqli_fetch_assoc($result)) {
    echo"<tr><td>{$row['vin']}</td><td>{$row['make']}</td><td>{$row['model']}</td><td>{$row['modelYear']}</td><td>{$row['trim']}</td><td>{$row['bodyClass']}</td><td>{$row['cabType']}</td><td>{$row['driveType']}</td><td>{$row['transmissionStyle']}</td><td>{$row['frontAirbagLocation']}</td><td>{$row['sideAirbagLocation']}</td></tr>\n";
}
echo"</table>";

?>