<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 11/23/15
 * Time: 3:35 PM
 */
class Americaneagle_Totalogistix_Model_Observer
{
    public function beforeCollectTotals(Varien_Event_Observer $observer) {
        /** @var Mage_Sales_Model_Quote_Address_Total_Collector $collector */

        $address = $observer->getQuoteAddress();

        $foo = 'bar';
    }
}