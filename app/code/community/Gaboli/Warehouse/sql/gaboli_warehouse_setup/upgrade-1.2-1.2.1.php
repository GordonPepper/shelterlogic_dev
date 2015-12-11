<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 12/11/15
 * Time: 10:12 AM
 */
/** @var Mage_Core_Model_Resource_Setup $this */
$this->startSetup();

$this->getConnection()
    ->addColumn(
        $this->getTable('gaboli_warehouse/stock_status_index'),
        'manage_stock',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
            'length' => 5,
            'unsigned' => true,
            'nullable' => false,
            'default' => 0,
            'comment' => 'Allow manage stock setting'
        )
    );
$this->endSetup();