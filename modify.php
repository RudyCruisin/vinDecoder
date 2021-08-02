<?php
require_once 'includes/header.php';
require 'includes/database.php';
?>

<?php

// echo $_SESSION['editvin'];

$sql = "SELECT * FROM vinlist WHERE vin = '{$_SESSION['editvin']}'";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
$row = mysqli_fetch_assoc($result);
$arraytable = ['vin', 'make', 'model', 'modelYear', 'trim', 'bodyClass', 'cabType', 'driveType', 'transmissionStyle', 'frontAirbagLocation', 'sideAirbagLocation'];

echo "<table>";
echo "<tr><td>Label</td><td>Current Value</td><td>Desired Value</td>";
for ($i = 0; $i < count($arraytable); $i++) {
    echo "<tr><td>$arraytable[$i]</td><td>{$row[$arraytable[$i]]}</td><td><form method=post><input class=editvalues type=text name=update" . $arraytable[$i] . " placeholder=Enter Value></input></form></td></tr>\n";
}

echo "</table>";

?>

<div class="buttons">
    <form method="post">
        <button class="submitButton" type="submit" name="updateData">Update Database</button>
    </form>
    <form method="get">
        <button class="submitButton" type="submit" action="index.php" name="deleteData">Delete from Database</button>
    </form>
</div>

<?php
//Pressing delete button removes VIN and associated values from the table.
if (isset($_GET['deleteData'])) {
    $sql2 = "DELETE FROM vinlist WHERE vin = '{$_SESSION['editvin']}'";
    mysqli_query($conn, $sql2) or die("Bad Query: $sql2");
    mysqli_close($conn);
    header('Location:datadisplay.php');
}
?>

<?php
require_once 'includes/footer.php';
?>