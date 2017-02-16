<?php

class Aumd_Acimpro_Block_Adminhtml_Customer_Edit_Tab_Customercard extends Mage_Adminhtml_Block_Template {

    protected function _construct() {
        parent::_construct();
        $this->setTemplate('morecc/customer/tab/cardform.phtml');
    }

 	public function getFormActionUrl()
    {
        return $this->getUrl('acimpro/aumd/save');
    }
	
    /**
     * Returns the registry customer.
     * 
     * @return Mage_Customer_Model_Customer
     */
    public function getCustomer() {
        return Mage::registry('current_customer');
    }

	public function getCountryCollection()
    {
        if (!$this->_countryCollection) {
            $this->_countryCollection = Mage::getSingleton('directory/country')->getResourceCollection()
                ->loadByStore();
        }
        return $this->_countryCollection;
    }
	
 
	
	public function getCountryOptions()
    {
        $options    = false;
        $useCache   = Mage::app()->useCache('config');
        if ($useCache) {
            $cacheId    = 'DIRECTORY_COUNTRY_SELECT_STORE_' . Mage::app()->getStore()->getCode();
            $cacheTags  = array('config');
            if ($optionsCache = Mage::app()->loadCache($cacheId)) {
                $options = unserialize($optionsCache);
            }
        }

        if ($options == false) {
            $options = $this->getCountryCollection()->toOptionArray();
            if ($useCache) {
                Mage::app()->saveCache(serialize($options), $cacheId, $cacheTags);
            }
        }
        return $options;
    }
	
	public function getCountryHtmlSelect()
	{
		$type = 'bill';
		 
        $countryId = Mage::helper('core')->getDefaultCountry();
		
	   $select = $this->getLayout()->createBlock('core/html_select')
        ->setName($type.'[country_id]')
        ->setId($type.':country_id')
        ->setTitle(Mage::helper('checkout')->__('Country'))
        ->setClass('validate-select')
        ->setValue($countryId)
        ->setOptions($this->getCountryOptions());
		
		return $select->getHtml();
	}
   
	public function getMessage()
	{
		$messages = Mage::getSingleton('adminhtml/session')->getMessages(true);	

		echo '<pre>';print_r($_SESSION);
		die;
		return Mage::getSingleton('core/session')->getMyValue();
		return 'fine';
	}
}
