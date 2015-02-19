<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 4:41 PM
 */

class Americaneagle_Visual_Model_Observer extends Mage_Core_Model_Abstract {
	/** @var  Americaneagle_Visual_Helper_Visual vhelper */
	private $vhelper;

	public function cleanSoaplog(Mage_Cron_Model_Schedule $observer) {
		$ttl = Mage::getStoreConfig('aevisual/logging/soaplog_ttl');
		$helper = Mage::helper('americaneagle_visual');

		if($helper->getSoaplogEnable() == 0)
			return $this;

		/** @var Americaneagle_Visual_Model_Soaplog $sl */
		$sl = Mage::getModel('americaneagle_visual/soaplog');//->cleanSoaplog($ttl);
		$sl->getResource()->cleanSoaplog($ttl);

	}
	public function pushOrders(Mage_Cron_Model_Schedule $observer) {
		$this->vhelper = Mage::helper('americaneagle_visual/visual');
		/**
		 * so the pattern is
		 * 1) check if any orders need to be transferred, if not bail
		 * 2) get the "FBWebOrder" customer visual (check config for actual value)
		 *    should be in 'aevisual/general/customer_id'
		 * 3) check if this customer exists, and if not create
		 * 4) begin processing loop
		 */

		$orderCollection = Mage::getModel('sales/order')->getCollection();
		$orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));

		if($orderCollection->count() == 0){
			Mage::log('AE Visual: No orders to push');
			return;
		}
		Mage::log('AE Visual: There are orders to push');

		$customerId = Mage::getStoreConfig('aevisual/general/customer_id');

		$resp = $this->vhelper->getVisualCustomerById($customerId);
		if(empty($resp))
			return; // helper logs exception
		$vCustomer = null;

		if(isset($resp->SearchCustomerResult->Customers->Customer) && $resp->SearchCustomerResult->Customers->Customer->CustomerID == $customerId) {
			$vCustomer = $resp->SearchCustomerResult->Customers->Customer;
		} else {
			$resp = $this->vhelper->createVisualCustomerId($customerId);
			if(!isset($resp->CreateCustomerResult->Customers->Customer) && $vCustomer->CreateCustomerResult->Customers->Customer->CustomerID != $customerId) {
				Mage::logException(new Exception("Unable to create customer $customerId in VISUAL"));
			}
			$vCustomer = $resp->CreateCustomerResult->Customers->Customer;
		}

		/** @var Mage_Sales_Model_Order $order */
		foreach($orderCollection as $order) {
			/**
			 * first create the address
			 * then the order
			 */

			$vAddress = $this->vhelper->addNewAddress($order->getShippingAddress())->AddNewAddressResult;
			//Mage::log(sprintf('new address result: %s', print_r($vAddress, true)));

			$vOrder = $this->vhelper->addNewOrderForAddress($order, $vAddress->ShipToID);
			//$vOrder = $this->vhelper->addNewOrderForAddress($order, 'AFDCHI3');
			$order->setAeSentToVisual(1);
			$order->save();
		}

	}

} 