<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/30/15
 * Time: 2:04 PM
 *
 * database sourced from: http://federalgovernmentzipcodes.us/free-zipcode-database-Primary.csv
 */
/** @var $this Mage_Core_Model_Resource_Setup */

if(!class_exists('CsvReader')){
    require_once('CsvReader.php');
}

$csv = new CsvReader(__DIR__ . '/free-zipcode-database-Primary.csv', ',', true);
$fieldMap = array(
    "Zipcode" => 'zip_code',
    "ZipCodeType" => 'zip_code_type',
    "City" => 'city',
    "State" => 'state',
    "LocationType" => 'location_type',
    "Lat" => 'latitude',
    "Long" => 'longitude',
    "Location" => 'location'
);

while ($csv->nextRow()) {
    $this->getConnection()->insertForce($this->getTable('americaneagle_totalogistix_zip/zip'), $csv->getAssociative($fieldMap));
}
