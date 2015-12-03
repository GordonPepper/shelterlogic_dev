<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/16/15
 * Time: 2:16 PM
 */

$this->startSetup();

$this->addAttribute('catalog_product', 'tlx_ship_ltl', array(
    'type'              => 'varchar',
    'label'             => 'LTL Shippment',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => true,
    'is_configurable'   => false,
    'backend'           => 'catalog/product_attribute_backend_boolean',
    'source'            => 'eav/entity_attribute_source_boolean',
    'input'             => 'select',
    'default'           => '0'
));
$this->addAttribute('catalog_product', 'tlx_ship_length', array(
    'type'              => 'text',
    'label'             => 'Shipping Length',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => false,
    'is_configurable'   => false,
    'default'           => '0'
));
$this->addAttribute('catalog_product', 'tlx_ship_width', array(
    'type'              => 'varchar',
    'label'             => 'Shipping Width',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => false,
    'is_configurable'   => false,
    'default'           => '0'
));
$this->addAttribute('catalog_product', 'tlx_ship_height', array(
    'type'              => 'varchar',
    'label'             => 'Shipping Height',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => false,
    'is_configurable'   => false,
    'default'           => '0'
));
$this->addAttribute('catalog_product', 'tlx_pallet_weight', array(
    'type'              => 'varchar',
    'label'             => 'Pallet Weight',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => false,
    'is_configurable'   => false,
    'default'           => ''
));

$this->endSetup();
