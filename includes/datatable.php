<?php
require 'database.php';

// session_destroy();

//Grabbing data from mysql and generating them in a table element.

$sql = "SELECT * FROM vinlist";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");

?>

<div>

    <h2>TABLE OF STORED VINs</h2>

    <form class="updateform" method="POST">
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
                <?php while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td><form method=post><button class=editdata type=submit name=editData value={$row['vin']}>Edit</button></form></td><td class=align-middle>{$row['vin']}</td><td class=align-middle>{$row['make']}</td><td class=align-middle>{$row['model']}</td><td class=align-middle>{$row['modelYear']}</td><td class=align-middle>{$row['trim']}</td><td class=align-middle>{$row['bodyClass']}</td><td class=align-middle>{$row['cabType']}</td><td class=align-middle>{$row['driveType']}</td><td class=align-middle>{$row['transmissionStyle']}</td><td class=align-middle>{$row['frontAirbagLocation']}</td><td class=align-middle>{$row['sideAirbagLocation']}</td></tr>\n";
                } ?>
            </tbody>
        </table>
</div>

<?php
if (isset($_POST['editData'])) {
    $_SESSION['editvin'] = $_POST['editData'];
    header('Location:modify.php');
}
?>