<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 1/21/16
 * Time: 4:20 AM
 */ 
class Americaneagle_Visual_Helper_Rewrite_AvaTax_Data extends OnePica_AvaTax_Helper_Data
{
    protected $_cachedResult = array();

    public function isAddressActionable($address, $storeId, $filterMode = OnePica_AvaTax_Model_Config::REGIONFILTER_ALL,
                                        $isAddressValidation = false
    )
    {
        $isExempt = false;
        $customerId = $address->getCustomerId();
        if ($customerId) {
            if (!isset($this->_cachedResult[$customerId])) {
                $customer = Mage::getModel('customer/customer')->load($customerId);
                $this->_cachedResult[$customerId] = ($customer->getId() && $customer->getTaxExempt());
            }

            $isExempt = $this->_cachedResult[$customerId];
        }

        return !$isExempt && parent::isAddressActionable($address, $storeId, $filterMode, $isAddressValidation);
    }

}