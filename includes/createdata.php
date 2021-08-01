<?php

require 'database.php';

//Use input VIN to submit request to NHSTA API

$vinnumber = $_SESSION['vinnumber'];

$ch = curl_init();

$url = "https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVin/" . $vinnumber . "?format=json";

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$resp = curl_exec($ch);

if ($e = curl_error($ch)) {
    echo $e;
} else {
    $decoded = json_decode($resp, true);
}

curl_close($ch);

//Prepared Statement for adding variables into table.

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
            mysqli_stmt_store_result($stmt);
        }
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
};

// if (!mysqli_stmt_prepare($stmt, $sql)) {
//     header("Location: ../index.php?error=sqlerror");
//     exit();
// } else {
//     mysqli_stmt_bind_param($stmt, "s", $vin);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_store_result($stmt);
//     $rowcount = mysqli_stmt_num_rows($stmt);

//     if ($rowcount > 0) {
//         header("Location: ../index.php?error=VIN Already stored.");
//         exit();
//     } else {
//         $sql = "INSERT INTO vinlist (vinlist, make) VALUES (?, ?)";
//         $stmt = mysqli_stmt_init($conn);
//         if (!mysqli_stmt_prepare($stmt, $sql)) {
//             header("Location: ../index.php?error=VIN Already stored.");
//             exit();
//         } else {
//             mysqli_stmt_bind_param($stmt, "ss", $vin, $make);
//             mysqli_stmt_execute($stmt);
//             mysqli_stmt_store_result($stmt);
//         }
//     }
// }
