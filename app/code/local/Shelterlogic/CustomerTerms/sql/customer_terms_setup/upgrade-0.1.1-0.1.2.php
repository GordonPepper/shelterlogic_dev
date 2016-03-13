<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/9/16
 * Time: 11:39 AM
 */

$installer = $this;
/* @var $installer Mage_Eav_Model_Entity_Setup */

$installer->startSetup();

$data=array(
    'type'=>'text',
    'input'=>'text',
    'sort_order'=> 1,
    'label'=>'Freight Cost',
    'global'=>Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    'required'=>'0',
    'comparable'=>'0',
    'searchable'=>'0',
    'is_configurable'=>'1',
    'user_defined'=>'1',
    'visible_on_front' => 0, //want to show on frontend?
    'visible_in_advanced_search' => 0,
    'is_html_allowed_on_front' => 0,
    'required'=> 0,
    'unique'=> false,
    'apply_to' => 'configurable,simple',
    'is_configurable' => false
);

$installer->addAttribute('catalog_product','FREIGHT_COST',$data);

$installer->addAttributeToSet(
    'catalog_product', 'Default', 'General', 'FREIGHT_COST'
); //Default = attribute set, General = attribute group

$installer->endSetup();