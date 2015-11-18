<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/16/15
 * Time: 2:16 PM
 */

$this->startSetup();

$this->addAttribute('catalog_product', 'ship_ltl', array(
    'type'              => 'varchar',
    'label'             => 'LTL Shippment',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => true,
    'required'          => true,
    'is_configurable'   => false,
    'backend'           => 'catalog/product_attribute_backend_boolean',
    'source'            => 'eav/entity_attribute_source_boolean',
    'input'             => 'select',
    'default'           => '0'
));



//$installer->getConnection()->modifyColumn(
//    $this->getTable('americaneagle_visual/soaplog'), 'datetime', 'DATETIME'
//);
//
//
//
//$cfg = Mage::getModel('core/config_data')
//    ->load('aevisual/general/soaplog_enable', 'path');
//if($cfg->getId()) {
//    $cfg->setPath('aevisual/logging/soaplog_enable')
//        ->save();
//}
//
//
$this->endSetup();
