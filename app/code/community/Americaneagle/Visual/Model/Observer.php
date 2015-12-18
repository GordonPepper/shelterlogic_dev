<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 4:41 PM
 */

class Americaneagle_Visual_Model_Observer extends Mage_Core_Model_Abstract {
	/** @var  Americaneagle_Visual_Helper_Data helper */
	private $config;

    public function __construct()
    {
        $this->config = Mage::helper('americaneagle_visual');
    }

    public function cleanSoaplog(Mage_Cron_Model_Schedule $observer) {
		$ttl = Mage::getStoreConfig('aevisual/logging/soaplog_ttl');

		if($this->config->getSoaplogEnable() == 0)
			return $this;

		/** @var Americaneagle_Visual_Model_Soaplog $sl */
		$sl = Mage::getModel('americaneagle_visual/soaplog');//->cleanSoaplog($ttl);
		$sl->getResource()->cleanSoaplog($ttl);

	}
	public function pushOrders(Mage_Cron_Model_Schedule $observer)
	{
		if ($this->config->getEnabled() == 0) {
			return $this;
		}
		/**
		 * so the pattern is
		 * 1) check if any orders need to be transferred, if not bail
		 * 2) get the "FBWebOrder" customer visual (check config for actual value)
		 *    should be in 'aevisual/general/customer_id'
		 * 3) check if this customer exists, and if not create
		 * 4) begin processing loop
		 */

		$fbStore = Mage::app()->getStore('default');

		$orderHelper = Mage::helper('americaneagle_visual/order');
		$orderHelper->getConfig()->setStore($fbStore);
		$customerHelper = Mage::helper('americaneagle_visual/customer');
		$customerHelper->getConfig()->setStore($fbStore);

		$orderCollection = Mage::getModel('sales/order')->getCollection();
		$orderCollection->addAttributeToFilter('store_id', array('eq' => $fbStore->getId()));
		$orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));

		if ($orderCollection->count() == 0) {
			Mage::log('AE Visual: No orders to push');
			return 'AE Visual: No orders to push';
		}
		Mage::log('AE Visual: There are orders to push');

		//increment push attempts, send failure notifications
		$orderHelper->auditCollectionPush($orderCollection);

		$customerId = Mage::getStoreConfig('aevisual/general/customer_id');

		$vCustomer = $customerHelper->getVisualCustomerById($customerId);

		if (is_null($vCustomer)) {
			$vCustomer = $customerHelper->createVisualFBCustomerById($customerId);
			if (is_null($vCustomer)) {
				Mage::logException(new Exception('Unable to create customer ' . $customerId . ' in VISUAL'));
				return 'Unable to create customer ' . $customerId . ' in VISUAL';
			}
		}

		/** @var Mage_Sales_Model_Order $order */
		foreach ($orderCollection as $order) {
			/**
			 * first create the address
			 * then the order
			 */

			$vAddress = $customerHelper->addNewAddress($order->getShippingAddress(), $customerId);
			if ($vAddress === false) {
				continue;
			}

			$vOrder = $orderHelper->addNewOrderForAddress($order, $vAddress->getShipToID());
			if ($vOrder === false) {
				continue;
			}
			$order->setAeSentToVisual(1);
			$order->save();
		}
	}
}
