<?php
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$installer->updateAttribute('catalog_product', 'scene7_main', 'used_in_product_listing', 1);
$installer->updateAttribute('catalog_product', 'scene7_addition', 'backend_type', 'text');

$installer->endSetup();