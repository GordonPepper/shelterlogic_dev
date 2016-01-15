<?php
/**
 * upgrade script for adding a terms id to customer
 *
 * @author Levente Albert
 * @since 1/15/16
 */

$installer = $this;
$installer->startSetup();

$installer->addAttribute('customer', 'terms_id', array(
    'type' => 'text',
    'input' => 'text',
    'label' => 'Terms ID',
    'global' => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'default' => '',
    'required' => false
));

$installer->endSetup();