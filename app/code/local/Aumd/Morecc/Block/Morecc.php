<?php 
class Aumd_Morecc_Block_Morecc extends Mage_Core_Block_Template
{
	public function _prepareLayout()
    {
		$this->getLayout()->getBlock('head')->setTitle('Add New Card');
		return parent::_prepareLayout();
    }
    
     public function getMorecc()     
     { 
        if (!$this->hasData('morecc')) {
            $this->setData('morecc', Mage::registry('morecc'));
        }
        return $this->getData('morecc');
        
    }
	
	public function getDefaultCountryId()
	{
		return 'US';
	}
	
	public function getRegionCollection($regionId='')
    {
        if (!$this->_regionCollection) {
		
			if(isset($regionId) && $regionId != "")
			{
				$countryId = $regionId;
			}
			else{$countryId = $this->getDefaultCountryId();}
			
            $this->_regionCollection = Mage::getModel('directory/region')->getResourceCollection()
                ->addCountryFilter($countryId)
                ->load();
        }
        return $this->_regionCollection;
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
	
	public function getCountryHtmlSelect($countryId='')
	{
		$type = 'bill';
		
		if(isset($countryId) && $countryId != "")
		{
			$countryId = $countryId;
		}else{
        	$countryId = Mage::helper('core')->getDefaultCountry();
		}
		
	   $select = $this->getLayout()->createBlock('core/html_select')
        ->setName($type.'[country_id]')
        ->setId($type.':country_id')
        ->setTitle(Mage::helper('checkout')->__('Country'))
        ->setClass('validate-select')
        ->setValue($countryId)
        ->setOptions($this->getCountryOptions());
		
		return $select->getHtml();
	}
	
	public function getUsername($storeId=0) {
	
		return Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
	}
	public function getPassword($storeId=0) {
		return Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);
	}
	
	public function parseXML($start, $end, $xml)	 {
		//return preg_replace('|^.*?'.$start.'(.*?)'.$end.'.*?$|i', '$1', substr($xml, 335));
		  $result = "";
		  
		  if($start == "<company>" || $start == "<phonenumber>"  || $start == "<faxnumber>" ) // this are nore not required field so will not parse xml and return null if no data
		  {
		  	$result = "";
		  }
                $matches = array();
                if(preg_match('|'.$start.'(.*?)'.$end.'|i', $xml, $matches))
                        $result = $matches[1];
                $start.$result.$end."<br/>";
                return $result;
	}
	public function getPaymentProfileAction($customerProfileId, $customerPayprofileId)
	{
			$storeId = 0;
			
			/*Create XML data Object*/
			$xmlDataObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><getCustomerPaymentProfileRequest/>');
			$xmlDataObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlDataObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			$profile = $xmlDataObj->addChild('customerProfileId', $customerProfileId);
			$customerPaymentProfile = $xmlDataObj->addChild('customerPaymentProfileId', $customerPayprofileId);
			
			$custProfileXMLData = $xmlDataObj->asXML();
			$url = $this->getGatewayUrl();
			$responseFromGateway = $this->processRequest($url, $custProfileXMLData);
			 
			 $resFrmGatewayErrorCode = $this->parseXML('<messages>','</messages>',$responseFromGateway);
			  
			 
			$resFrmGatewayErrorCode = $this->parseXML('<code>','</code>',$responseFromGateway);
			
			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$responseFromGateway);
			$code = $this->parseXML('<code>','</code>',$responseFromGateway);
			$message = $this->parseXML('<text>','</text>',$responseFromGateway);
			
			 
			/*if the transaction is successfulyl approved then set payment status*/
			if ($resultCode == "Ok" && $code == 'I00001')
			{
				/* If there is an error processing the credit card */
				if($code == "I00001")
				{
					return $responseFromGateway;
				}
			}
			else
			{
				//echo $message;die;
				if($resultCode == "Error")
				{
					if($code == "E00039")
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						//$this->_redirect('*/*/');
						return;
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						//$this->_redirect('*/*/');
						return;
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					//$this->_redirect('*/*/');
					return;
				}
			}
 	}
	
	public function getCustomerProfile($customerProfileId, $storeId=0)
	{
			$storeId = 0;
			
				$xmlDataObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><getCustomerProfileRequest/>');
			$xmlDataObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlDataObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			$profile = $xmlDataObj->addChild('customerProfileId', $customerProfileId);
			$custProfileXMLData = $xmlDataObj->asXML();
			
			$url = $this->getGatewayUrl();
			$responseFromGateway = $this->processRequest($url, $custProfileXMLData);
		//	 echo '<pre>';print_r($responseFromGateway);die;
			$responseFromGatewayBillto = $this->parseXML('<billto>','</billto>',$responseFromGateway);
			  
			
			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$responseFromGateway);
			$code = $this->parseXML('<code>','</code>',$responseFromGateway);
			$message = $this->parseXML('<text>','</text>',$responseFromGateway);
			/*if the transaction is successfulyl approved then set payment status*/
			if ($resultCode == "Ok" && $code == 'I00001')
			{
				/* If there is an error processing the credit card */
				if($code == "I00001")
				{
					return $responseFromGateway;
				}
			}
			else
			{
				//echo $message;die;
				if($resultCode == "Error")
				{
					if($code == "E00039")
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						//$this->_redirect('*/*/');
						return;
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						//$this->_redirect('*/*/');
						return;
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					//$this->_redirect('*/*/');
					return;
				}
			}
	}
	public function getCustomerProfileXML($custProfile, $storeId=0) {
			
			/*Create XML data Object*/
			$xmlDataObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><getCustomerProfileRequest/>');
			$xmlDataObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlDataObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			$profile = $xmlDataObj->addChild('customerProfileId', $custProfile);
			$custProfileXMLData = $xmlDataObj->asXML();
			
			return $custProfileXMLData;
		}
		
	
	public function getGatewayUrl() {
		if(Mage::getStoreConfig('payment/acimpro/checkout_mode'))
		{
			return 'https://api.authorize.net/xml/v1/request.api';
			
		}
		else
		{
			return 'https://apitest.authorize.net/xml/v1/request.api';
		}
	}
	
	public function processRequest($url, $xml)	{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, Array('Content-Type: text/xml'));
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			$response = curl_exec($ch);
			curl_close ($ch);
					
		 if($this->getDebug()) {
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("XML Sent: $xml");
				$logger->info("XML Received: $response");
		   }
					
			return $response;
		}
	
	public function getCcActiveTypes()
    {
        $_types = Mage::getConfig()->getNode('global/payment/cc/types')->asArray();
		
        $types = array();
        foreach ($_types as $data) {
            if (isset($data['code']) && isset($data['name'])) {
                $types[$data['code']] = $data['name'];
            }
        }

		$availTypes = Mage::getConfig()->getNode('default/payment/acimpro/cctypes')->asArray();
		$availTypes = explode( ',', $availTypes);
    	foreach( $types as $c => $n ) {
    		if( !in_array($c, $availTypes) ) {
    			unset($types[$c]);
    		}
    	}
		return $types;
    }
	
	
    public function getCcMonths()
    {
        $months = Mage::app()->getLocale()->getTranslationList('month');
        foreach ($months as $key => $value) {
            $monthNum = ($key < 10) ? '0'.$key : $key;
            $months[$key] = $monthNum . ' - ' . $value;
        }
        return $months;
    }

	public function getCcYears()
	{
        $first = date("Y");
        for ($index=0; $index <= 10; $index++) {
            $year = $first + $index;
            $years[$year] = $year;
        }
        return $years;
    }	
}