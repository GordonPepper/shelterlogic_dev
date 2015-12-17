<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$import = Mage::getModel('fastsimpleimport/import');
$import->processCategoryImport(array(
    array(
        '_root' => 'ShelterLogic',
        '_category' => 'Featured',
        'description' => '',
        'is_active' => 'yes',
        'include_in_menu' => 'no',
        'available_sort_by' => null,
        'default_sort_by' => null,
        'is_anchor' => 'no'),
    array(
        '_root' => 'ShelterLogic',
        '_category' => 'On Clearance',
        'description' => '',
        'is_active' => 'yes',
        'include_in_menu' => 'no',
        'available_sort_by' => null,
        'default_sort_by' => null,
        'is_anchor' => 'no'),
));

$installer->endSetup();
