<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
/** @var AvS_FastSimpleImport_Model_Import $import */
$import = Mage::getModel('fastsimpleimport/import');

$data = array(
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
);

/*
 * need to check that the indicated categories exist before running
 */
/** @var Mage_Catalog_Model_Category $category */
$category = Mage::getModel('catalog/category');
if($category->loadByAttribute('name', 'ShelterLogic')) {
    $import->processCategoryImport($data);
}




$installer->endSetup();
