<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 6/10/16
 * Time: 9:24 AM
 */

class Shelterlogic_Checkout_Block_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{
    public function displayShippingOptions()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn() && (Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 1 || Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 4)) {
            $customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
            $customerObj  = Mage::getModel('customer/customer')->load($customerId);
            $customerTerms = $customerObj->getData('customer_terms');

            if (strtolower($customerTerms) == 'national freight') {
                $cart = Mage::getModel('checkout/cart')->getQuote();
                foreach ($cart->getAllItems() as $item) {
                    $productId = $item->getProduct()->getId();
                    $storeId = Mage::app()->getStore()->getStoreId();
                    $freightCost = Mage::getResourceModel('catalog/product')->getAttributeRawValue($productId, 'freight_cost', $storeId);
                    if (!$freightCost) {
                        return true;
                    }
                }
            } elseif (strtolower($customerTerms) == 'quote by zip') {
                return true;
            }
        }
        return false;
    }
}
