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

/** @var Varien_Db_Adapter_Interfac e $conn */
$conn = $this->getConnection();

/** @var Varien_Db_Ddl_Table $table */
$tablename = $this->getTable('americaneagle_totalogistix_city/city');
$table = $conn->newTable($tablename);

$table->addColumn('city_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,array(
    'identity' => true,
    'unsigned' => true,
    'nullable' => false,
    'primary' => true
), 'Soap Log Id');
$table->addColumn('city', Varien_Db_Ddl_Table::TYPE_VARCHAR, 50, array(), 'City');

$table->setComment('Table for Alaska cities');

$conn->createTable($table);
$this->endSetup();