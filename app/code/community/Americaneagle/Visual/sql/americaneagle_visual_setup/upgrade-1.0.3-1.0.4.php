<?php
/**
 * upgrade script for adding a tax exempt to customer
 *
 * @author Levente Albert
 * @since 1/15/16
 */

$installer = $this;
$installer->startSetup();

$installer->addAttribute('customer', 'tax_exempt', array(
    'type' => 'smallint',
    'input' => 'boolean',
    'label' => 'Tax Exempt',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '0',
    'required' => 1,
    'unsigned'  => true,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'tax_exempt')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->setData('is_visible', 0)
    ->setData('sort_order', 115)
    ->save();

$installer->endSetup();