<?php

/**
 * Order Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-12-18
 */

class Americaneagle_Visual_Model_Task_Ordersync
{
    /** @var  Americaneagle_Visual_Helper_Order $orderHelper */
    private $orderHelper;

    /** @var  Americaneagle_Visual_Helper_Customer $customerHelper */
    private $customerHelper;

    private $count = 0;
    private $errors = array();

    /** @var  Mage_Core_Model_Store store */
    private $store;

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        $this->orderHelper = Mage::helper('americaneagle_visual/order');

        if($this->orderHelper->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $this->customerHelper = Mage::helper('americaneagle_visual/customer');

        $parameters = $schedule->getParameters();
        $this->store = Mage::getModel('core/store');
        if ($parameters) {
            $parameters = json_decode($parameters);
            if ($parameters->store_id) {
                $this->store->load($parameters->store_id);
                $this->orderHelper->getConfig()->setStore($this->store);
            } else {
                return false;
            }
        } else {
            return false;
        }

        $startTime = microtime(true);

        $orderCollection = Mage::getModel('sales/order')->getCollection();
        $orderCollection->addAttributeToFilter('store_id', array('eq' => $this->store->getId()));
        $orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));

        if($orderCollection->count() == 0){
            return 'AE Visual: No orders to push';
        }

        //increment push attempts, send failure notifications
        $this->orderHelper->auditCollectionPush($orderCollection);

        /** @var Mage_Sales_Model_Order $order */
        foreach ($orderCollection as $order) {

            /** @var Mage_Customer_Model_Customer $customer */
            $customer = Mage::getModel("customer/customer");
            $customer->load($order->getCustomerId());

            /*
             * update customer info
             */
            if (!$customer->getVisualCustomerId() && $customer->getEmail()) {
                $vCustomer = $this->customerHelper->getVisualCustomerByEmail($customer->getEmail());
                if ($vCustomer) {
                    $customer->setVisualCustomerId($vCustomer->getCustomerID());
                    $customer->save();
                }
            }

            $vCustomer = $this->customerHelper->createVisualCustomer($customer);
            if (is_null($vCustomer)) {
                $this->errors[] = array('OrderID' => $order->getID(), 'Error' => 'Unable to create customer ' . $customer->getEmail() . ' in VISUAL');
                continue;
            }

            $shippingAddress = $order->getShippingAddress();
            $shipToId = $this->customerHelper->getShipToId($vCustomer->getCustomerID(), $shippingAddress);

            if (is_null($shipToId)) {
                $address = $this->customerHelper->addNewAddress($shippingAddress, $vCustomer->getCustomerID());
                if (is_null($address)) {
                    $this->errors[] = array('OrderID' => $order->getID(), 'Error' => 'Unable to create address for ' . $vCustomer->getCustomerID() . ' in VISUAL');
                    continue;
                }
                $shipToId = $address->getShipToID();
            }

            $vOrder = $this->orderHelper->addNewOrderForAddress($order, $vCustomer->getCustomerID(), $shipToId);
            if (is_null($vOrder)) {
                $this->errors[] = array('OrderID' => $order->getID(), 'Error' => 'Unable to create order ' . $vCustomer->getCustomerID() . ' in VISUAL');
                continue;
            }
            $order->setAeSentToVisual(1);
            $order->save();
            $this->count++;
        }

        if (count($this->errors) > 0) {
            return 'Orders pushed: ' . $this->count . ' Time:' . (microtime(true)-$startTime) . ' Errors:(' . count($this->errors) . ')' . json_encode($this->errors, JSON_PRETTY_PRINT);
        } else {
            return 'Orders pushed: ' . $this->count . ' Time:' . (microtime(true)-$startTime);
        }

    }
}
