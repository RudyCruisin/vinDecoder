<?php

require 'database.php';

//WORK IN PROGRESS. Use this file to generate an array of all 130+ elements found in NHTSA API.
//Vehicles will likely need to be classified differently depending on certain criteria.
//Semi-trailer VINs have different fields than Car VINs.

$vinnumber = $_SESSION['vinnumber'];
 
$vindatarray = $_SESSION['vindata']['Results'];

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