<?php
class Aumd_Acimpro_Block_Form extends Mage_Payment_Block_Form_Cc
{
	protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('morecc/cc.phtml');
    }
 
	 /**
     * Retrive has verification configuration
     *
     * @return boolean
     */
	//if(!Mage::getStoreConfig('payment/acimpro/use_cvv')){return false;}else{return true;}
    public function hasVerification()
    {
		//return false;
        if ($this->getMethod()) {
            $configData = $this->getMethod()->getConfigData('useccv');
            if(is_null($configData)){
                return true;
            }
            return (bool) $configData;
        }
        return true;
    }
}