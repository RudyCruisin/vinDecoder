<?php
require 'database.php';

//Grabbing data from mysql and generating them in a table element.

$sql = "SELECT * FROM vinlist";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
?>

<div>
    <h2>TABLE OF SAVED VINs</h2>
    <table class="table table-sm">
        <thead class="thead-dark">
            <tr>
                <th scope="col"></th>
                <th scope="col">VIN</th>
                <th scope="col">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Year</th>
                <th scope="col">Trim</th>
                <th scope="col">Body Class</th>
                <th scope="col">Cab Type</th>
                <th scope="col">Drive Type</th>
                <th scope="col">Transmission Style</th>
                <th scope="col">Front Airbag Location</th>
                <th scope="col">Side Airbag Location</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td><form method=post><button class=editdata type=submit name=editData value={$row['vin']}>Edit</button></form></td><td>{$row['vin']}</td><td>{$row['make']}</td><td>{$row['model']}</td><td>{$row['modelYear']}</td><td>{$row['trim']}</td><td>{$row['bodyClass']}</td><td>{$row['cabType']}</td><td>{$row['driveType']}</td><td>{$row['transmissionStyle']}</td><td>{$row['frontAirbagLocation']}</td><td>{$row['sideAirbagLocation']}</td></tr>\n";
            }
            ?></tbody>
    </table>
</div>

<?php
if (isset($_POST['editData'])) {
    $_SESSION['editvin'] = $_POST['editData'];
    header('Location:modify.php');
}
?>