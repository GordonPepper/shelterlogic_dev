<?php
/* @var $installer Shelterlogic_Productimport_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

$attrSet   = 'ShelterLogic';
$attrGroup = 'ShelterLogic';

$installer->addTextAttribute(   'marketing_block_title',        'Marketing Block Title',        $attrSet, $attrGroup, 220,
    array(
        'is_html_allowed_on_front'  => 1,
    ));
$installer->addTextAttribute(   'marketing_block_description',  'Marketing Block Description',  $attrSet, $attrGroup, 230,
    array(
        'type'                      => 'text',
        'is_html_allowed_on_front'  => 1,
    ));

$installer->endSetup();
