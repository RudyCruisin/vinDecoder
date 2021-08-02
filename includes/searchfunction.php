<?php

require 'database.php';

//Storing VIN Number from user input a variable and session variable

$vinnumber = strtoupper($_POST['inputvin']);
$_SESSION['vinnumber'] = $vinnumber;

//Error handlers for user input, to make sure VIN meets length and value standards

if (empty($vinnumber)) {
    header("Location:index.php?error=Search Field is Empty");
    exit();
} elseif (!preg_match("/^[[:alnum:]]+$/", $vinnumber)) {
    header("Location:index.php?error=Invalid Characters");
    exit();
} elseif (strlen($vinnumber) != 17) {
    header("Location:index.php?error=Invalid Length");
    exit();
} else {

    //PHP cURL method for recieving data from NHTSA API with user submitted VIN

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

    $_SESSION['vindata'] = $decoded;

    $vin_data_array = $decoded['Results'];
    $vin_value_array = [6, 8, 9, 12, 21, 35, 49, 47, 93, 95];

    //Creating a table display of values from NHTSA API for user submitted VIN number

?>

    <div>
        <h3><?php echo $decoded['Message'] ?></h3>
        <div>
            <form class="updateform" method="POST">
                <table class="table table-sm searchtable">
                    <tbody>
                        <tr>
                            <td class="align-middle">VIN</td>
                            <td class="align-middle"><?php echo $vinnumber ?></td>
                            <?php 
                            for ($i = 0; $i < count($vin_value_array); $i++) {
                                echo "<tr><td class=align-middle>" . $vin_data_array[$vin_value_array[$i]]['Variable'] . "</td><td class=align-middle>" . $vin_data_array[$vin_value_array[$i]]['Value'] . "</td></tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
        </div>

    <?php
}

    ?>

    <div class="buttons">
        <form method="post">
            <button class="submitButton" type="submit" name="writeData">Add to Database</button>
        </form>
    </div>