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

		//increment push attempts, send failure notifications
		$this->auditCollectionPush($orderCollection);

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
			if($vAddress === false) {
				continue;
			}

			$vOrder = $this->vhelper->addNewOrderForAddress($order, $vAddress->ShipToID);
			if($vOrder === false) {
				continue;
			}
			$order->setAeSentToVisual(1);
			$order->save();
		}

	}
	private function auditCollectionPush(Mage_Sales_Model_Resource_Order_Collection $coll) {
		$max = 0;
		$fails = array();
		foreach($coll as $order) {
			$count = intval($order->getData('ae_visual_push_attempt'));
			$order->setData('ae_visual_push_attempt', $count + 1);
			$order->save();
			if($count > $max)
				$max = $count;
			if($count > 1)
				$fails[] = $order->getIncrementId();
		}
		if($max == 10 || $max == 75 || ($max % 200) == 0){
			$email = Mage::getStoreConfig('aevisual/logging/pushfail_email');
			$f_name = Mage::getStoreConfig('trans_email/ident_general/name');
			$f_email = Mage::getStoreConfig('trans_email/ident_general/email');
			if($email) {
				mail(
					$email,
					'Order push to VISUAL failure notice',
					"NOTICE: The following orders have failed to push to VISUAL:\r\n" . implode("\r\n", $fails) . "\r\n\r\nPlease review the VISUAL Soap log for more information.",
					"From: $f_name <$f_email>"
				);
			}
		}
	}

}
