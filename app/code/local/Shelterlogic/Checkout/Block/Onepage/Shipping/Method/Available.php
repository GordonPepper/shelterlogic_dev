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
                return $totalFreightCost;
            } elseif ($customerTerms == '3rd Party Bill') {
                return '3rd-party';
            }
        }
    }

    public function getCarrierName($carrierCode)
    {
        if ($this->checkShippingCost() != NULL) {
            return 'Shipping Cost';
        }
        if ($this->checkShippingCost() == '3rd-party') {
            return 'Shipped by 3rd party';
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
        }
        if ($this->checkShippingCost() == '3rd-party') {
            $price = 0;
        }
        return $this->getQuote()->getStore()->convertPrice(Mage::helper('tax')->getShippingPrice($price, $flag, $this->getAddress()), true);
    }
}
