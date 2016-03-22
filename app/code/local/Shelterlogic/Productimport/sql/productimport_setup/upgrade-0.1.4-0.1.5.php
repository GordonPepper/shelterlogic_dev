<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$atts = array('valence', 'waterproof', 'water_resistant', 'hardware_kit', 'storage_bag');

foreach ($atts as $att) {
    $installer->updateAttribute(
        Mage_Catalog_Model_Product::ENTITY,
        $att,
        'backend_model',
        null
    );

    $installer->updateAttribute(
        Mage_Catalog_Model_Product::ENTITY,
        $att,
        'source_model',
        'eav/entity_attribute_source_table'
    );
}

$installer->endSetup();
