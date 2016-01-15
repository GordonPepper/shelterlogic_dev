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
    'required' => false
));

$installer->addAttribute('customer', 'credit_status', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Credit Status',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => false
));

$installer->addAttribute('customer', 'price_group', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Price Group',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => false
));

$installer->addAttribute('customer', 'discount_percent', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Discount Percent',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => false
));

$installer->addAttribute('customer', 'phone', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Phone',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => true,
    'visible' => true
));

$installer->endSetup();