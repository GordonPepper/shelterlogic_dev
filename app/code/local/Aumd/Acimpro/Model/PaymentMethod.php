<?php
	class Aumd_Acimpro_Model_PaymentMethod extends Mage_Payment_Model_Method_Cc
    {
        /**
        * unique internal payment method identifier
        *
        * @var string [a-z0-9_]
        */
        protected $_code = 'acimpro';
     
        /**
         * Here are examples of flags that will determine functionality availability
         * of this module to be used by frontend and backend.
         *
         * @see all flags and their defaults in Mage_Payment_Model_Method_Abstract
         *
         * It is possible to have a custom dynamic logic by overloading
         * public function can* for each flag respectively
         */
         
        /**
         * Is this payment method a gateway (online auth/charge) ?
         */
        protected $_isGateway               = true;
     
        /**
         * Can authorize online?
         */
        protected $_canAuthorize            = true;
     
        /**
         * Can capture funds online?
         */
        protected $_canCapture              = true;
     
        /**
         * Can capture partial amounts online?
         */
        protected $_canCapturePartial       = true;
     
        /**
         * Can refund online?
         */
        protected $_canRefund               = true;
		protected $_canRefundInvoicePartial = true;
        /**
         * Can void transactions online?
         */
        protected $_canVoid                 = true;
     
        /**
         * Can use this payment method in administration panel?
         */
        protected $_canUseInternal          = true;
     
        /**
         * Can show this payment method as an option on checkout payment page?
         */
        protected $_canUseCheckout          = true;
     
        /**
         * Is this payment method suitable for multi-shipping checkout?
         */
        protected $_canUseForMultishipping  = true;
     
        /**
         * Can save credit card information for future processing?
         */
        protected $_canSaveCc = false;
		protected $_formBlockType 			= 'acimpro/form';
		
		
		const CC_URL_LIVE = 'https://api.authorize.net/xml/v1/request.api';
		const CC_URL_TEST = 'https://apitest.authorize.net/xml/v1/request.api';
		const STATUS_APPROVED = 'Approved';
		const STATUS_SUCCESS = 'Complete';
		const PAYMENT_ACTION_AUTH_CAPTURE = 'authorize_capture';
		const PAYMENT_ACTION_AUTH = 'authorize';
		const STATUS_COMPLETED    = 'Completed';
		const STATUS_DENIED       = 'Denied';
		const STATUS_FAILED       = 'Failed';
		const STATUS_REFUNDED     = 'Refunded';
		const STATUS_VOIDED       = 'Voided';
        /**
         * Here you will need to implement authorize, capture and void public methods
         *
         * @see examples of transaction specific public methods such as
         * authorize, capture and void in Mage_Paygate_Model_Authorizenet
         */
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
		public function getUsername($storeId=0) {
		
			return Mage::getStoreConfig('payment/acimpro/api_key',$storeId);
		}
		public function getPassword($storeId=0) {
			return Mage::getStoreConfig('payment/acimpro/transaction_key',$storeId);
		}

		public function getDebug() {
			if((!Mage::getStoreConfig('payment/acimpro/checkout_mode')) & (file_exists(Mage::getBaseDir() . '/var/log'))) {
				return Mage::getStoreConfig('payment/acimpro/debug'); 
			} else {
				return false;
			}
		}
		public function getTest() {
			return Mage::getStoreConfig('payment/acimpro/test');
		}
		public function getLogPath() {
			return Mage::getBaseDir() . '/var/log/acimpro.log';
		}
	 
		public function getPaymentAction()
		{
			return Mage::getStoreConfig('payment/acimpro/payment_action');
		}
		public function getStrictCVV() {
			return true;
		}
		
		public function createCustomerProfileXML($ccNumber, $custEmail, $ccEXPDate, $storeCustomerId, $custBilling, $cvv, $storeId=0)
		{
			
			$xmlObj = new SimpleXMLElement('<?xml version ="1.0" encoding = "utf-8"?><createCustomerProfileRequest/>');
			$xmlObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $xmlObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			/* Add Profile methods to XML*/
			$profile = $xmlObj->addChild('profile');
			$profile->addChild('merchantCustomerId', $storeCustomerId);
			$profile->addChild('email', $custEmail);
			
			/* Add Payment Profile methods to XML*/
			$paymentProfile = $profile->addChild('paymentProfiles');
			
			/* Add customer Billing methods to XML*/
			$custBillingObj = $paymentProfile->addChild('billTo');
			$custBillingObj->addChild('firstName',$custBilling['firstname']);
			$custBillingObj->addChild('lastName',$custBilling['lastname']);
			if(!empty($custBilling['company'])){
				$custBillingObj->addChild('company',htmlentities($custBilling['company']));
			} else { $custBillingObj->addChild('company',"company"); }
			$custBillingObj->addChild('address',$custBilling->getStreet(1)." ".$custBilling->getStreet(2));
			$custBillingObj->addChild('city',$custBilling['city']);
			$custBillingObj->addChild('state',$custBilling['region']);
			$custBillingObj->addChild('zip',$custBilling['postcode']);
			$custBillingObj->addChild('country',$custBilling['country_id']);
			$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			
			if(!empty($custBilling['fax'])){
				$custBillingObj->addChild('faxNumber',htmlentities($custBilling['fax']));
			} else { $custBillingObj->addChild('faxNumber',"fax"); }
			
			/* Add Payment Profile Payment(CC Details) methods to XML*/
			$PaymentObj = $paymentProfile->addChild('payment');
			$CC = $PaymentObj->addChild('creditCard');
			$CC->addChild('cardNumber', htmlentities($ccNumber));
			$CC->addChild('expirationDate', $ccEXPDate);
			if($cvv) {$CC->addChild('cardCode', $cvv); }
			$customerProfileXMLData = $xmlObj->asXML();
			return $customerProfileXMLData;
		}
		public function createCutomerPaymentProfileXML($custProfile, $ccNumber, $ccEXPDate, $custBilling, $cvv, $storeId=0) {
			 
			$custPayProXMLObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><createCustomerPaymentProfileRequest/>');
			$custPayProXMLObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $custPayProXMLObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			/* Add Profile methods to XML*/
			$profile = $custPayProXMLObj->addChild('customerProfileId', $custProfile);
			$paymentProfile = $custPayProXMLObj->addChild('paymentProfile');
			
			/* Add customer Billing methods to XML*/
			$custBillingObj = $paymentProfile->addChild('billTo');
			$custBillingObj->addChild('firstName',$custBilling['firstname']);
			$custBillingObj->addChild('lastName',$custBilling['lastname']);
			if(!empty($custBilling['company'])){
				$custBillingObj->addChild('company',htmlentities($custBilling['company']));
			} else { $custBillingObj->addChild('company',"company"); }
			$custBillingObj->addChild('address',$custBilling->getStreet(1)." ".$custBilling->getStreet(2));
			$custBillingObj->addChild('city',$custBilling['city']);
			$custBillingObj->addChild('state',$custBilling['region']);
			$custBillingObj->addChild('zip',$custBilling['postcode']);
			$custBillingObj->addChild('country',$custBilling['country_id']);
			$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			if(!empty($custBilling['fax'])){
				$custBillingObj->addChild('faxNumber',htmlentities($custBilling['fax']));
			} else { $custBillingObj->addChild('faxNumber',"fax"); }
			
			/* Add Payment Profile Payment(CC Details) methods to XML*/
			$payment = $paymentProfile->addChild('payment');
			$credit = $payment->addChild('creditCard');
			$credit->addChild('cardNumber', $ccNumber);
			$credit->addChild('expirationDate', $ccEXPDate);
			if($cvv) {$credit->addChild('cardCode', $cvv); }
			$customerPaymentXMLData = $custPayProXMLObj->asXML();
			return $customerPaymentXMLData;
		}
		public function updateCustomerPaymentProfileXML($CustProfile, $PayProfile, $ccNumber, $ccEXPDate, $custBilling, $cvv, $storeId=0) {
			
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
			} else { $custBillingObj->addChild('company',"company"); }
			
			$custBillingObj->addChild('address',$custBilling->getStreet(1)." ".$custBilling->getStreet(2));
			$custBillingObj->addChild('city',$custBilling['city']);
			$custBillingObj->addChild('state',$custBilling['region']);
			$custBillingObj->addChild('zip',$custBilling['postcode']);
			$custBillingObj->addChild('country',$custBilling['country_id']);
			$custBillingObj->addChild('phoneNumber',$custBilling['telephone']);
			$custBillingObj->addChild('faxNumber',$custBilling['fax']);
			
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
		public function createCustomerShippingAddressXML($custProfile, $shippingObj, $storeId=0) {
			
			/* Create XML Object*/		
		$custShippingObj = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><createCustomerShippingAddressRequest/>');
		$custShippingObj->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add(Check) Authenticate methods to XML*/
			$authSeller = $custShippingObj->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			$profile = $custShippingObj->addChild('customerProfileId', $custProfile);
			
			/* Add customer Shipping methods to XML*/
			$shippingXmlObj = $custShippingObj->addChild('address');
			$shippingXmlObj->addChild('firstName',$shippingObj['firstname']);
			$shippingXmlObj->addChild('lastName',$shippingObj['lastname']);
			if(!empty($shippingObj['company'])){
				$shippingXmlObj->addChild('company',htmlentities($shippingObj['company']));
			} else { $shippingXmlObj->addChild('company',"company"); }
			$shippingXmlObj->addChild('address',$shippingObj->getStreet(1)." ".$shippingObj->getStreet(2));
			$shippingXmlObj->addChild('city',$shippingObj['city']);
			$shippingXmlObj->addChild('state',$shippingObj['region']);
			$shippingXmlObj->addChild('zip',$shippingObj['postcode']);
			$shippingXmlObj->addChild('country',$shippingObj['country_id']);
			$shippingXmlObj->addChild('phoneNumber',$shippingObj['telephone']);
			$shippingXmlObj->addChild('faxNumber',$shippingObj['fax']);
			$custShippingXMLData = $custShippingObj->asXML();
			return $custShippingXMLData;
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
		
		/* Create XML will all the data that will be processed for processing the request(capture,refund etc..) */
		public function createTransXML($amount, $tax, $custProfileID, $payProfileID, $callRequestType, $invoiceno, $authTransID, $approvCode, $storeId=0,$customerShippingAddressId='',$cvv='') {
			
			/* Create XML Data Object*/
			$custProTransReq = new SimpleXMLElement('<?xml version = "1.0" encoding = "utf-8"?><createCustomerProfileTransactionRequest/>');
			$custProTransReq->addAttribute('xmlns','AnetApi/xml/v1/schema/AnetApiSchema.xsd');
			
			/* Add Authenticate methods to XML*/
			$authSeller = $custProTransReq->addChild('merchantAuthentication');
			$authSeller->addChild('name', htmlentities( $this->getUsername($storeId) ));
			$authSeller->addChild('transactionKey', htmlentities( $this->getPassword($storeId) ));
			
			$cptrObj = $custProTransReq->addChild('transaction');
			$paymentType = Mage::getStoreConfig('payment/acimpro/payment_action');
			if($paymentType =='authorize') /* if admin has set the transaction type Authorize only */
			{
				switch($callRequestType) {
					case 'captureonly':
						$proPayObj = $cptrObj->addChild('profileTransCaptureOnly');
						$proPayObj->addChild('amount', $amount);
						break;
					case 'capture':
						$proPayObj = $cptrObj->addChild('profileTransPriorAuthCapture');
						$proPayObj->addChild('amount', $amount);
						break;
					case 'refund':
						$proPayObj = $cptrObj->addChild('profileTransRefund');
						$proPayObj->addChild('amount', $amount);
						break;
					case 'void':
						$proPayObj = $cptrObj->addChild('profileTransVoid');
						break;
					default:
						$proPayObj = $cptrObj->addChild('profileTransAuthOnly');
						$proPayObj->addChild('amount', $amount);

						/*if(isset($cvv) && $cvv != "" && $cvv != "111")
						{
							$proPayObj->addChild('cardCode', $cvv);
						}*/
						
						if($tax>0) {
							$credittax = $proPayObj->addChild('tax');
							$credittax->addChild('amount', $tax);
						}
						break;
				}
			} else { /* if admin has set the transaction type Authorize and Capture */
				switch($callRequestType) {
					case 'refund':
						$proPayObj = $cptrObj->addChild('profileTransRefund');
						$proPayObj->addChild('amount', $amount);
						break;
					case 'void':
						$proPayObj = $cptrObj->addChild('profileTransVoid');
						break;
					default:
						$proPayObj = $cptrObj->addChild('profileTransAuthCapture');
						$proPayObj->addChild('amount', $amount);
						if($tax>0) {
							$credittax = $proPayObj->addChild('tax');
							$credittax->addChild('amount', $tax);
						}
						break;
				}
			}
			$proPayObj->addChild('customerProfileId', $custProfileID);
			$proPayObj->addChild('customerPaymentProfileId', $payProfileID);
			
			/*2-7-14*/
			if(isset($customerShippingAddressId) && $customerShippingAddressId != "")
			{
				$proPayObj->addChild('customerShippingAddressId', $customerShippingAddressId);
			}
			/*2-7-14*/
			
			if($paymentType == 'authorize')
			{
				switch($callRequestType) {
					case 'captureonly':
						$proPayObj->addChild('approvalCode', $approvCode);
						break;
					case 'capture':
						$proPayObj->addChild('transId', $authTransID);
						break;
					case 'refund':
						$proPayObj->addChild('transId', $authTransID);
						break;
					case 'void':
						$proPayObj->addChild('transId', $authTransID);
						break;
					default:
						$order = $proPayObj->addChild('order');
						$order->addChild('invoiceNumber', $invoiceno);
						break;
				}
			} else {
				switch($callRequestType) {
					case 'refund':
						$proPayObj->addChild('transId', $authTransID);
						break;
					case 'void':
						$proPayObj->addChild('transId', $authTransID);
						break;
					default:
						$order = $proPayObj->addChild('order');
						$order->addChild('invoiceNumber', $invoiceno);
						break;
				}
			}
			return $transReqXMLData = $custProTransReq->asXML();
			
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
			
		public function parseXML($start, $end, $xml)	 {
			//return preg_replace('|^.*?'.$start.'(.*?)'.$end.'.*?$|i', '$1', substr($xml, 335));
			  $result = "Can't parse XML";
                $matches = array();
                if(preg_match('|'.$start.'(.*?)'.$end.'|i', $xml, $matches))
                        $result = $matches[1];
                $start.$result.$end."<br/>";
                return $result;
		}
		
		public function parseMultiXMLForShipping($xml, $zipEntered,$countryId='')	 {
		
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("MultiParseXML...");
			}	
					
			$pos = strpos($xml,"<?xml version=");
			$fixedXML=substr($xml,$pos); 
			$fixedXML = preg_replace('/xmlns="(.+?)"/', '', $fixedXML);  
			$dom=new DOMDocument;
			$dom->loadXML($fixedXML);
			//print_r($dom);die;
			$shipId=array();
			$sZip=array();
			$shippingIDs=$dom->getElementsByTagname('customerAddressId');
			$index=0;
			//echo '<pre>';print_r($shippingIDs);
				foreach ($shippingIDs as $shippingId) {
					$value=$shippingId->nodeValue;
					$shipId[]=$value;
					$index++;
				}

				$params=$dom->getElementsByTagName('shipToList');
				$k = 0 ;
				foreach ($params as $param) //go to each section 1 by 1
				{
					  $paramsZip = $params->item($k)->getElementsByTagName('zip'); //digg categories with in Section
					  
					$i=0; // values is used to iterate categories 
					foreach ($paramsZip as $paramsZipVal) {
							$sZip[]=  $paramsZip->item($i)->nodeValue ;
							$i++;
					}
					$k++;   
				}


		/*	$zips=$dom->getElementsByTagname('zip');
			foreach ($zips as $zip) {
				$value=$zip->nodeValue;
				$sZip[]=$value;
			}*/
			
			//echo '<pre>';print_r($shipId);
			//echo '<pre>';print_r($sZip);die;
			$returnvalue = '';
			for ($iindex=0; $iindex<$index; $iindex++) {
				if($this->getDebug())
				{
					$logger->info(" Shipping ID: " . $shipId[$iindex]);
					$logger->info(" zip ID: " . $sZip[$iindex]);
				}	
				if($sZip[$iindex]==$zipEntered) {
					$returnvalue=$shipId[$iindex];
					break;
				}
				//	$returnvalue=$shipId[0];
			}
				return $returnvalue;
		}
		
		public function parseMultiXML($xml, $ccnum)	 {
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("MultiParseXML...");
			}	
			$ccnum='XXXX'.substr($ccnum, -4, 4);		
			$pos = strpos($xml,"<?xml version=");
			$fixedXML=substr($xml,$pos); 
			$fixedXML = preg_replace('/xmlns="(.+?)"/', '', $fixedXML);
			$dom=new DOMDocument;
			$dom->loadXML($fixedXML);
			//print_r($dom);
			$profileID=array();
			$CardNo=array();
			$ProfileIDs=$dom->getElementsByTagname('customerPaymentProfileId');
			$index=0;
			foreach ($ProfileIDs as $Profile) {
				$value=$Profile->nodeValue;
				$profileID[]=$value;
				$index++;
			}
			//print_r($profileID);
			$Cards=$dom->getElementsByTagname('cardNumber');
			foreach ($Cards as $Card) {
				$value=$Card->nodeValue;
				$CardNo[]=$value;
			}
			//print_r($CardNo);
			for ($iindex=0; $iindex<$index; $iindex++) {
				if($this->getDebug())
				{
					$logger->info(" Payment: " . $profileID[$iindex]);
					$logger->info(" Card Number: " . $CardNo[$iindex]);
				}	
				if($CardNo[$iindex]==$ccnum) {
					$returnvalue=$profileID[$iindex];
					break;
				}
					$returnvalue=$profileID[0];
			}
				return $returnvalue;
		}
		public function validate() {
		
			$info = $this->getInfoInstance();
			$ccNumber = $info->getCcNumber();
			 
			if($this->getDebug())
			{ 
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("entering validate()");
			}
			  
			if(strpos($ccNumber,'frmord') === FALSE) {	//reauth from admin order
			
				//parent::validate();
				$paymentInfo = $this->getInfoInstance();
				if ($paymentInfo instanceof Mage_Sales_Model_Order_Payment) {
			 
					$currency_code = $paymentInfo->getOrder()->getBaseCurrencyCode();
				} else {
			 
					$currency_code = $paymentInfo->getQuote()->getBaseCurrencyCode();
				}
				return $this;
			} 
			return $this;
		}
		
		public function authorize(Varien_Object $payment, $amount)  /* Overwrite core magento authorize function */
		{
	 
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("entering authorize()");
			}
			$this->setAmount($amount)->setPayment($payment);

			//if (!$payment->getCcNumber()) { $payment->setCcNumber($payment->getToken()); }
			
			$orderTable=Mage::getSingleton('core/resource')->getTableName('sales_flat_order');
			$orderTransTable=Mage::getSingleton('core/resource')->getTableName('sales_payment_transaction'); 
			
			/* First Delete the payment transaction if there is any for that particular order */
			$orderno = $payment->getOrder()->getIncrementId();
			$sql = "DELETE p.* FROM $orderTransTable p, $orderTable q WHERE q.increment_id ='".$orderno."' AND q.entity_id=p.order_id AND p.txn_type='authorization';";
			$write = Mage::getSingleton('core/resource')->getConnection('core_write');
			$write->query($sql);

			/* It will reauthorize the new order Or the already placed order */
			$gatewayResponse = $this->_call($payment, 'authorize', $amount);

			if($this->getDebug()) { $logger->info(var_export($gatewayResponse, TRUE)); }
			if($gatewayResponse === false)
			{
				$errorResult = $this->getError();
				if (isset($errorResult['message'])) {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment.') . $errorResult['message'];
				} else {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment. Please try later.');
				}
				Mage::throwException($message);
			}
			else
			{
				/*if the transaction is successfulyl approved then set payment status*/
				if ($gatewayResponse['Status']['statusCode'] == "Ok")
				{
					// Check if there is an error processing the credit card
					if($gatewayResponse['Status']['code'] == "I00001")
					{
						$payment->setStatus(self::STATUS_APPROVED);
						$payment->setTransactionId($gatewayResponse['Status']['transno']);
						$payment->setIsTransactionClosed(0);
						$payment->setTxnId($gatewayResponse['Status']['transno']);
						$payment->setParentTxnId($gatewayResponse['Status']['transno']);
						$payment->setCcTransId($gatewayResponse['Status']['transno']);					
						
							
						/* Save customer "payment profile id" and "cusotmer profile Id" in database and on next order customer can checkout by selecting that card*/
						$params = Mage::app()->getRequest()->getParams(); 
						 

						if(isset($params['placecard']) && $params['placecard'] == 1)
						{
							$resource = Mage::getSingleton('core/resource');
							$read= $resource->getConnection('core_read');
							$moreccTable = $resource->getTableName('morecc');
							$customerEmail = $payment->getOrder()->getCustomerEmail();
							$billingAddress = $payment->getOrder()->getBillingAddress();
							$customerId = $payment->getOrder()->getCustomerId();
							
							if(!isset($customerEmail) && $customerEmail == "")
							{
								$customerEmail = $billingAddress['email'];
							}
							
							if(!isset($customerId) && $customerId == "")
							{
								$customerId = $payment->getOrder()->getCustomerId();
							}
							
							/*$select = $read->select()
									->from($moreccTable,array('morecc_id','email','number','profile_id','pay_id'))
									->where('email=?',$customerEmail) ;*/
							
							//$select        = "Select * from ".$moreccTable." where cus_id='".$customerId."'";
							$select = "Select * from ".$moreccTable." where cus_id='".$customerId."' and pay_id = '".$gatewayResponse['Status']['PaymentProfileID']."'";
							$morecc = $read->fetchRow($select); 
							
							if(!is_array($morecc))
							{
								$customerProfileId = $gatewayResponse['Status']['CustomerProfileID'];
								$customerPayProfileId = $gatewayResponse['Status']['PaymentProfileID'];
								
								$name = $billingAddress['firstname'] .' '. $billingAddress['lastname'] ; 
								$ccNumber = $payment->getCcNumber();
								$cardType  = $payment->getCcType();
								
								$cardExprMonth = $payment->getCcExpMonth();
								$cardExprYear = $payment->getCcExpYear();
								
								$newCard = "XXXX-XXXX-XXXX-" . substr($ccNumber,-4,4);
								
								$model = Mage::getModel('morecc/morecc');
								$model->setCreatedTime(now());
								$model->setEmail($customerEmail);
								$model->setCusId($customerId);
								$model->setName($name);
								$model->setNumber($newCard);
								$model->setCardType($cardType);
								$model->setExprMonth($cardExprMonth);
								$model->setExprYear($cardExprYear);
								$model->setProfileId($customerProfileId);
								$model->setPayId($customerPayProfileId);
								$model->setShipId($gatewayResponse['Status']['shippingAddressId']);
								$model->save();
							}

						}
						/* Save customer "payment profile id" and "cusotmer profile Id" */
							
					}
				}
				else
				{
					Mage::throwException("Gateway error code " . $gatewayResponse['Status']['code'] . ":: " . $gatewayResponse['Status']['statusDescription']);
				}
			}
		return $this;
		}
		public function capture(Varien_Object $payment, $amount) { /* Overwrite core magento capture function */
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("entering capture()");
			}
			$this->setAmount($amount)->setPayment($payment);
			
		$orderTable = Mage::getSingleton('core/resource')->getTableName('sales_flat_order'); 
		$orderInvoiceTable = Mage::getSingleton('core/resource')->getTableName('sales_flat_invoice'); 
		$orderno = $payment->getOrder()->getIncrementId();
		
		$sql = "SELECT * FROM $orderInvoiceTable p, $orderTable q WHERE q.increment_id ='".$orderno."' AND q.entity_id=p.order_id AND p.increment_id>'' ORDER BY p.entity_id desc LIMIT 1;";
		$sqlResult = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchRow($sql);
		
			$invoiceId = $sqlResult['increment_id'];
			if($this->getDebug()) { $logger->info("lastinvoice: $invoiceId"); }
			
			if(!$invoiceId) { $gatewayResponse = $this->_call($payment,'capture', $amount);
			} else {  $gatewayResponse = $this->_call($payment,'captureonly', $amount); }
			
			if($this->getDebug()) { $logger->info(var_export($gatewayResponse, TRUE)); }
			
			if($gatewayResponse['Status']['transno']=='0') {
				$gatewayResponse = $this->_call($payment,'captureonly', $amount);
				if($this->getDebug()) { $logger->info(var_export($gatewayResponse, TRUE)); }
			}
			if($gatewayResponse === false)
			{
				$errorResult = $this->getError();
				if (isset($errorResult['message'])) {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment.') . $errorResult['message'];
				} else {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment. Please try later.');
				}
				Mage::throwException($message);
			}
			else
			{
				/*if the transaction is successfulyl approved then set payment status*/
				if ($gatewayResponse['Status']['statusCode'] == "Ok")
				{
					/* If there is an error processing the credit card */
					if($gatewayResponse['Status']['code'] == "I00001")
					{				
						$payment->setIsTransactionClosed(0);
						$payment->setTransactionId($gatewayResponse['Status']['transno']);
						$payment->setLastTransId($gatewayResponse['Status']['transno'])
								->setCcApproval($gatewayResponse['Status']['code'])
								->setCcTransId($gatewayResponse['Status']['transno'])
								->setCcAvsStatus($gatewayResponse['Status']['statusCode'])
								->setCcCidStatus($gatewayResponse['Status']['statusCode']);
									
						/* Save customer "payment profile id" and "cusotmer profile Id" in database and on next order customer can checkout by selecting that card*/
						$params = Mage::app()->getRequest()->getParams(); 
						 

						if(isset($params['placecard']) && $params['placecard'] == 1)
						{
							
							$resource = Mage::getSingleton('core/resource');
							$read= $resource->getConnection('core_read');
							$moreccTable = $resource->getTableName('morecc');
							$customerEmail = $payment->getOrder()->getCustomerEmail();
							$billingAddress = $payment->getOrder()->getBillingAddress();
							$customerId = $payment->getOrder()->getCustomerId();
							
							if(!isset($customerEmail) && $customerEmail == "")
							{
								$customerEmail = $billingAddress['email'];
							}
							
							if(!isset($customerId) && $customerId == "")
							{
								$customerId = $payment->getOrder()->getCustomerId();
							}
							
							/*$select = $read->select()
									->from($moreccTable,array('morecc_id','email','number','profile_id','pay_id'))
									->where('email=?',$customerEmail) ;*/
							
							$select = "Select * from ".$moreccTable." where cus_id='".$customerId."' and pay_id = '".$gatewayResponse['Status']['PaymentProfileID']."'";

							$morecc = $read->fetchRow($select); 

							if(!is_array($morecc))
							{

								$customerProfileId = $gatewayResponse['Status']['CustomerProfileID'];
								$customerPayProfileId = $gatewayResponse['Status']['PaymentProfileID'];
								
								$name = $billingAddress['firstname'] .' '. $billingAddress['lastname'] ; 
								$ccNumber = $payment->getCcNumber();
								$cardType  = $payment->getCcType();
								
								$cardExprMonth = $payment->getCcExpMonth();
								$cardExprYear = $payment->getCcExpYear();
								
								$newCard = "XXXX-XXXX-XXXX-" . substr($ccNumber,-4,4);
								
								$model = Mage::getModel('morecc/morecc');
								$model->setCreatedTime(now());
								$model->setEmail($customerEmail);
								$model->setCusId($customerId);
								$model->setName($name);
								$model->setNumber($newCard);
								$model->setCardType($cardType);
								$model->setExprMonth($cardExprMonth);
								$model->setExprYear($cardExprYear);
								$model->setProfileId($customerProfileId);
								$model->setPayId($customerPayProfileId);
								$model->setShipId($gatewayResponse['Status']['shippingAddressId']);
								$model->save();
							}
						
						}
						/* Save customer "payment profile id" and "cusotmer profile Id" */
							
					}
				}
				else
				{
					Mage::throwException("Authorize.net Gateway Error : " . $gatewayResponse['Status']['code'] . ": " . $gatewayResponse['Status']['statusDescription']);
				}
			}
			return $this;
		}
		public function refund(Varien_Object $payment, $amount) {
	 
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("entering refund()");
			}
			$this->setAmount($amount)->setPayment($payment);
				
			$result = $this->_call($payment,'refund', $amount);
			//echo '<pre>';print_r($result);die;
			if($this->getDebug()) { $logger->info(var_export($result, TRUE)); }
			if($result === false)
			{
				$errorResult = $this->getError();
				if(isset($errorResult['message']))
				{
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment.') . $errorResult['message'];
				} 
				else 
				{
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment. Please try again later.');
				}
				Mage::throwException($message);
			}
			else
			{
				/*if the transaction is successfulyl approved then set payment status*/
				if ($result['Status']['statusCode'] == "Ok")
				{
					/* If there is an error processing the credit card */
					if($result['Status']['code'] == "I00001")
					{
						$payment->setCcApproval($result['Status']['code'])
							->setTransactionId($result['Status']['transno'])
							->setCcTransId($result['Status']['transno'])
							->setCcAvsStatus($result['Status']['statusCode'])
							->setCcCidStatus($result['Status']['statusCode']);
					}
				}
				else
				{
					Mage::throwException("Authorize.net Gateway error " . $result['Status']['code'] . ": " . $result['Status']['statusDescription']);
				}
			}
			return $this;
		}
		public function void(Varien_Object $payment) { /* It is used to cancel the order */
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("entering void()");
			}
			
			$gatewayResponse = $this->_call($payment,'void', 99999);
			if($this->getDebug()) { $logger->info(var_export($gatewayResponse, TRUE)); }
			if($gatewayResponse === false)
			{
				$e = $this->getError();
				if (isset($e['message'])) {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment.') . $e['message'];
				} else {
					$message = Mage::helper('acimpro')->__('There has been an error processing your payment. Please try again later.');
				}
				Mage::throwException($message);
			}
			else
			{
				/*if the transaction is successfulyl approved then set payment status*/
				if ($gatewayResponse['Status']['statusCode'] == "Ok")
				{
					/* If there is an error processing the credit card */
					if($gatewayResponse['Status']['code'] == "I00001")
					{
						$cancelorder=true;
						if ($cancelorder) { $payment->getOrder()->setState('canceled', true, 'Canceled/Voided');
						} else { $payment->registerVoidNotification(); }
						$payment->setCcApproval($gatewayResponse['Status']['code'])
							->setTransactionId($gatewayResponse['Status']['transno'])
							->setCcTransId($gatewayResponse['Status']['transno'])
							->setCcAvsStatus($gatewayResponse['Status']['statusCode'])
							->setCcCidStatus($gatewayResponse['Status']['statusCode']);
						$payment->setStatus(self::STATUS_VOIDED);
					}
				}
				else
				{
					Mage::throwException("Authorize.net Gateway error : " . $gatewayResponse['Status']['code'] . ": " . $gatewayResponse['Status']['statusDescription']);
				}
			}
			return $this;
		}
		
		
		protected function _call(Varien_Object $payment,$callType='', $amountcalled) {
			if($this->getDebug())
			{
				$writer = new Zend_Log_Writer_Stream($this->getLogPath());
				$logger = new Zend_Log($writer);
				$logger->info("paymentAction: ".$this->getPaymentAction());
				$storeId = $payment->getOrder()->getStoreId();
				$logger->info("Storeid: ".$storeId);
			}
			 
			 $params = Mage::app()->getRequest()->getParams(); 
			
			$postedccNumber = $payment->getCcNumber();
  
			$customerShippingAddressId = '';
			if(isset($params['payment_set']['cc_type']) && $params['payment_set']['cc_type'] != "" && $postedccNumber == "")
			{
				if(Mage::getSingleton('customer/session')->isLoggedIn() || $params['payment_set']['cc_type'] != "")
				{
					$shippingAddress = $payment->getOrder()->getShippingAddress();
					
					$customerEmail = Mage::getSingleton('customer/session')->getCustomer()->getEmail();
					$customerEmail = trim($customerEmail); 
					$postedPaymentId = $params['payment_set']['cc_type'];
					$payment->setCcType('Selected from Account');
					
					$resource = Mage::getSingleton('core/resource');
					$read= $resource->getConnection('core_read');
					$moreccTable = $resource->getTableName('morecc');

					$select = $read->select()
							->from($moreccTable,array('morecc_id','ship_id','email','number','profile_id','pay_id'))
							->where('pay_id="'.$postedPaymentId.'"') ;
	//echo $select;die;
					$morecc = $read->fetchRow($select); 					
					if(isset($morecc) && $morecc != "")
					{
						$tax = $payment->getOrder()->getTaxAmount();
						$cvv = $payment->getCcCid();
						$CustProfileId = $morecc['profile_id'] ;
						$ifCustProfileAlreadyExist = $morecc['profile_id'] ;
						$PayProfileId = $morecc['pay_id'] ;
						
						$storeId = $payment->getOrder()->getStoreId();
						$invoiceId = $payment->getOrder()->getIncrementId();
						$transactionID = $payment->getOrder()->getTransactionId();
						$orderPayProId = 0;
						$url = $this->getGatewayUrl();
						
/* it will show card last 4 digit in order payment information*/
						if(isset($morecc['card_type']) && $morecc['card_type'] != "")
						{
							$payment->setCcType('Selected from Account - '.$morecc['card_type']);
						}
						if(isset($morecc['number']) && $morecc['number'] != "")
						{
							$toShowCardInPaymentDetail = substr($morecc['number'], -4, 4);	
							$payment->setCcLast4($toShowCardInPaymentDetail);
						}
/* it will show card last 4 digit in order payment information*/
						
						$customerShippingAddressId = $this->getShippingId($shippingAddress, $ifCustProfileAlreadyExist, $storeId, $url, $params);
				
						$XMLDataCall = $this->createTransXML($amountcalled, $tax, $CustProfileId, $PayProfileId, $callType, $invoiceId, $transactionID, $orderPayProId, $storeId,$customerShippingAddressId,$cvv);
					//	echo '<pre>';print_r($XMLDataCall);die;
						$transXMLResponse = $this->processRequest($url, $XMLDataCall);
					}
				}
			}
		else
		{
			$ccExpDate = $payment->getCcExpYear() .'-'. str_pad($payment->getCcExpMonth(), 2, '0', STR_PAD_LEFT);
			$invoiceId = $payment->getOrder()->getIncrementId();
			$custEmail = $payment->getOrder()->getCustomerEmail();
			$custId = $payment->getOrder()->getCustomerId();
			$storeId = $payment->getOrder()->getStoreId();

			$billingAddress = $payment->getOrder()->getBillingAddress();
			$shippingAddress = $payment->getOrder()->getShippingAddress();
			$tax = $payment->getOrder()->getTaxAmount();
			$cvv = $payment->getCcCid();
			if($this->getStrictCVV()) { if(!$cvv) {$cvv="111"; } }
			
			$ccNumber = $payment->getCcNumber();
			$productNumber = $payment->getPoNumber();
			
			if($ccNumber=='') { $ccNumber="frmord-$productNumber";	}
			if($productNumber=='') { $productNumber=$ccNumber;	}
			
			$cim = $payment->getCcSsStartMonth();
			if($this->getDebug()) { $logger->info("CcNumber PoNumber: $ccNumber, $productNumber SaveCimCC: $cim\n"); }
			
			if ($amountcalled<1) { $amountcalled = $this->getAmount(); }
			
			$url = $this->getGatewayUrl();
			if(strpos($ccNumber,'frmord') !== FALSE) { /* it will beuse to re-auth the new amount*/
				$ccArr = preg_split('/-/',$ccNumber);
				$CustProfileId = $ccArr[1]; /* customer profile id form order table*/
				$PayProfileId = $ccArr[2]; /* customer payment profile id form order table*/
				$proNumArr = preg_split('/-/',$productNumber);
				$orderPayProId = $proNumArr[2]; /* customer payment profile id form order table*/				
				$cardDetails=true;
			} else {
				$productNumberArr = preg_split('/-/',$productNumber);
				$CustProfileId = $productNumberArr[0];
				$cardDetails=true;
				if((isset($productNumberArr[1])) and ($callType!='authorize') and (strpos($ccNumber,'-') !== FALSE)) { 
					$PayProfileId = $productNumberArr[1]; 
				} else {
					$PayProfileId = 0; 
				}
				if(isset($productNumberArr[2])) { 
					$orderPayProId = $productNumberArr[2];
				} else {
					$orderPayProId = 0; 
				}
			}
			
			/* Get order transaction Id */
			$transactionID = $payment->getOrder()->getTransactionId();
			if($transactionID<1) { $transactionID=$payment->getParentTransactionId();	}
			if($transactionID<1) { $transactionID=$payment->getCcTransId();	}
		
			$transactionIDPay = preg_split ('/-/',$transactionID); /* if transaction id has payment profile id*/
			$transactionID = $transactionIDPay[0];
			if($this->getDebug()) { $logger->info("from database: $CustProfileId, $PayProfileId, $transactionID\n"); }

 
			/* If we have the Customer ID and Payment ID, we can just do the transaction */
			if(($CustProfileId>0) and ($PayProfileId>0)) {

		/* when this user creating order first time then it will enter this loop*/
				$XMLDataCall = $this->createTransXML($amountcalled, $tax, $CustProfileId, $PayProfileId, $callType, $invoiceId, $transactionID, $orderPayProId, $storeId,$customerShippingAddressId,$cvv);
				$transXMLResponse = $this->processRequest($url, $XMLDataCall);
				if(isset($shippingAddress['lastname']) and $shippingAddress['lastname']>'') {
					$createCustomerShippingAddressXML=$this->createCustomerShippingAddressXML($CustProfileId, $shippingAddress, $storeId);
					$responseFromGateway = $this->processRequest($url, $createCustomerShippingAddressXML);
					 if($this->getDebug()) {		$logger->info("\n\n Shipping Address responseFromGateway: $responseFromGateway\n\n"); }
				}
			}
			else {
		
				/* 
					-First try to create a Customer Profile
					-or create order n number of times by entering card
				*/
				
				
				$CustProfileXML = $this->createCustomerProfileXML($ccNumber, $custEmail, $ccExpDate, $custId, $billingAddress, $cvv, $storeId);
				$responseFromGateway = $this->processRequest($url, $CustProfileXML);
				$resFrmGatewayErrorCode = $this->parseXML('<code>','</code>',$responseFromGateway);
				
				/* Get Customer Profile ID */
				$CustProfileId = (int) $this->parseXML('<customerProfileId>','</customerProfileId>', $responseFromGateway);
				
				/* Get Payment Profile ID */
				$PayProfileId = (int) $this->parseXML('<customerPaymentProfileIdList><numericString>','</numericString></customerPaymentProfileIdList>', $responseFromGateway);

				$ifCustProfileAlreadyExist = $CustProfileId; /* If cusotmer profile already exist*/
				$resultText = $this->parseXML('<text>','</text>',$responseFromGateway);
				$resultCode = $this->parseXML('<resultCode>','</resultCode>',$responseFromGateway);

				if($resFrmGatewayErrorCode == 'E00039') { /* it enters when customer profile already exist for this user*/
					if($this->getDebug()) {		$logger->info("\n\n ALREADY HAVE A CUST PROFILE \n\n"); }
					
					$responseArr = preg_split('/ /',$resultText);
					$ifCustProfileAlreadyExist = $responseArr[5];
					$CustProfileId = $ifCustProfileAlreadyExist;
					$getCutomerPaymentProfileXMLData = $this->createCutomerPaymentProfileXML($ifCustProfileAlreadyExist, $ccNumber, $ccExpDate, $billingAddress, $cvv, $storeId);
					$responseFromGateway = $this->processRequest($url, $getCutomerPaymentProfileXMLData);
					$PayProfileId = (int) $this->parseXML('<customerPaymentProfileId>','</customerPaymentProfileId>', $responseFromGateway);
					
					$resFrmGatewayErrorCode = $this->parseXML('<code>','</code>',$responseFromGateway);
					 if($resFrmGatewayErrorCode == 'E00039') { /*if pay profile is alredy created on auth server and customer again enter same card instead of select card*/
						 if($this->getDebug()) {		$logger->info("\n\n ALREADY HAVE A PAYMENT PROFILE WITH THE CARD \n\n"); }
						
			 
						//Get Correct PayProfileId
						$getCustXML = $this->getCustomerProfileXML($ifCustProfileAlreadyExist, $storeId);
						$responseGET = $this->processRequest($url, $getCustXML);
				 
						$PayProfileId = $this->parseMultiXML($responseGET, $ccNumber);
				
				/*get shipping address id*/
					 
				/*get shipping address id*/
				
						if($cardDetails) {
							$getUpdatePaymentProfileXMLData = $this->updateCustomerPaymentProfileXML($ifCustProfileAlreadyExist, $PayProfileId, $ccNumber, $ccExpDate, $billingAddress, $cvv, $storeId);
							$responseFromGateway = $this->processRequest($url, $getUpdatePaymentProfileXMLData);
							 if($this->getDebug()) {		$logger->info("\n\n UPDATED PROFILE $PayProfileId \n\n"); }
						}
						if($this->getDebug()) {		$logger->info("\n\ngetCustXML: $getCustXML ...\n...\nresponseGET$responseGET \n\n"); }
					}
					 if($PayProfileId == '0') { 
				 
					 /*if customer profile is alraedy created but not pay profile on auth server means customer has entered new card*/
					 if($this->getDebug()) {		$logger->info("\n\n PROFILE ERROR \n\n"); }
						//Get Correct PayProfileId
						$getCustXML = $this->getCustomerProfileXML($ifCustProfileAlreadyExist, $storeId);
						$responseGET = $this->processRequest($url, $getCustXML);
						$PayProfileId = $this->parseMultiXML($responseGET, $ccNumber);
						if($this->getDebug()) {		$logger->info("\n\ngetCustXML: $getCustXML ...\n...\nresponseGET$responseGET \n\n"); }
					}				
				 if($this->getDebug()) { $logger->info("\nUSING $CustProfileId - $PayProfileId"); }
				}

				 
/*create and set (new or alredy created shipping id) starts*/
				$customerShippingAddressId = $this->getShippingId($shippingAddress, $ifCustProfileAlreadyExist, $storeId, $url, $params);
				
				$XMLDataCall = $this->createTransXML($amountcalled, $tax, $CustProfileId, $PayProfileId, $callType, $invoiceId, $transactionID, $orderPayProId, $storeId,$customerShippingAddressId,$cvv);
				$transXMLResponse = $this->processRequest($url, $XMLDataCall);
			}
		
		}
		
			$resultText = $this->parseXML('<text>','</text>',$transXMLResponse);
			$resultCode = $this->parseXML('<resultCode>','</resultCode>',$transXMLResponse);
			$resFrmGatewayErrorCode = $this->parseXML('<code>','</code>',$transXMLResponse);
			$transauthidar = $this->parseXML('<directResponse>','</directResponse>',$transXMLResponse);
			$fieldsAU = preg_split('/,/',$transauthidar);
			$responsecode  = $fieldsAU[0];
			if(!$responsecode=="1") { $resultCode="No";  }
			if(isset($fieldsAU[4])) { 
						$orderPayProId = $fieldsAU[4];
					} else {
						$orderPayProId = 0; 
					}
			if (strlen($orderPayProId)<6) { $orderPayProId=$orderPayProId; }
			if(isset($fieldsAU[6])) { 
						$transno = $fieldsAU[6];
					} else {
						$transno = 0; 
					}
			if($this->getDebug()) { $logger->info("TransID = $transno \n"); }
			if($this->getDebug()) { $logger->info("orderPayProId Code = $orderPayProId \n"); }
			$paymentInfo = $this->getInfoInstance();
			if (($CustProfileId>'0') AND ($PayProfileId>'0')) {
				$token="$CustProfileId-$PayProfileId-$orderPayProId"; 
				//$paymentInfo->setCybersourceToken($token);
				$paymentInfo->setCybersourceToken($customerShippingAddressId);
				$paymentInfo->setPoNumber($token);
				$paymentInfo->getOrder()->setTransactionId();
				if($paymentInfo->getCcSsStartMonth()=="on") {	
					$paymentInfo->setCcSsStartMonth('1'); 
				} else {
					if($paymentInfo->getCcSsStartMonth()!="1") {	
						$paymentInfo->setCcSsStartMonth('0'); }
				}
			}
			$resultArr['Status']['transno'] = $transno;
			$resultArr['Status']['approval'] = $orderPayProId;

			$resultArr['Status']['CustomerProfileID'] = $CustProfileId;
			$resultArr['Status']['PaymentProfileID'] = $PayProfileId;
			$resultArr['Status']['statusCode'] = $resultCode;
			$resultArr['Status']['code'] = $resFrmGatewayErrorCode;
			$resultArr['Status']['statusDescription'] = $resultText;
			
			$resultArr['Status']['shippingAddressId'] = $customerShippingAddressId;
			
			if($this->getDebug()) { $logger->info("STATUS CODE = $resFrmGatewayErrorCode - $resultCode - $resultText"); }
			return $resultArr;
		}
		
		
	public function getShippingId($shippingAddress, $ifCustProfileAlreadyExist, $storeId, $url, $params)
	{
		$customerShippingAddressId = "";
		
		if(isset($shippingAddress['lastname']) and $shippingAddress['lastname']>'') {
			$createCustomerShippingAddressXML = $this->createCustomerShippingAddressXML($ifCustProfileAlreadyExist, $shippingAddress, $storeId);
			$responseFromGateway = $this->processRequest($url, $createCustomerShippingAddressXML);
			 if($this->getDebug()) {		$logger->info("\n\n Shipping Address responseFromGateway: $responseFromGateway\n\n"); }

			/* create new shipping profile*/
			$resFrmGatewayShipCode = $this->parseXML('<code>','</code>',$responseFromGateway);
			if(isset($resFrmGatewayShipCode) && $resFrmGatewayShipCode == 'I00001') /* create new shippging Id*/
			{
				$customerShippingAddressId = $this->parseXML('<customerAddressId>','</customerAddressId>',$responseFromGateway);
				
			}
			else
			{	/* if shipping profile already exist */
				$resultCode = $this->parseXML('<resultCode>','</resultCode>',$responseFromGateway);
				if(isset($resFrmGatewayShipCode) && $resFrmGatewayShipCode == 'E00039' || $resultCode == "Error") /*shipping alredy exist*/
				{
					/* 
						-this shipping address is already created on Authorize.net server
						-we save all shipping id in magento DB while create order to sales_flat_order_payment - sybersource field
						-retrieve it first from order_payment-table if null then get from authorize.net server using adress zip code filter,if null then morecc table
					*/
					
					$resource = Mage::getSingleton('core/resource');
					$read= $resource->getConnection('core_read');
					$moreccTable = $resource->getTableName('morecc');
					$sales_flat_order_payment = $resource->getTableName('sales_flat_order_payment');
					$sales_flat_order_address = $resource->getTableName('sales_flat_order_address');
			
					/* if customer save the address it will create magento bill-ship address id and we will fetch CIM shipping based on magento shipping id*/
					if(isset($params['shipping_address']['customer_address_id']) && $params['shipping_address']['customer_address_id'] != "")
					{
						$sql = "SELECT `parent_id` FROM $sales_flat_order_address WHERE address_type ='shipping' AND customer_address_id='".$params['shipping_address']['customer_address_id']. "'";
						$sqlResult = Mage::getSingleton('core/resource')->getConnection('core_read')->fetchRow($sql);
						$orderIdToGetShipId = $sqlResult['parent_id'];
						$orderObject = Mage::getModel('sales/order')->load($orderIdToGetShipId);
						$paymentObject = $orderObject->getPayment();
						$customerShippingAddressId = $paymentObject->getCybersourceToken();
						//$poNumberDataArr = explode("-",$poNumberData);
						//$customerShippingAddressId = $poNumberDataArr[3];
					}
							
					if($customerShippingAddressId == "") /*get shipping id saved at CIM server with the profile id for that particular card*/
					{
						$getCustXML = $this->getCustomerProfileXML($ifCustProfileAlreadyExist, $storeId);
						$responseGET = $this->processRequest($url, $getCustXML);
						$customerShippingAddressId = $this->parseMultiXMLForShipping($responseGET, $shippingAddress['postcode']);
						
						if($customerShippingAddressId == "") /*get shipping id saved with the profile id for that particular card*/
						{
							$select = $read->select()
										->from($moreccTable,array('morecc_id','ship_id','email','number','profile_id','pay_id'))
										->where('pay_id="'.$PayProfileId.'"') ;
							$morecc = $read->fetchRow($select);
							if(isset($morecc) && $morecc != "")
							{
								$customerShippingAddressId = $morecc['ship_id']; // get shipping ID from morecc table
							}
						}
					}
					/*get shipping address id*/
				}
			}
			return $customerShippingAddressId;
/*create and set (new or alredy created shipping id) Ends*/
			if($this->getDebug()) {		$logger->info("\n\n Shipping Address responseFromGateway: $responseFromGateway\n\n"); }
			/*added 2-7-14*/
		}
	 }	 
   }
    