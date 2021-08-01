<?php

require 'database.php';

//WORK IN PROGRESS. Use this file to generate an array of all 130+ elements found in NHTSA API.
//Vehicles will likely need to be classified differently depending on certain criteria.
//Semi-trailer VINs have different fields than Car VINs.

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
    
    // print_r($decoded);
    // echo $resp;
}
 
$vindatarray = $decoded['Results'];

foreach ($vindatarray as $VariableId => $Value){
	echo "$VariableId = $Value<br>";
}

print_r($vindatarray[6]);

// print_r($array);
  
$createTableStatement = "CREATE TABLE IF NOT EXISTS `vin_data_full`";
$createTableStatement .= '(';
$createTableStatement .= '`vin` VARCHAR(255) NOT NULL,';
 
foreach($array as $dataKey => $dataValues)
{
	$getDataType = gettype($dataValues);
	
	if($getDataType == 'integer')
	{
		$createTableStatement .= '`'.$dataKey.'` int(11) NOT NULL, ';
	}
	elseif($getDataType == 'double')
	{
		$createTableStatement .= '`'.$dataKey.'` float NOT NULL, ';
	}
	elseif($getDataType == 'boolean')
	{
		$createTableStatement .= '`'.$dataKey.'` tinyint(2) NOT NULL, ';
	}
	else
	{
		$createTableStatement .= '`'.$dataKey.'` varchar(255) NOT NULL, ';
	}
			
}
 
$createTableStatement .= 'PRIMARY KEY (`vin`)';
$createTableStatement .= ')';
 
$createTableStatement .= "ENGINE = INNODB DEFAULT CHARSET = utf8";
 
// echo $createTableStatement;
 
?>