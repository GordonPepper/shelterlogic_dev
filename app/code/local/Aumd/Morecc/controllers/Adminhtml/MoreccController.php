<?php

class Aumd_Morecc_Adminhtml_MoreccController extends Mage_Adminhtml_Controller_action
{

  public function getFormActionUrl()
    {
        return $this->getUrl('*/*/save');
    }
	
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('morecc/items')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}   
 
	public function indexAction() {
		$this->_initAction()
			->renderLayout();
	}
	
	
	
	public function createCustomerProfileAction()
	{
		 $post = $this->getRequest()->getPost();	
//	echo '<pre>';print_r($post);die;	 
 		 $url = Mage::helper('adminhtml')->getUrl("adminhtml/customer/edit/id/".$post['customer_id']."/key/".$post['form_key1']);
		 $explode = explode("key",$url);
		 $explode[1] = $post['form_key1'];
		 $finalUrl = implode("key/",$explode);
		 $finalUrl = $finalUrl . '/cardup/1';

        if ( $post ) {			
			//echo '<pre>';print_r($post);die;
			
			$postObject = new Varien_Object();
			$postObject->setData($post);
	
 			if(Mage::getStoreConfig('payment/acimpro/checkout_mode'))
			{
				$url = 'https://api.authorize.net/xml/v1/request.api';			
			}
			else
			{
				$url = 'https://apitest.authorize.net/xml/v1/request.api';
			}
			
			$storeId = Mage::app()->getStore()->getId();
			$userName = Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
			$password = Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);
			
			$xmlObj = new SimpleXMLElement('<?xml version ="1.0" encoding = "utf-8"?><createCustomerProfileRequest/>');
			$xmlObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $userName));
			$authSeller->addChild('transactionKey', htmlentities( $password ));
			
			/* Add Profile methods to XML*/
			
			$isAdmin = $post['admin_data'] ;
			if($isAdmin == 1 )
			{
				$customerId = $post['customer_id'] ;
				$customerData = Mage::getModel('customer/customer')->load($customerId)->getData();
				$customerEmail	= trim($customerData['email']) ;
				
			}else{
				$customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
				$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
				$customerEmail = trim($customerEmail); 
			}
			
	$resource = Mage::getSingleton('core/resource');
	$read= $resource->getConnection('core_read');
	$moreccTable = $resource->getTableName('morecc');

	/*$select = $read->select()
	->from($moreccTable,array('morecc_id','email','number','profile_id','pay_id'))
	->where('email=?',$customerEmail) ;*/
	
	$select  = "Select * from ".$moreccTable." where cus_id='".$customerId."'";
	$morecc = $read->fetchRow($select); 

	if(isset($morecc) && $morecc != "") // check if customer profile is already exist, if yes then we need to create only payment profile.
	{
		//echo 'if';die;
		$custProfile = $morecc['profile_id'];
		$ccNumber = $post['payment']['cc_number'];
		$cardType  = $post['payment']['cc_type'];
		
		$ccEXPYear = $post['payment']['cc_exp_year'];
		$ccEXPMonth = $post['payment']['cc_exp_month'];
		
		$ccEXPDate = $post['payment']['cc_exp_year'].'-'. str_pad($post['payment']['cc_exp_month'], 2, '0', STR_PAD_LEFT);
		$cvv = '';
		if(isset($post['payment']['cc_cid']) && $post['payment']['cc_cid'] != "")
		{
			$cvv =  $post['payment']['cc_cid'];
		}
		
		$payXml = $this->createCutomerPaymentProfileXML($custProfile, $ccNumber, $ccEXPDate, $post, $cvv, $storeId=0);
		$newCard = "XXXX-XXXX-XXXX-" . substr($post['payment']['cc_number'],-4,4);
		
		$transXMLResponse = $this->processRequest($url, $payXml);

			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$transXMLResponse);
			$code = $this->parseXML('<code>','</code>',$transXMLResponse);
			$message = $this->parseXML('<text>','</text>',$transXMLResponse);
			
			/*if the transaction is successfulyl approved then set payment status*/
			if ($resultCode == "Ok" && $code == 'I00001')
			{
				/* If there is an error processing the credit card */
				if($code == "I00001")
				{
					$customerPaymentProfileId = $this->parseXML('<customerPaymentProfileId>','</customerPaymentProfileId>',$transXMLResponse);
					$customerPayProfileId = $this->parseXML('<numericString>','</numericString>',$transXMLResponse);
					$name = $post['first_name'] .' '.$post['last_name'] ;  
					$model = Mage::getModel('morecc/morecc');
					$model->setCreatedTime(now());
					$model->setEmail($customerEmail);
					$model->setCusId($customerId);
					$model->setName($name);
					$model->setNumber($newCard);
					$model->setCardType($cardType);
					$model->setExprMonth($ccEXPMonth);
					$model->setExprYear($ccEXPYear);
					$model->setProfileId($custProfile);
					$model->setPayId($customerPaymentProfileId);
					$model->save();

					if($isAdmin == 1 )
					{
						Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('New payment profile(card) has successfully added.'));
						Mage::app()->getResponse()->setRedirect($finalUrl);
						//$this->_redirect('adminhtml/customer/edit/', array('id' => $customer_id));	
						return;
										 
					}else{
						Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('New payment profile(card) has successfully added.'));
						 $this->_redirect('*/*/');
						 return;
					}

				}
			}
			else
			{
				//echo $message;die;
				if($resultCode == "Error")
				{
					if($code == "E00039")
					{
						if($isAdmin == 1 )
						{
							Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__($message));
							Mage::app()->getResponse()->setRedirect($finalUrl);
							//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
							return;
											 
						}else{
						
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message));
							$this->_redirect('*/*/');
							return;
						}
					}
					else
					{
						if($isAdmin == 1 )
						{
							Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__($message));
							Mage::app()->getResponse()->setRedirect($finalUrl);
							//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
							return;
											 
						}else{
						
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
							$this->_redirect('*/*/');
							return;
						}
					}
				}
				else
				{
					if($isAdmin == 1 )
					{
						Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__($message));
						Mage::app()->getResponse()->setRedirect($finalUrl);
						//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
						return;
										 
					}else{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						$this->_redirect('*/*/');
						return;
					}
				}
			}
	}
	else
	{
			$profile = $xmlObj->addChild('profile');
			$profile->addChild('merchantCustomerId', $customerId);
			$profile->addChild('email', $customerEmail);
			
			/* Add Payment Profile methods to XML*/
			$paymentProfile = $profile->addChild('paymentProfiles');
			
			/* Add customer Billing methods to XML*/
			$custBillingObj = $paymentProfile->addChild('billTo');
			$custBillingObj->addChild('firstName',$post['first_name']);
			$custBillingObj->addChild('lastName',$post['last_name']);
			if(!empty($post['company'])){
				$custBillingObj->addChild('company',htmlentities($post['company']));
			} else { $custBillingObj->addChild('company',""); }
			$custBillingObj->addChild('address',$post['address']);
			$custBillingObj->addChild('city',$post['city']);
			
			if(isset($post['region']) && $post['region'] != "")
			{
				$region = $post['region'];
			}
			else if(isset($post['region_id']) && $post['region_id'] != "")
			{
				$region = $post['region_id'];
			}
			
			$custBillingObj->addChild('state',$region);
			$custBillingObj->addChild('zip',$post['zip']);
			$custBillingObj->addChild('country',$post['bill']['country_id']);
			
			if(!empty($post['telephone'])){
			$custBillingObj->addChild('phoneNumber',$post['telephone']);
			} else { $custBillingObj->addChild('phoneNumber',""); }
			
			if(!empty($post['fax'])){
				$custBillingObj->addChild('faxNumber',htmlentities($post['fax']));
			} else { $custBillingObj->addChild('faxNumber',""); }
			
			/* Add Payment Profile Payment(CC Details) methods to XML*/
			$PaymentObj = $paymentProfile->addChild('payment');
			$ccNumber = $post['payment']['cc_number'];
			
			$ccEXPYear = $post['payment']['cc_exp_year'];
			$ccEXPMonth = $post['payment']['cc_exp_month'];
		
			//$ccEXPDate = $post['payment']['cc_exp_year'].'-'.$post['payment']['cc_exp_month'];
			$ccEXPDate = $post['payment']['cc_exp_year'].'-'. str_pad($post['payment']['cc_exp_month'], 2, '0', STR_PAD_LEFT);
			
			$cvv =  '';
			if(isset($post['payment']['cc_cid']) && $post['payment']['cc_cid'] != "")
			{
				$cvv =  $post['payment']['cc_cid'];
			}
			
			$CC = $PaymentObj->addChild('creditCard');
			$CC->addChild('cardNumber', htmlentities($ccNumber));
			$CC->addChild('expirationDate', $ccEXPDate);
			if($cvv) {$CC->addChild('cardCode', $cvv); }
			$customerProfileXMLData = $xmlObj->asXML();
			
			$transXMLResponse = $this->processRequest($url, $customerProfileXMLData);
			
			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$transXMLResponse);
			$code = $this->parseXML('<code>','</code>',$transXMLResponse);
			$message = $this->parseXML('<text>','</text>',$transXMLResponse);
			
			/*if the transaction is successfulyl approved then set payment status*/
			if ($resultCode == "Ok" && $code == 'I00001')
			{
				/* If there is an error processing the credit card */
				if($code == "I00001")
				{
					$customerProfileId = $this->parseXML('<customerProfileId>','</customerProfileId>',$transXMLResponse);
					$customerPayProfileId = $this->parseXML('<numericString>','</numericString>',$transXMLResponse);
					
					$name = $post['first_name'] .' '.$post['last_name'] ; 
					$newCard = "XXXX-XXXX-XXXX-" . substr($post['payment']['cc_number'],-4,4);
					$cardType  = $post['payment']['cc_type'];
					
					$model = Mage::getModel('morecc/morecc');
					$model->setCreatedTime(now());
					$model->setEmail($customerEmail);
					$model->setCusId($customerId);
					$model->setName($name);
					$model->setNumber($newCard);
					$model->setCardType($cardType);
					$model->setExprMonth($ccEXPMonth);
					$model->setExprYear($ccEXPYear);
					$model->setProfileId($customerProfileId);
					$model->setPayId($customerPayProfileId);
					
					$model->save();
					
					if($isAdmin == 1 )
					{
						Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('Your CIM profile has successfully created.'));
						Mage::app()->getResponse()->setRedirect($finalUrl);
						//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
						return;
					}else{					 
					
						 Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('Your CIM profile has successfully created.'));
						 $this->_redirect('*/*/');
						 return;
					}
				}
			}
			else
			{
				//echo $message;die;
				if($resultCode == "Error")
				{
					if($isAdmin == 1 ) /* If form isposted from admin starts*/
					{
						
						if($code == "E00039")
						{
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message));
							Mage::app()->getResponse()->setRedirect($finalUrl);
							//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
							return;
						}
						else
						{
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message . ' There is error in processing your request.'));
							Mage::app()->getResponse()->setRedirect($finalUrl);
							//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
							return;
						}
						 
						
						
					}else{	/* If form isposted from admin ends*/
					
						if($code == "E00039")
						{
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message));
							$this->_redirect('*/*/');
							return;
						}
						else
						{
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message . ' There is error in processing your request.'));
							$this->_redirect('*/*/');
							return;
						}
					}
				}
				else
				{
					if($isAdmin == 1 ) /* If form isposted from admin starts*/
					{
							Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message . ' There is error in processing your request.'));
							Mage::app()->getResponse()->setRedirect($finalUrl);
							//$this->_redirect('admin/customer_edit', array('id' => $customer_id));	
							return;
							
					}else{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message. ' There is error in processing your request.'));
						$this->_redirect('*/*/');
						return;
					}
				}
			}
			
		//	echo '<pre>';print_r($transXMLResponse);die;
			
			return $customerProfileXMLData;
		
		}
	}
 }
	
	public function createCutomerPaymentProfileXML($custProfile, $ccNumber, $ccEXPDate, $custBilling, $cvv, $storeId=0) {
		$custPayProXMLObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><createCustomerPaymentProfileRequest/>');
		$custPayProXMLObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
		
		/* Add Authenticate methods to XML*/
		
		$storeId = Mage::app()->getStore()->getId();
		$userName = Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
		$password = Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);

		$authSeller = $custPayProXMLObj->addChild('merchantAuthentication');
		$authSeller->addChild('name', htmlentities( $userName));
		$authSeller->addChild('transactionKey', htmlentities( $password ));
		
		/* Add Profile methods to XML*/
		$profile = $custPayProXMLObj->addChild('customerProfileId', $custProfile);
		$paymentProfile = $custPayProXMLObj->addChild('paymentProfile');
		
		/* Add customer Billing methods to XML*/
		$custBillingObj = $paymentProfile->addChild('billTo');
		$custBillingObj->addChild('firstName',$custBilling['first_name']);
		$custBillingObj->addChild('lastName',$custBilling['last_name']);
		if(!empty($custBilling['company'])){
				$custBillingObj->addChild('company',htmlentities($custBilling['company']));
			} else { $custBillingObj->addChild('company',""); }
		
		$custBillingObj->addChild('address',$custBilling['address']);
		$custBillingObj->addChild('city',$custBilling['city']);
		
		if(isset($custBilling['region']) && $custBilling['region'] != "")
		{
			$region = $custBilling['region'];
		}
		else if(isset($custBilling['region_id']) && $custBilling['region_id'] != "")
		{
			$region = $custBilling['region_id'];
		}
			
		$custBillingObj->addChild('state',$region);
		$custBillingObj->addChild('zip',$custBilling['zip']);
		$custBillingObj->addChild('country',$custBilling['bill']['country_id']);
		
		if(!empty($custBilling['telephone'])){
				$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			} else {$custBillingObj->addChild('phoneNumber','');}

		
		if(!empty($custBilling['fax'])){
			$custBillingObj->addChild('faxNumber',htmlentities($custBilling['fax']));
        } else { $custBillingObj->addChild('faxNumber',""); }
		
		/* Add Payment Profile Payment(CC Details) methods to XML*/
		$payment = $paymentProfile->addChild('payment');
		$credit = $payment->addChild('creditCard');
		$credit->addChild('cardNumber', $ccNumber);
		$credit->addChild('expirationDate', $ccEXPDate);
		if($cvv) {$credit->addChild('cardCode', $cvv); }
		$customerPaymentXMLData = $custPayProXMLObj->asXML();
		return $customerPaymentXMLData;
	}
	
	public function parseXML($start, $end, $xml)	 {
		//return preg_replace('|^.*?'.$start.'(.*?)'.$end.'.*?$|i', '$1', substr($xml, 335));
		  $result = "";
                $matches = array();
                if(preg_match('|'.$start.'(.*?)'.$end.'|i', $xml, $matches))
                        $result = $matches[1];
                $start.$result.$end."<br/>";
                return $result;
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
	      		 
	      		
	    return $response;
	}
	
	public function updatePaymentProfileAction()
	{
		$this->updateCustomerPaymentProfileXML();
	}
	
	public function updateCustomerPaymentProfileXML($CustProfile, $PayProfile, $ccNumber, $ccEXPDate, $custBilling, $cvv, $storeId=0) 
	{
			/* Create XML Object*/
			$custUpdatePayXMLObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><updateCustomerPaymentProfileRequest/>');
			$custUpdatePayXMLObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $custUpdatePayXMLObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			/* Add Profile methods to XML*/
			$profile = $custUpdatePayXMLObj->addChild('customerProfileId', $CustProfile);
			$paymentProfile = $custUpdatePayXMLObj->addChild('paymentProfile');
			
			/* Add customer Billing methods to XML*/
			$custBillingObj = $paymentProfile->addChild('billTo');
			$custBillingObj->addChild('firstName',$custBilling['firstname']);
			$custBillingObj->addChild('lastName',$custBilling['lastname']);
			if(!empty($custBilling['company'])){
				$custBillingObj->addChild('company',htmlentities($custBilling['company']));
			} else { $custBillingObj->addChild('company',""); }
			
			$custBillingObj->addChild('address',$custBilling->getStreet(1)." ".$custBilling->getStreet(2));
			$custBillingObj->addChild('city',$custBilling['city']);
			$custBillingObj->addChild('state',$custBilling['region']);
			$custBillingObj->addChild('zip',$custBilling['postcode']);
			$custBillingObj->addChild('country',$custBilling['country_id']);
			
			if(!empty($custBilling['telephone'])){
			$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			} else { $custBillingObj->addChild('phoneNumber',""); }
			
			if(!empty($custBilling['fax'])){
				$custBillingObj->addChild('faxNumber',$custBilling['fax']);
			} else { $custBillingObj->addChild('faxNumber',""); }
			
			/* Add Payment Profile Payment(CC Details) methods to XML*/
			$payment = $paymentProfile->addChild('payment');
			$creditCard = $payment->addChild('creditCard');
			$creditCard->addChild('cardNumber', $ccNumber);
			$creditCard->addChild('expirationDate', $ccEXPDate);
			if($cvv) {$creditCard->addChild('cardCode', $cvv); }
			$pay2 = $paymentProfile->addChild('customerPaymentProfileId', $PayProfile);
			$CustPaymentXML = $custUpdatePayXMLObj->asXML();
			return $CustPaymentXML;
	}
	
	public function editAction() {
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('morecc/morecc')->load($id);

		if ($model->getId() || $id == 0) {
			$data = Mage::getSingleton('adminhtml/session')->getFormData(true);
			if (!empty($data)) {
				$model->setData($data);
			}

			Mage::register('morecc_data', $model);

			$this->loadLayout();
			$this->_setActiveMenu('morecc/items');

			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
			$this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));

			$this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

			$this->_addContent($this->getLayout()->createBlock('morecc/adminhtml_morecc_edit'))
				->_addLeft($this->getLayout()->createBlock('morecc/adminhtml_morecc_edit_tabs'));

			$this->renderLayout();
		} else {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('morecc')->__('Item does not exist'));
			$this->_redirect('*/*/');
		}
	}
 
	public function newAction() {
		$this->_forward('edit');
	}
	
	public function deletePaymentProfileAction()
	{
		$post = $this->getRequest()->getPost();
        if ( $post) {
		 
	//	echo '<pre>';print_r($post);die;
			if(Mage::getStoreConfig('payment/acimpro/checkout_mode'))
			{
				$url = 'https://api.authorize.net/xml/v1/request.api';
 			}
			else
			{
				$url = 'https://apitest.authorize.net/xml/v1/request.api';
			}
			
			$storeId = Mage::app()->getStore()->getId();
			$userName = Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
			$password = Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);
			 
			$xmlObj = new SimpleXMLElement('<?xml version ="1.0" encoding = "utf-8"?><deleteCustomerPaymentProfileRequest/>');
			$xmlObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $userName));
			$authSeller->addChild('transactionKey', htmlentities( $password ));
			/* Add Profile methods to XML*/
			
			$profile = $xmlObj->addChild('customerProfileId', $post['profile_id']); 
					   $xmlObj->addChild('customerPaymentProfileId', $post['payment_id']);
					   
			$deleteProfileXML = $xmlObj->asXML();
			//echo '<pre>';print_r($deleteProfileXML);die;
			$transXMLResponse = $this->processRequest($url, $deleteProfileXML);
		
			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$transXMLResponse);
			$code = $this->parseXML('<code>','</code>',$transXMLResponse);
			$message = $this->parseXML('<text>','</text>',$transXMLResponse);
			
			/*if the transaction is successfulyl approved then set payment status*/
			if ($resultCode == "Ok" && $code == 'I00001')
			{
				/* If there is an error processing the credit card */
				if($code == "I00001")
				{ 					
					$id = $post['record_id'];
					$model  = Mage::getModel('morecc/morecc')->load($id);
					$model->delete();
					 
					Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('Payment profile(card) has successfully deleted.'));
					//Mage::app()->getResponse()->setRedirect($finalUrl);
					//return;
				}
			}
			else
			{
				//echo $message;die;
				if($resultCode == "Error")
				{
					if($code == "E00039")
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message));
						//Mage::app()->getResponse()->setRedirect($finalUrl);
						//return;
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						//Mage::app()->getResponse()->setRedirect($finalUrl);
						//return;
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					//Mage::app()->getResponse()->setRedirect($finalUrl);
					//return;
				}
			}
		
		}
		 
	}
}