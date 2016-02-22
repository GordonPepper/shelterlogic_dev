<?php
/**
 * Created by PhpStorm.
 * User: hiephm
 * Date: 1/20/2016
 * Time: 3:50 PM
 */ 
class Shelterlogic_PaymentTerms_Model_Rewrite_Acimpro_PaymentMethod extends Aumd_Acimpro_Model_PaymentMethod
{
    protected $_infoBlockType = 'paymentterms/info_cc';

    public function assignData($data)
    {
        parent::assignData($data);

        $info = $this->getInfoInstance();
        // Must set into additional information since po_number is already be used by Acimpro for different purpose
        $info->setAdditionalInformation('po_number', $data->getPoNumber());

        return $this;
    }

}