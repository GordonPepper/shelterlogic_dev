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
    require_once(__DIR__ . '/CsvReader.php');
}

$csv = new CsvReader(__DIR__ . '/CanadianPostalCodes.csv', ',', true);
$fieldMap = array(
    "PostalCode" => 'zip_code',
    "FSA" => 'fsa',
    "Latitude" => 'latitude',
    "Longitude" => 'longitude',
    "Place Name" => 'place_name',
    "FSA1" => 'fsa1',
    "FSA-Province" => 'fsa_province',
    "AreaType" => 'area_type'
);

while ($csv->nextRow()) {
    $this->getConnection()->insertForce($this->getTable('americaneagle_totalogistix_zip/ca_zip'), $csv->getAssociative($fieldMap));
}
