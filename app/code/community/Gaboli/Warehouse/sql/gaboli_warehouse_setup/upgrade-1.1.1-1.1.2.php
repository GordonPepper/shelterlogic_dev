<?php

$installer = $this;

$installer->startSetup();
/**
 * Create table 'gaboli_warehouse/quote'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('gaboli_warehouse/quote'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
    ), 'Quote Item ID')
    ->addColumn('location_stock_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true
    ), 'Location Stock ID')
    ->setComment('Location Stock To Quote Item Relation Table');

$installer->getConnection()->createTable($table);
$installer->endSetup();
