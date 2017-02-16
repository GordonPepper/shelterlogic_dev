<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/30/15
 * Time: 1:36 PM
 */
/** @var Mage_Core_Model_Resource_Setup $this */

$this->startSetup();

/**
 * create a log table for soap requests
 */

/** @var Varien_Db_Adapter_Interface $conn */
$conn = $this->getConnection();

/** @var Varien_Db_Ddl_Table $table */
$tablename = $this->getTable('americaneagle_totalogistix_zip/zip');
$table = $conn->newTable($tablename);

$table->addColumn('zip_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,array(
    'identity' => true,
    'unsigned' => true,
    'nullable' => false,
    'primary' => true
), 'Soap Log Id');
$table->addColumn('zip_code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 8, array(), 'Zip Code');
$table->addColumn('zip_code_type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 16, array(), 'Zip Code Type');
$table->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(), 'City');
$table->addColumn('state', Varien_Db_Ddl_Table::TYPE_VARCHAR, 4, array(), 'State Code');
$table->addColumn('location_Type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 16, array(), 'Location Type');
$table->addColumn('latitude', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(), 'Latitude');
$table->addColumn('longitude', Varien_Db_Ddl_Table::TYPE_FLOAT, null, array(), 'Longitude');
$table->addColumn('location', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(), 'Location');
//$table->addColumn('decomissioned', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(), 'Decommisioned');

$table->setComment('Table for zip code geolocation');

$conn->createTable($table);
$this->endSetup();