<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 3:08 PM
 */
/** @var Mage_Sales_Model_Entity_Setup $installer */
$installer = $this;
$installer->startSetup();

$installer->addAttribute('order', 'ae_sent_to_visual', array(
	'type' => 'smallint',
	'input' => 'boolean',
	'label' => 'Sent to VISUAL',
	'global' => 1,
	'unsigned'  => true,
	'default'   => '0',
));

$installer->addAttribute('order', 'ae_visual_push_attempt', array(
	'type' => 'int',
	'input' => 'text',
	'label' => 'Push Attempts',
	'global' => 1,
	'unsigned' => true,
	'default' => '0'
));

$collection = Mage::getModel('sales/order')->getCollection();
foreach($collection as $order) {
	$order->setAeSentToVisual(1);
	$order->save();
}

/* Sample Code
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
*/
$installer->endSetup();