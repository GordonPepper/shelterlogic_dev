<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 1/20/2016
 * Time: 4:11 PM
 */
class Shelterlogic_PaymentTerms_Block_Info_Cc extends Mage_Payment_Block_Info_Cc
{
    protected function _prepareSpecificInformation($transport = null)
    {
        $specificInfo = parent::_prepareSpecificInformation($transport);

        $data = array();

        if ($poNumber = $this->getInfo()->getAdditionalInformation('po_number')) {
            $data['Purchase Order Number'] = $poNumber;
        }

        return $specificInfo->setData(array_merge($specificInfo->getData(), $data));
    }
}