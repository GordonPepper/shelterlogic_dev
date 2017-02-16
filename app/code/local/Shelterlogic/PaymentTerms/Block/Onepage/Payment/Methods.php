<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 1/20/2016
 * Time: 12:03 PM
 */
class Shelterlogic_PaymentTerms_Block_Onepage_Payment_Methods extends Mage_Checkout_Block_Onepage_Payment_Methods
{
    /**
     * @param Mage_Payment_Model_Method_Abstract $method
     * @return bool|Mage_Payment_Model_Method_Abstract
     */
    protected function _canUseMethod($method)
    {
        $result = parent::_canUseMethod($method);
        $customer = $this->getQuote()->getCustomer();
        $helper = Mage::helper('paymentterms');
        if ($customer->getId() && $helper->isNetTerm($customer->getTermsId())) {
            // Allow PO payment method only for NET term customers
            return $result && ('purchaseorder' == $method->getCode());
        }

        // Disable PO payment method for all other customers
        return $result && ('purchaseorder' != $method->getCode());
    }
}