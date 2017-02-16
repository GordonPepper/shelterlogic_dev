<?php
class Aumd_Morecc_Block_Profiles extends Mage_Core_Block_Template
{
	
	 public function __construct()
    { 
        parent::__construct(); 
        $this->setTemplate('morecc/profiles.phtml');
 
        $profiles = Mage::getResourceModel('morecc/morecc_collection')
            ->addFieldToSelect('*')
			->addFieldToFilter('cus_id', Mage::getSingleton('customer/session')->getCustomer()->getId()) 
			->addFieldToFilter('number', array('neq' => "")) 
            ->setOrder('created_time', 'desc')
        ; 
 
        $this->setProfiles($profiles);

        Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('root')->setHeaderTitle(Mage::helper('morecc')->__('My Profile'));
    }

	public function getMonthFormat($monthNumber)
	{
		if($monthNumber == "")return;
		
		$months = Mage::app()->getLocale()->getTranslationList('month');
        foreach ($months as $key => $value) {
          
		  	if($monthNumber == $key)
			{
				$monthNum = ($key < 10) ? '0'.$key : $key;
				return $monthNum . ' - ' . $value;
			}
        }
 	}
	
    protected function _prepareLayout()
    {
		$this->getLayout()->getBlock('head')->setTitle('View My Profiles');
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'morecc.profiles.history.pager')
            ->setCollection($this->getProfiles());
        $this->setChild('pager', $pager);
        $this->getProfiles()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
	 
     public function getMorecc()     
     { 
        if (!$this->hasData('morecc')) {
            $this->setData('morecc', Mage::registry('morecc'));
        }
        return $this->getData('morecc');
        
    } 

}