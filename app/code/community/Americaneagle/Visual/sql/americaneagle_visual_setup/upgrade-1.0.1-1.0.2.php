<?php
/**
 * upgrade script for removing address attributes and adding a couple customer attributes
 *
 * @author Levente Albert
 * @since 1/15/16
 */

$installer = $this;
$installer->startSetup();

$installer->removeAttribute('customer_address','is_residential');
$installer->removeAttribute('customer_address','is_limited_access');

$installer->addAttribute('customer', 'visual_customer_id', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Visual Customer ID',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => 0,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'visual_customer_id')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->setData('is_visible', 0)
    ->setData('sort_order', 110)
    ->save();

$installer->addAttribute('customer', 'credit_status', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Credit Status',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => 0,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'credit_status')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->setData('is_visible', 0)
    ->setData('sort_order', 111)
    ->save();

$installer->addAttribute('customer', 'price_group', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Price Group',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => 0,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'price_group')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->setData('is_visible', 0)
    ->setData('sort_order', 112)
    ->save();

$installer->addAttribute('customer', 'discount_percent', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Discount Percent',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => 0,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'discount_percent')
    ->setData('used_in_forms', array('adminhtml_customer'))
    ->setData('is_visible', 0)
    ->setData('sort_order', 113)
    ->save();

$installer->addAttribute('customer', 'phone', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Phone',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => 1,
    'user_defined' => 1
));

Mage::getSingleton('eav/config')
    ->getAttribute('customer', 'phone')
    ->setData('used_in_forms', array('adminhtml_customer','customer_account_create','customer_account_edit','checkout_register'))
    ->setData('sort_order', 81)
    ->save();

Mage::getSingleton('eav/config')
    ->getAttribute('customer_address', 'street')
    ->setData('multiline_count', 3)
    ->save();

$installer->endSetup();