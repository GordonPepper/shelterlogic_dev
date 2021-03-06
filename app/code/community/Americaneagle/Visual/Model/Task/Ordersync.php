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

    /** @var  Americaneagle_Visual_Helper_NotationService $notationServiceHelper */
    private $notationServiceHelper;

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
        $this->notationServiceHelper = Mage::helper('americaneagle_visual/notationService');

        if($this->orderHelper->getConfig()->getEnabled() == 0) {
            return $this;
        }

        $this->customerHelper = Mage::helper('americaneagle_visual/customer');

        $parameters = $schedule->getParameters();
        $this->store = Mage::getModel('core/store');

        $message = '';

        if ($parameters) {
            $parameters = json_decode($parameters);
            if ($parameters->store_ids) {
                $store_ids = $parameters->store_ids;
            } else {
                return false;
            }
        } else {
            return false;
        }

        foreach ($store_ids as $storeId) {
            $this->store = Mage::getModel('core/store');
            $this->store->load($storeId);

            $this->orderHelper->getConfig()->setStore($this->store);
            $this->orderHelper->setHeader(
                new SoapHeader('http://tempuri.org/', 'Header', array(
                    'Key' => $this->orderHelper->getConfig()->getServiceKey(),
                    'ExternalRefGroup' => $this->orderHelper->getConfig()->getExternalRefGroup()
                ))
            );
            $this->orderHelper->resetHeader();
            $this->customerHelper->getConfig()->setStore($this->store);
            $this->customerHelper->setHeader(
                new SoapHeader('http://tempuri.org/', 'Header', array(
                    'Key' => $this->orderHelper->getConfig()->getServiceKey(),
                    'ExternalRefGroup' => $this->orderHelper->getConfig()->getExternalRefGroup()
                ))
            );
            $this->customerHelper->resetHeader();

            $startTime = microtime(true);

            /** @var Mage_Sales_Model_Entity_Order_Collection $orderCollection */
            $orderCollection = Mage::getModel('sales/order')->getCollection();
            $orderCollection->addAttributeToFilter('store_id', array('eq' => $this->store->getId()));
            $orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));
            $orderCollection->addAttributeToFilter('state', array('neq' => 'canceled'));

            if($orderCollection->count() == 0){
                $message .= 'Store ' . $storeId . ' - No orders to push';
                continue;
            }

            //increment push attempts, send failure notifications
            $this->orderHelper->auditCollectionPush($orderCollection);

            /** @var Mage_Sales_Model_Order $order */
            foreach ($orderCollection as $order) {
                $vCustomer = null;
                $customer = Mage::getModel("customer/customer");

                if ($order->getCustomerId()) {
                    /** @var Mage_Customer_Model_Customer $customer */
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

                }

                $billingAddress = $order->getBillingAddress();

                if($order->getIncrementId() == 'D700000431') {
                    $foo = 'bar';
                }

                if($customer->getGroupId() == 5) {
                    $vCustomer = $this->customerHelper->createVisualCustomer($customer, $billingAddress);
                } else {
                    $vCustomer = $this->customerHelper->getVisualCustomerById($customer->getData()[visual_customer_id]);
                }
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

                $orderInfo = $order->getOrigData();
                $authorizationCode = $order->getPayment()->getData()['cc_trans_id'];
                $dollarAmount = number_format((float)$orderInfo['grand_total'], 2, '.', '');
                $orderDate = $orderInfo['created_at'];
                $notation = "Order Authorization Code: $authorizationCode \n Dollar Amount: $dollarAmount \n Order Date:  $orderDate";
                $this->notationServiceHelper->addNotation($orderInfo['increment_id'], $notation);

                $vOrder = $this->orderHelper->addNewOrderForAddress($order, $vCustomer->getCustomerID(), $shipToId, null, $shippingAddress->getRegionCode() == "CT");
                if (is_null($vOrder)) {
                    $this->errors[] = array(
                        'OrderID' => $order->getID(),
                        'Error' => 'Unable to create order ' . $vCustomer->getCustomerID() . ' in VISUAL');
                    $messages = $this->orderHelper->getErrorMessages();
                    if(count($messages) > 0 ) {
                        $c = current($this->errors);
                        $c['Error'] .= sprintf("\n%s", implode("\n", $messages));
                    }
                    continue;
                }
                $order->setAeSentToVisual(1);
                $order->save();
                $this->count++;
            }

            if (count($this->errors) > 0) {
                $message .= 'Store ' . $storeId . ' - Orders pushed: ' . $this->count . ' Time:' . (microtime(true)-$startTime) . ' Errors:(' . count($this->errors) . ')' . json_encode($this->errors, JSON_PRETTY_PRINT) . "\r\n";
            } else {
                $message .= 'Store ' . $storeId . ' - Orders pushed: ' . $this->count . ' Time:' . (microtime(true)-$startTime) . "\r\n";
            }
            $this->count = 0;
            $this->errors = array();
        }

        return $message;
    }
}