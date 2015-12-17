<?php

/**
 * Order Sync Task for Visual
 *
 * @author Levente Albert
 * @since 2015-11-9
 */

class Americaneagle_Visual_Model_Task_Ordersync
{

    /**
     * Behavior can be controlled via parameters
     *
     * @param Aoe_Scheduler_Model_Schedule $schedule
     * @return string
     * @throws Exception
     */
    /** @var  Americaneagle_Visual_Helper_Visual helper */
    private $helper;


    public function run(Aoe_Scheduler_Model_Schedule $schedule)
    {
        if(Mage::helper('americaneagle_visual')->getEnabled() == 0) {
            return $this;
        }
        $this->helper = Mage::helper('americaneagle_visual/visual');

        $parameters = $schedule->getParameters();
        if ($parameters) {
            $parameters = unserialize($parameters);
        }

        $customerId = Mage::getStoreConfig('aevisual/general/customer_id');

        $farmbuildingStoreId = Mage::app()->getStore('default')->getId();

        $orderCollection = Mage::getModel('sales/order')->getCollection();
        $orderCollection->addAttributeToFilter('store_id', array('neq' => $farmbuildingStoreId));
        $orderCollection->addAttributeToFilter('ae_sent_to_visual', array('eq' => 0));

        if($orderCollection->count() == 0){
            echo 'AE Visual: No orders to push';
            return;
        } else {
            echo $orderCollection->count();
        }

        /** @var Mage_Sales_Model_Order $order */
        foreach($orderCollection as $order) {
            //print_r($order);
            $customerId = $order->getCustomerId();
            $visualCustomerId="";
            if (!isset($customerId)){
                $visualCustomerId = $order->getStore()->getConfig('aevisual/general/customer_id');
            } else {
                $customerData = Mage::getModel('customer/customer')->load($customerId); // then load customer by customer id
                $visualCustomerId = $customerData->getBillingAddress()->getTelephone();
            }
            $billingAddress = $order->getBillingAddress();

            print_r($c); // customer details
        }

        return;

    }
}
