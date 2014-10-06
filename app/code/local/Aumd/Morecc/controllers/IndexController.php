<?php
class Aumd_Morecc_IndexController extends Mage_Core_Controller_Front_Action
{
    const XML_PATH_EMAIL_RECIPIENT  = 'payment/generalset/query_email';
    const XML_PATH_EMAIL_SENDER     = 'payment/generalset/identity';
    const XML_PATH_EMAIL_TEMPLATE   = 'payment/generalset/template';

    public function indexAction()
    {
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }		
		$this->loadLayout();

		$navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('morecc/index/profiles/');
        }
 
		$this->getLayout()->getBlock('head')->setTitle($this->__('Add New Card'));    
		$this->renderLayout();
    }
	
	public function editAction()
	{
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('morecc/morecc')->load($id);
		
		$this->loadLayout();    

		$navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('morecc/index/profiles/');
        }
 
		$this->getLayout()->getBlock('head')->setTitle($this->__('Edit My Payment Profile'));
		$this->renderLayout();
	}
	
	public function viewblocksAction()
	{
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$this->loadLayout();    

		$navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('morecc/index/profiles/');
        }
 
		$this->getLayout()->getBlock('head')->setTitle($this->__('My Cards History'));
		$this->renderLayout();
	}
	public function viewAction()
	{
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$id     = $this->getRequest()->getParam('id');
		$model  = Mage::getModel('morecc/morecc')->load($id);
		
		$this->loadLayout();    
		
		$navigationBlock = $this->getLayout()->getBlock('customer_account_navigation');
        if ($navigationBlock) {
            $navigationBlock->setActive('morecc/index/profiles/');
        }
 
		$this->getLayout()->getBlock('head')->setTitle($this->__('View My Payment Profile'));
		$this->renderLayout();
	}
	
	public function profilesAction()
	{
		
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }

		$this->loadLayout();    
		$this->getLayout()->getBlock('head')->setTitle($this->__('Manage My Cards'));
		$this->renderLayout();
	}
	
	public function createCustomerProfileAction()
	{
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$post = $this->getRequest()->getPost();
        if ( $post ) {

			$postObject = new Varien_Object();
			$postObject->setData($post);
			
			//$url = 'https://apitest.authorize.net/xml/v1/request.api';
			
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
			
			$customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
			$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
			$customerEmail = trim($customerEmail); 

			$resource = Mage::getSingleton('core/resource');
			$read= $resource->getConnection('core_read');
			$moreccTable = $resource->getTableName('morecc');

			$select  = "Select * from ".$moreccTable." where cus_id='".$customerId."'";		
			$morecc = $read->fetchRow($select); 
	 
	if(isset($morecc) && $morecc != "")
	{
		$cvv = '';
		$custProfile = $morecc['profile_id'];
		$ccNumber = $post['payment']['cc_number'];
		$cardType  = $post['payment']['cc_type'];
		
		$ccEXPYear = $post['payment']['cc_exp_year'];
		$ccEXPMonth = $post['payment']['cc_exp_month'];
		
		$ccEXPDate = $post['payment']['cc_exp_year'].'-'. str_pad($post['payment']['cc_exp_month'], 2, '0', STR_PAD_LEFT);
		if(isset($post['payment']['cc_cid']) && $post['payment']['cc_cid'] != "")
		{
			$cvv =  $post['payment']['cc_cid'];
		}
		$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
		
		$payXml = $this->createCutomerPaymentProfileXML($custProfile, $ccNumber, $ccEXPDate, $post, $cvv, $storeId=0);
		$newCard = "XXXX-XXXX-XXXX-" . substr($post['payment']['cc_number'],-4,4);
	
		$transXMLResponse = $this->processRequest($url, $payXml);
		
		//echo '<pre>';print_r($transXMLResponse);die;
		
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

					Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('New payment profile(card) has successfully added.'));
					  Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					 
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
						 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles", array('_secure'=>true)));
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
			} else { $custBillingObj->addChild('company',"company"); }
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
			$custBillingObj->addChild('phoneNumber',$post['telephone']);
			
			if(!empty($post['fax'])){
				$custBillingObj->addChild('faxNumber',htmlentities($post['fax']));
			} else { $custBillingObj->addChild('faxNumber',"fax"); }
			
			/* Add Payment Profile Payment(CC Details) methods to XML*/
			$PaymentObj = $paymentProfile->addChild('payment');
			$ccNumber = $post['payment']['cc_number'];
			
			$ccEXPYear = $post['payment']['cc_exp_year'];
			$ccEXPMonth = $post['payment']['cc_exp_month'];
		
			//$ccEXPDate = $post['payment']['cc_exp_year'].'-'.$post['payment']['cc_exp_month'];
			$ccEXPDate = $post['payment']['cc_exp_year'].'-'. str_pad($post['payment']['cc_exp_month'], 2, '0', STR_PAD_LEFT);
			$cvv = '';
			if(isset($post['payment']['cc_cid']) && $post['payment']['cc_cid'] != "")
			{
				$cvv =  $post['payment']['cc_cid'];
			}
			
			$CC = $PaymentObj->addChild('creditCard');
			$CC->addChild('cardNumber', htmlentities($ccNumber));
			$CC->addChild('expirationDate', $ccEXPDate);
			if($cvv) {$CC->addChild('cardCode', $cvv); }
			$customerProfileXMLData = $xmlObj->asXML();
			
			//echo '<pre>';print_r($customerProfileXMLData);die;
			
			
			
			$transXMLResponse = $this->processRequest($url, $customerProfileXMLData);
		//	echo '<pre>';print_r($transXMLResponse);die;
			
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
					
					 Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('Your CIM profile has successfully created.'));
					  Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
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
						 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message . ' There is error in processing your request.'));
						 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message. ' There is error in processing your request.'));
					 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
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
		//$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
		
		if(!empty($custBilling['telephone'])){
			$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
		}else{$custBillingObj->addChild('phoneNumber','');}
			
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
	
	public function parseXML($start, $end, $xml){
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
	
	public function getUsername($storeId=0) {
	
		return Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
	}
	public function getPassword($storeId=0) {
		return Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);
	}
	
	public function deletePaymentProfileAction()
	{
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$post = $this->getRequest()->getPost();
        if ( $post ) {
		 
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
					 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
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
						Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					//	return;
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
						//return;
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					//return;
				}
			}
		
		}
		 
	}
	 
	public function askQueryAction()
	{
		if(! Mage::helper('customer')->isLoggedIn()){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$response=array();$response['success'] = true;
    	try
		{
			$customer = Mage::getModel("customer/customer");	
			$post = $this->getRequest()->getPost();
			
			if($post)
			{
				 $translate = Mage::getSingleton('core/translate');
				/* @var $translate Mage_Core_Model_Translate */
				$translate->setTranslateInline(false);
				
				if(Mage::getSingleton('customer/session')->isLoggedIn())
				{
					$customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
					$customerData = Mage::getModel('customer/customer')->load($customerId);
					$email = $customerData->getEmail();
					$firstName = $customerData->getFirstname();
					$lastName = $customerData->getLastname();
					$comment = $post['msg'];
					$customerId = $customerData->getId();
					
					$post['name'] = $firstName . ' ' . $lastName;
					$post['id'] = $customerId;
					$post['email'] = $email;
					$post['comment'] = $comment;
					
					$postObject = new Varien_Object();
                	$postObject->setData($post);

					if(Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT) == "" )
					{
						$recepeintEmail = Mage::getStoreConfig('trans_email/ident_general/email');
					}
					else
					{
						$recepeintEmail = Mage::getStoreConfig(self::XML_PATH_EMAIL_RECIPIENT);
					}

					$mailTemplate = Mage::getModel('core/email_template');
					/* @var $mailTemplate Mage_Core_Model_Email_Template */
					$mailTemplate->setDesignConfig(array('area' => 'frontend'))
						->setReplyTo($email)
						->sendTransactional(
							Mage::getStoreConfig(self::XML_PATH_EMAIL_TEMPLATE),
							Mage::getStoreConfig(self::XML_PATH_EMAIL_SENDER),
							$recepeintEmail,
							null,
							array('data' => $postObject)
						);


					if (!$mailTemplate->getSentSuccess()) {
						throw new Exception();
					}
	
					$translate->setTranslateInline(true);
					
				}

				$response['success'] = true;
				$response['msg'] = Mage::helper('morecc')->__('Your inquiry was submitted and will be responded to as soon as possible. Thank you for contacting us.'); 
			}
		}
		catch(Exception $e)
		{
			$response['success'] = false;
			$errorMsg = $e->getMessage();
			$response['msg'] = Mage::helper('morecc')->__($errorMsg.' There is error in processing your request.'); 
		}
		 $this->getResponse()->setBody(Zend_Json::encode($response));
	}

	public function updatePaymentProfileAction()
	{	
		if(! Mage::helper('customer')->isLoggedIn() || !Mage::getStoreConfig('payment/acimpro/active')){
            Mage::app()->getFrontController()->getResponse()->setRedirect(Mage::getUrl('customer/account'));
        }
		
		$post = $this->getRequest()->getPost();
        if ( $post ) {
			
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
			
			$customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
			$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
			
			$ccNumber = $_POST['payment']['cc_number'];
			$ccType = $_POST['payment']['cc_type'];
			$ccEXPDate = $ccExpDate = $_POST['payment']['cc_exp_year'] .'-'. str_pad($_POST['payment']['cc_exp_month'], 2, '0', STR_PAD_LEFT); 
			$cvv = '' ;
			if(isset($_POST['payment']['cc_cid']) && $_POST['payment']['cc_cid'] != "")
			{
				$cvv = $_POST['payment']['cc_cid'];
			}
			$cardType  = $post['payment']['cc_type'];
			
			$ccEXPYear = $post['payment']['cc_exp_year'];
			$ccEXPMonth = $post['payment']['cc_exp_month'];
			
			$post['country_id'] = $post['bill']['country_id'];
			
			$payXml = $this->updateCustomerPaymentProfileXML($_POST['customer_profile'], $_POST['payment_profile'], $ccNumber , $ccEXPDate, $post, $cvv, $storeId=0);
			$transXMLResponse = $this->processRequest($url, $payXml);
		
		//	 echo '<pre>';print_r($transXMLResponse);die;
		
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
					$name = $post['firstname'] .' '.$post['lastname'] ;  
					$newCard = "XXXX-XXXX-XXXX-" . substr($ccNumber,-4,4);

					$id = $post['record_id'];
					$model  = Mage::getModel('morecc/morecc')->load($id);
					$model->setCreatedTime(now());
					$model->setEmail($customerEmail);
					$model->setCusId($customerId);
					$model->setName($name);
					$model->setNumber($newCard); 
					$model->setCardType($cardType);
					$model->setExprMonth($ccEXPMonth);
					$model->setExprYear($ccEXPYear);
					$model->save();

					Mage::getSingleton('core/session')->addSuccess(Mage::helper('morecc')->__('Payment profile(card) has successfully updated.'));
					 Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					 
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
						Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
					else
					{
						Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
						Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
					}
				}
				else
				{
					Mage::getSingleton('core/session')->addError(Mage::helper('morecc')->__($message.' There is error in processing your request.'));
					Mage::app()->getResponse()->setRedirect(Mage::getUrl("*/*/profiles",array('_secure'=>true)));
				}
			}
		}
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
			
			$custBillingObj->addChild('address',$custBilling['address']);
			$custBillingObj->addChild('city',$custBilling['city']);
			if(isset($custBilling['region']) && $custBilling['region'] != "")
			{
				$custBillingObj->addChild('state',$custBilling['region']);
			}
			else{
				$custBillingObj->addChild('state',$custBilling['region_id']);
			}
			$custBillingObj->addChild('zip',$custBilling['postcode']);
			$custBillingObj->addChild('country',$custBilling['country_id']);
			
			if(!empty($custBilling['telephone'])){
				$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			}else{$custBillingObj->addChild('phoneNumber',"");}
			
			if(!empty($custBilling['fax'])){
				$custBillingObj->addChild('faxNumber',$custBilling['fax']);
			}else{
				$custBillingObj->addChild('faxNumber',"");
			}
			
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
}