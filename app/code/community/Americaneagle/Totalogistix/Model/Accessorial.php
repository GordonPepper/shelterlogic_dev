<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 10/1/14
 * Time: 1:37 PM
 */

class Americaneagle_Totalogistix_Model_Accessorial {
	public function toOptionArray() {
		$h=Mage::helper('americaneagle_totalogistix');
		return array(
			array('value' => 'GSV', 'label' => $h->__('Guarantee Service')),
			array('value' => 'IDL', 'label' => $h->__('Inside Delivery')),
			array('value' => 'LFT', 'label' => $h->__('Lift Gate')),
			array('value' => 'NFY', 'label' => $h->__('Notification Charge')),
			array('value' => 'REP', 'label' => $h->__('Residential')),
			array('value' => 'LTD', 'label' => $h->__('Limited Access'))
		);
	}
} 