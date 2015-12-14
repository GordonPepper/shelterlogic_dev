<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$attributesToUpdate = array(
    'size',
    'video_url',
    'peak_height',
    'wall_height',
    'valence',
    'waterproof',
    'water_resistant',
    'fire_rated',
    'warranty',
    'storage_bag',
    'hardware_kit',
    'cords_of_wood',
    'scene7_manual',
);

foreach ($attributesToUpdate as $attribute) {
    $installer->updateAttribute('catalog_product', $attribute, 'is_visible_on_front', 1);
}

$installer->endSetup();
