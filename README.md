# Rudy's vinDecoder

Interface for viewing, modifying, and storing data gathered from NHTSA API Vin Decoder - https://vpic.nhtsa.dot.gov/api/

You can find test VINs here - https://www.carmax.com

## SQL Table Statement

Use the code snippet below to build your table in mysql.

```SQL
CREATE TABLE IF NOT EXISTS `vinList`(
     `vin` VARCHAR(255) NOT NULL,
     `make` VARCHAR(255),
     `model` VARCHAR(255),
     `modelYear` INT(11),
     `trim` VARCHAR(255),
     `bodyClass` VARCHAR(255),
     `cabType` VARCHAR(255),
     `driveType` VARCHAR(255),
     `transmissionStyle` VARCHAR(255),
     `frontAirbagLocation` VARCHAR(255),
     `sideAirbagLocation` VARCHAR(255),
     `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
     PRIMARY KEY(`vin`)
     ) ENGINE = INNODB DEFAULT CHARSET = utf8;
```
