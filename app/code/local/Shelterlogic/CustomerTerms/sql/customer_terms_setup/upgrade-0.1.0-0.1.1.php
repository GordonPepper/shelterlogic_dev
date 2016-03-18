<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/8/16
 * Time: 10:51 AM
 */

$installer = $this;
$connection = $installer->getConnection();

$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('customer_entity'),
        'customer_terms',
        array(
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'nullable' => true,
            'default' => null,
            'comment' => 'Customer Terms'
        )
    );

$installer->endSetup();