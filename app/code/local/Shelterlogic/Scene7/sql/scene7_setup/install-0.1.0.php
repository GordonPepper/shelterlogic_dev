<?php
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$attributeSet = 'Default';

$installer->addAttributeGroup('catalog_product', $attributeSet, 'Adobe Scene 7');

$installer->addAttribute('catalog_product', 'scene7_main', array(
    'type'                      => 'varchar',
    'input'                     => 'text',
    'label'                     => 'Scene 7 Main Image',
    'required'                  => 0,
    'user_defined'              => 1,
    'global'                    => 0,
));
$installer->addAttributeToGroup('catalog_product', $attributeSet, 'Adobe Scene 7', 'scene7_main', 10);

$installer->addAttribute('catalog_product', 'scene7_addition', array(
    'type'                      => 'varchar',
    'input'                     => 'textarea',
    'label'                     => 'Scene 7 Additional Images',
    'required'                  => 0,
    'user_defined'              => 1,
    'global'                    => 0,
));
$installer->addAttributeToGroup('catalog_product', $attributeSet, 'Adobe Scene 7', 'scene7_addition', 20);

$installer->endSetup();