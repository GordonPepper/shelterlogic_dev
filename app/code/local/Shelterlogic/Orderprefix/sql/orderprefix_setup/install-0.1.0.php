<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 12/1/2015
 * Time: 5:38 PM
 */ 
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

// Clean up old prefixes
$collection = Mage::getModel('eav/entity_store')->getCollection();
foreach ($collection as $entityStore) {
    /** Mage_Eav_Model_Entity_Store $entityStore */
    $entityStore->setIncrementLastId(preg_replace('/[^0-9]*/', '', $entityStore->getIncrementLastId()));
    $entityStore->save();
}

$installer->endSetup();