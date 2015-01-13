<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/1/14
 * Time: 3:36 PM
 */
/** @var Mage_Customer_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();
$installer->addAttribute('customer_address', 'is_residential', array(
	'type' => 'static',
	'input' => 'boolean',
	'label' => 'Residential Address',
	'global' => 1
));
Mage::getSingleton('eav/config')
	->getAttribute('customer_address', 'is_residential')
	->setData('used_in_forms', array(
		'customer_register_address',
		'customer_address_edit',
		'adminhtml_customer_address'
	))
	->save();
$installer->addAttribute('customer_address', 'is_limited_access', array(
	'type' => 'static',
	'input' => 'boolean',
	'label' => 'Limited Access',
	'global' => 1
));
Mage::getSingleton('eav/config')
	->getAttribute('customer_address', 'is_limited_access')
	->setData('used_in_forms', array(
		'customer_register_address',
		'customer_address_edit',
		'adminhtml_customer_address'
	))
	->save();

$installer->endSetup();