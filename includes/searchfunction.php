<?php

require 'database.php';

//Use input VIN to submit request to NHSTA API

$vinnumber = strtoupper($_POST['inputvin']);
$_SESSION['vinnumber'] = $vinnumber;

echo strlen($vinnumber);

if (empty($vinnumber)) {
    header("Location:index.php?error=Search Field is Empty");
    exit();
} elseif (!preg_match("/^[[:alnum:]]+$/", $vinnumber)) {
    header("Location:index.php?error=Invalid Characters");
    exit();
} elseif (strlen($vinnumber)!=17) {
    header("Location:index.php?error=Invalid Length");
    exit();
}
 else {

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

    $vindatarray = $decoded['Results'];

    // print_r($vindatarray);
    echo "<div><h3>{$decoded['Message']}</h3></div>";

    echo "<table>";
    echo "<tr><td>VIN</td><td>{$vinnumber}</td></tr>\n<tr>
<td>{$decoded['Results'][6]['Variable']}</td><td>{$decoded['Results'][6]['Value']}</td></tr>\n
<td>{$decoded['Results'][8]['Variable']}</td><td>{$decoded['Results'][8]['Value']}</td></tr>\n
<td>{$decoded['Results'][9]['Variable']}</td><td>{$decoded['Results'][9]['Value']}</td></tr>\n
<td>{$decoded['Results'][12]['Variable']}</td><td>{$decoded['Results'][12]['Value']}</td></tr>\n
<td>{$decoded['Results'][21]['Variable']}</td><td>{$decoded['Results'][21]['Value']}</td></tr>\n
<td>{$decoded['Results'][35]['Variable']}</td><td>{$decoded['Results'][35]['Value']}</td></tr>\n
<td>{$decoded['Results'][49]['Variable']}</td><td>{$decoded['Results'][49]['Value']}</td></tr>\n
<td>{$decoded['Results'][47]['Variable']}</td><td>{$decoded['Results'][47]['Value']}</td></tr>\n
<td>{$decoded['Results'][93]['Variable']}</td><td>{$decoded['Results'][93]['Value']}</td></tr>\n
<td>{$decoded['Results'][95]['Variable']}</td><td>{$decoded['Results'][95]['Value']}</td></tr>\n
";
    echo "</table>";
}

//Run to build array for database, which has 100+ entires
//FUNCTION NOT COMPLETE YET

// require_once 'tablearray.php';
?>

<div class="buttons">
    <form method="post">
        <button type="submit" name="writeData">Add to Database</button>
    </form>
</div>