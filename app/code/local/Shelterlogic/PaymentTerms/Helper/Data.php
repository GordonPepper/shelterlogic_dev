<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 1/20/2016
 * Time: 11:11 AM
 */ 
class Shelterlogic_PaymentTerms_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_PAYMENT_TERM_NET             = 'shelterlogic/payment_terms/net';
    const XML_PATH_PAYMENT_TERM_CREDITCARD      = 'shelterlogic/payment_terms/creditcard';

    public function isNetTerm($termId)
    {
        return $this->checkTerm($termId, Mage::getStoreConfig(self::XML_PATH_PAYMENT_TERM_NET));
    }

    public function isCreditCardTerm($termId)
    {
        return $this->checkTerm($termId, Mage::getStoreConfig(self::XML_PATH_PAYMENT_TERM_CREDITCARD));
    }

    protected function checkTerm($termId, $termList)
    {
        if (!$termId) return false;

        $terms = trim($termList);
        if ($terms) {
            $terms = explode("\n", $terms);
            foreach ($terms as &$term) {
                $term = strtolower(trim($term));
            }
            return in_array(strtolower(trim($termId)), $terms);
        }

        return false;
    }
}