<?php
/**
 * Created by PhpStorm.
 * User: magentouser
 * Date: 11/24/14
 * Time: 4:41 PM
 */

class Americaneagle_Visual_Model_Observer extends Mage_Core_Model_Abstract {
	/** @var  Americaneagle_Visual_Helper_Data helper */
	private $helper;

    public function __construct()
    {
        $this->helper = Mage::helper('americaneagle_visual');
    }

    public function cleanSoaplog(Mage_Cron_Model_Schedule $observer) {
		$ttl = Mage::getStoreConfig('aevisual/logging/soaplog_ttl');

		if($this->helper->getSoaplogEnable() == 0)
			return $this;

		/** @var Americaneagle_Visual_Model_Soaplog $sl */
		$sl = Mage::getModel('americaneagle_visual/soaplog');//->cleanSoaplog($ttl);
		$sl->getResource()->cleanSoaplog($ttl);

	}
	public function pushOrders(Mage_Cron_Model_Schedule $observer) {
		if($this->helper->getEnabled() == 0) {
			return $this;
		}
		$orderHelper = Mage::helper('americaneagle_visual/order');
		$customerHelper = Mage::helper('americaneagle_visual/customer');
		/**
		 * so the pattern is
		 * 1) check if any orders need to be transferred, if not bail
		 * 2) get the "FBWebOrder" customer visual (check config for actual value)
		 *    should be in 'aevisual/general/customer_id'
		 * 3) check if this customer exists, and if not create
		 * 4) begin processing loop
		 */

		$farmbuildingStoreId = Mage::app()->getStore('default')->getId();

		$orderCollection = Mage::getModel('sales/order')->getCollection();
		$orderCollection->addAttributeToFilter('store_id', array('eq' => $farmbuildingStoreId));
		$orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));

		if($orderCollection->count() == 0){
			Mage::log('AE Visual: No orders to push');
			return;
		}
		Mage::log('AE Visual: There are orders to push');

		//increment push attempts, send failure notifications
		$this->auditCollectionPush($orderCollection);

		$customerId = Mage::getStoreConfig('aevisual/general/customer_id');

		$vCustomer = $customerHelper->getVisualCustomerById($customerId);

		if(is_null($vCustomer)) {
            $vCustomer = $customerHelper->createVisualCustomer($customerId);
			if(is_null($vCustomer)) {
				Mage::logException(new Exception("Unable to create customer $customerId in VISUAL"));
			}
		}

		/** @var Mage_Sales_Model_Order $order */
		foreach($orderCollection as $order) {
			/**
			 * first create the address
			 * then the order
			 */

			$vAddress = $customerHelper->addNewAddress($order->getShippingAddress());
			if($vAddress === false) {
				continue;
			}

			$vOrder = $orderHelper->addNewOrderForAddress($order, $vAddress->getShipToID());
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
		if($max == 10 || $max == 75 || ($max > 0 && ($max % 200) == 0)){
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

	public function customerCustomerAuthenticated($event)
    {
        if($this->helper->getEnabled() == 0) {
            return $this;
        }
        $customerHelper = Mage::helper('americaneagle_visual/customer');

        $customer = $event->getModel();

        if (!empty($customer->getVisualCustomerId)) {
            $vCustomer = $customerHelper->getVisualCustomerById($customer->getVisualCustomerId);
            if(is_null($vCustomer)) {
                throw Mage::exception('Mage_Core', Mage::helper('customer')->__('We are not able to reach the service please try again later.'),
                    Mage_Customer_Model_Customer::EXCEPTION_INVALID_EMAIL_OR_PASSWORD
                );
            }
        }
    }
}
