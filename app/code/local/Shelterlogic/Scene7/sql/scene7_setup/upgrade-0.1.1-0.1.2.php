<?php
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$attributeSet = 'Default';

$installer->addAttribute('catalog_product', 'scene7_manual', array(
    'type'                      => 'varchar',
    'input'                     => 'text',
    'label'                     => 'Assembly Manual URL',
    'required'                  => 0,
    'user_defined'              => 1,
    'global'                    => 0,
));
$installer->addAttributeToGroup('catalog_product', $attributeSet, 'Adobe Scene 7', 'scene7_manual', 30);

$installer->endSetup();