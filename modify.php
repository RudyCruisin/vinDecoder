<?php
require_once 'includes/header.php';
require 'includes/database.php';
?>

<?php

//Querying database to match selected vin from edit button.
//Variables associated with vin are displayed into a table with an input to modify them.

$sql = "SELECT * FROM vinlist WHERE vin = '{$_SESSION['editvin']}'";
$result = mysqli_query($conn, $sql) or die("Bad Query: $sql");
$row = mysqli_fetch_assoc($result);
$arraytable = ['vin', 'make', 'model', 'modelYear', 'trim', 'bodyClass', 'cabType', 'driveType', 'transmissionStyle', 'frontAirbagLocation', 'sideAirbagLocation'];

?>

<div>
        <h2>Values for VIN - <?php echo $row[$arraytable[0]]; ?></h2>
        <form class="updateform" method="POST">
            <table class="table table-sm">
                <thead class = "thead-dark"><tr><th scope="col">Category</th><th scope="col">Current Value</th><th scope="col">New Value</th></tr></thead>
                <tbody><tr><td class="align-middle">make</td><td class="align-middle"><?php echo $row[$arraytable[1]]; ?></td><td><input type="text" name="updatemake" placeholder="Enter New Value" value="<?php echo $row[$arraytable[1]];?>" /></td></tr>
                    <tr><td class="align-middle">model</td><td><?php echo $row[$arraytable[2]]; ?></td><td class="align-middle"><input type="text" name="updatemodel" placeholder="Enter New Value" value="<?php echo $row[$arraytable[2]];?>" /></td></tr>
                    <tr><td class="align-middle">modelYear</td><td><?php echo $row[$arraytable[3]]; ?></td class="align-middle"><td><input type="text" name="updatemodelYear" placeholder="Enter New Value" value="<?php echo $row[$arraytable[3]];?>" /></td></tr>
                    <tr><td class="align-middle">trim</td><td><?php echo $row[$arraytable[4]]; ?></td><td class="align-middle"><input type="text" name="updatetrim" placeholder="Enter New Value" value="<?php echo $row[$arraytable[4]];?>" /></td></tr>
                    <tr><td class="align-middle">bodyClass</td><td><?php echo $row[$arraytable[5]]; ?></td class="align-middle"><td><input type="text" name="updatebodyClass" placeholder="Enter New Value" value="<?php echo $row[$arraytable[5]];?>" /></td></tr>
                    <tr><td class="align-middle">cabType</td><td><?php echo $row[$arraytable[6]]; ?></td><td class="align-middle"><input type="text" name="updatecabType" placeholder="Enter New Value" value="<?php echo $row[$arraytable[6]];?>" /></td></tr>
                    <tr><td class="align-middle">driveType</td><td><?php echo $row[$arraytable[7]]; ?></td><td class="align-middle"><input type="text" name="updatedriveType" placeholder="Enter New Value" value="<?php echo $row[$arraytable[7]];?>" /></td></tr>
                    <tr><td class="align-middle">transmissionStyle</td><td><?php echo $row[$arraytable[8]]; ?></td><td class="align-middle"><input type="text" name="updatetransmissionStyle" placeholder="Enter New Value" value="<?php echo $row[$arraytable[8]];?>" /></td></tr>
                    <tr><td class="align-middle">frontAirbagLocation</td><td><?php echo $row[$arraytable[9]]; ?></td><td class="align-middle"><input type="text" name="updatefrontAirbagLocation" placeholder="Enter New Value" value="<?php echo $row[$arraytable[9]];?>" /></td></tr>
                    <tr><td class="align-middle">sideAirbagLocation</td><td><?php echo $row[$arraytable[10]]; ?></td><td class="align-middle"><input type="text" name="updatesideAirbagLocation" placeholder="Enter New Value" value="<?php echo $row[$arraytable[10]];?>" /></td></tr>
                </tbody>
            </table>
            <button class="submitButton" type="submit" name="updateData">Update Database</button>
        </form>
</div>

<div class="buttons">
    <form method="get">
        <button class="submitButton" type="submit" action="index.php" name="deleteData">Delete from Database</button>
    </form>
</div>

<?php
//Update button updates table with values in input fields.
if (isset($_POST['updateData'])) {
    $sql3 = "UPDATE vinlist SET make='$_POST[updatemake]',model='$_POST[updatemodel]',modelYear='$_POST[updatemodelYear]',trim='$_POST[updatetrim]',bodyClass='$_POST[updatebodyClass]',cabType='$_POST[updatecabType]',driveType='$_POST[updatedriveType]',transmissionStyle='$_POST[updatetransmissionStyle]',frontAirbagLocation='$_POST[updatefrontAirbagLocation]',sideAirbagLocation='$_POST[updatesideAirbagLocation]' WHERE vin = '{$_SESSION['editvin']}'";
    mysqli_query($conn, $sql3) or die("Bad Query: $sql3");
    mysqli_close($conn);
    header('Location:datadisplay.php');
}
?>


<?php
//Delete button creates a sequel query to remove data associated with VIN that user selects.
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