<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 3:08 PM
 */
/** @var Mage_Core_Model_Resource_Setup $this */

$this->startSetup();

/**
 * create a log table for soap requests
 */

/** @var Varien_Db_Adapter_Interface $conn */
$conn = $this->getConnection();

/** @var Varien_Db_Ddl_Table $table */
$tablename = $this->getTable('americaneagle_visual/soaplog');
$table = $conn->newTable($tablename);

$table->addColumn('soaplog_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,array(
	'identity' => true,
	'unsigned' => true,
	'nullable' => false,
	'primary' => true
), 'Soap Log Id');
$table->addColumn('code', Varien_Db_Ddl_Table::TYPE_VARCHAR, 64, array(), 'Log Code');
$table->addColumn('datetime', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
	'nullable' => false,
	'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
), 'Timestamp');
$table->addColumn('message', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(), 'Special notes for the log entry');
$table->addColumn('request_data', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Request data for the entry, i.e. the soap envelope');
$table->addColumn('response_data', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Response data for the entry');
$table->setComment('Table for logging interaction with VISUAL');

$name = $table->getName();

$conn->createTable($table);
$this->endSetup();