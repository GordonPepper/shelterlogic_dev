<?php
/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 6/10/16
 * Time: 9:24 AM
 */

class Shelterlogic_Checkout_Block_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{
    public function checkShippingCost()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn() && (Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 1 || Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 4)) {
            $customerTerms = Mage::getSingleton('customer/session')->getCustomer()->getCustomerTerms();

            if (strtolower($customerTerms) == 'national freight') {
                $cart = Mage::getModel('checkout/cart')->getQuote();
                $totalFreightCost = 0;
                foreach ($cart->getAllItems() as $item) {
                    $productId = $item->getProduct()->getId();
                    $storeId = Mage::app()->getStore()->getStoreId();
                    $freightCost = Mage::getResourceModel('catalog/product')->getAttributeRawValue($productId, 'freight_cost', $storeId);

                    if ($freightCost) {
                        $freightCost = number_format((float)$freightCost, 2, '.', '');
                        if($item->getQty() > 1) {
                            $freightCost = $freightCost * $item->getQty();
                        }
                        $totalFreightCost = $totalFreightCost + $freightCost;
                    } else {
                        return NULL;
                    }
                }
                return $totalFreightCost;
            } elseif (strtolower($customerTerms) == '3rd party bill') {
                return '3rd-party';
            }
        }
    }
}
