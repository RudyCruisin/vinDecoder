# vinDecoder
Interface for viewing, modifying, and storing data gathered from NHTSA API Vin Decoder.
https://vpic.nhtsa.dot.gov/api/

# VINs for testing were randomly selected from carmax.com

# use to build table in mySQL
 CREATE TABLE IF NOT EXISTS `vinList`(
     `vin` VARCHAR(255) NOT NULL, 
     `make` VARCHAR(255) NOT NULL, 
     `model` VARCHAR(255) NOT NULL, 
     `modelYear` INT(11) NOT NULL, 
     `trim` VARCHAR(255) NOT NULL, 
     `bodyClass` VARCHAR(255) NOT NULL, 
     `cabType` VARCHAR(255) NOT NULL, 
     `driveType` VARCHAR(255) NOT NULL, 
     `frontAirbagLocation` VARCHAR(255) NOT NULL, 
     `sideAirbagLocation` VARCHAR(255) NOT NULL, 
     `transmissionStyle` VARCHAR(255) NOT NULL, 
     `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
     PRIMARY KEY(`vin`) 
     ) ENGINE = INNODB DEFAULT CHARSET = utf8; 