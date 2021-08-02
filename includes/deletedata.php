<?php
    require 'database.php';
?>

<div>
<form method="get">
        <button class="submitButton" type="submit" name="updateData">Update Database</button>
        <button class="submitButton" type="submit" name="deleteData">Delete from Database</button>
    </form>
</div>

<?php

    // $sql2 = "DELETE FROM vinlist WHERE vin = '{$_SESSION['editvin']}'";
    // mysqli_query($conn, $sql2) or die("Bad Query: $sql2");
    // mysqli_close($conn);

?>