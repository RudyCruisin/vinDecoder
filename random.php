<?php

$sql = "SELECT * FROM vinlist";
$result = mysqli_query($conn, $sql);
$rowCount = mysqli_num_rows($result);
$colCount = mysqli_num_fields($result);

if ($rowCount > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['vin'] . " - " . $row['modelYear'] . " - " . $row['make'] . " - " . $row['model'] . "<br>";
    }
} else {
    echo "No results found.";
}


?>