<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 12/14/15
 * Time: 3:25 PM
 */

/** @var Mage_Customer_Model_Entity_Setup $this */

$this->startSetup();

// will cause an update
$this->addAttribute('catalog_product', 'class', array(
    'type'              => 'varchar',
    'label'             => 'Class',
    'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'visible'           => false,
    'required'          => false,
    'is_configurable'   => false,
    'default'           => ''
));

$this->endSetup();
