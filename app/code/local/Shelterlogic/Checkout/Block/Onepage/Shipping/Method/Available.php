<?php

/**
 * Created by PhpStorm.
 * User: mageuser
 * Date: 3/9/16
 * Time: 3:04 PM
 */
class Shelterlogic_Checkout_Block_Onepage_Shipping_Method_Available extends Mage_Checkout_Block_Onepage_Shipping_Method_Available
{
    public function checkShippingCost()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn() && (Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 1 || Mage::getSingleton('customer/session')->getCustomer()->getGroupId() == 4)) {
            $customerTerms = Mage::getSingleton('customer/session')->getCustomer()->getCustomerTerms();

            if ($customerTerms == 'National Freight') {
                $cart = Mage::getModel('checkout/cart')->getQuote();
                $totalFreightCost = 0;
                $changePrice = true;
                foreach ($cart->getAllItems() as $item) {
                    $productId = $item->getProduct()->getId();
                    $storeId = Mage::app()->getStore()->getStoreId();
                    $freightCost = Mage::getResourceModel('catalog/product')->getAttributeRawValue($productId, 'freight_cost', $storeId);

                    if ($freightCost) {
                        $freightCost = number_format((float)$freightCost, 2, '.', '');
                        $totalFreightCost = $totalFreightCost + $freightCost;
                    } else {
                        return NULL;
                    }
                }
                if ($changePrice) {
                    return $totalFreightCost;
                }
            }
        }
    }

    public function getCarrierName($carrierCode)
    {
        if ($this->checkShippingCost() != NULL) {
            return 'Shipping Cost';
        }
        if ($name = Mage::getStoreConfig('carriers/'.$carrierCode.'/title')) {
            return $name;
        }
        return $carrierCode;
    }

    public function getShippingPrice($price, $flag)
    {
        if ($this->checkShippingCost() != NULL) {
            $price = $this->checkShippingCost();
            Mage::register('shipping_cost', $price);
        }
        return $this->getQuote()->getStore()->convertPrice(Mage::helper('tax')->getShippingPrice($price, $flag, $this->getAddress()), true);
    }
}
