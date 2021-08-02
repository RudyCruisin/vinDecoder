<?php

require 'database.php';

//VIN number that is stored in session is used for API data from NHTA.

$vinnumber = $_SESSION['vinnumber'];
$decoded = $_SESSION['vindata'];

//Prepared Statement with error handlers for adding variables into table.

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$sql = "SELECT vin FROM vinlist WHERE vin = ?";
$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("Location:index.php?error=sqlerror");
    exit();
} else {
    mysqli_stmt_bind_param($stmt, "s", $vinnumber);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $rowcount = mysqli_stmt_num_rows($stmt);

    if ($rowcount > 0) {
        header("Location:index.php?error=VIN Already in Database");
        exit();
    } else {
        $sql = "INSERT INTO vinlist (vin, make, model, modelYear, trim, bodyClass, cabType, driveType, transmissionStyle, frontAirbagLocation, sideAirbagLocation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location:index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, 'sssisssssss', $vinnumber, $decoded['Results'][6]['Value'], $decoded['Results'][8]['Value'], $decoded['Results'][9]['Value'], $decoded['Results'][12]['Value'], $decoded['Results'][21]['Value'], $decoded['Results'][35]['Value'], $decoded['Results'][49]['Value'], $decoded['Results'][47]['Value'], $decoded['Results'][93]['Value'], $decoded['Results'][95]['Value']);
            mysqli_stmt_execute($stmt);
            header("Location:index.php?success=vin added to database");
            exit();
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
};
